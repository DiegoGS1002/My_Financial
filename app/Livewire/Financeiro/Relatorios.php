<?php

namespace App\Livewire\Financeiro;

use App\Models\FinancialTransaction;
use App\Models\PlanOfAccount;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.app')]
#[Title('Relatórios Financeiros')]
class Relatorios extends Component
{
    /* ─────────────────────────────────────
     | FILTERS
     ─────────────────────────────────────*/
    public string $period = 'month'; // month, quarter, year, custom
    public string $startDate = '';
    public string $endDate = '';
    public string $reportType = 'overview'; // overview, income, expense, category, payment
    public string $selectedCategory = '';

    public function mount(): void
    {
        $this->startDate = now()->startOfMonth()->format('Y-m-d');
        $this->endDate = now()->endOfMonth()->format('Y-m-d');
    }

    /* ─────────────────────────────────────
     | PERIOD FILTERS
     ─────────────────────────────────────*/
    public function setPeriod(string $period): void
    {
        $this->period = $period;

        match ($period) {
            'month' => [
                $this->startDate = now()->startOfMonth()->format('Y-m-d'),
                $this->endDate = now()->endOfMonth()->format('Y-m-d'),
            ],
            'quarter' => [
                $this->startDate = now()->startOfQuarter()->format('Y-m-d'),
                $this->endDate = now()->endOfQuarter()->format('Y-m-d'),
            ],
            'year' => [
                $this->startDate = now()->startOfYear()->format('Y-m-d'),
                $this->endDate = now()->endOfYear()->format('Y-m-d'),
            ],
            default => null,
        };
    }

    /* ─────────────────────────────────────
     | COMPUTED PROPERTIES - KPIs
     ─────────────────────────────────────*/
    public function getTotalIncomeProperty()
    {
        return $this->getBaseQuery()
            ->where('type', FinancialTransaction::TYPE_INCOME)
            ->sum('amount');
    }

    public function getTotalExpenseProperty()
    {
        return $this->getBaseQuery()
            ->where('type', FinancialTransaction::TYPE_EXPENSE)
            ->sum('amount');
    }

    public function getBalanceProperty()
    {
        return $this->totalIncome - $this->totalExpense;
    }

    public function getTransactionCountProperty()
    {
        return $this->getBaseQuery()->count();
    }

    /* ─────────────────────────────────────
     | CHART DATA - Receitas vs Despesas por Mês
     ─────────────────────────────────────*/
    public function getMonthlyComparisonProperty()
    {
        $data = $this->getBaseQuery()
            ->select(
                DB::raw('DATE_FORMAT(transaction_date, "%Y-%m") as month'),
                DB::raw('type'),
                DB::raw('SUM(amount) as total')
            )
            ->groupBy('month', 'type')
            ->orderBy('month')
            ->get()
            ->groupBy('month');

        $months = [];
        $income = [];
        $expense = [];

        foreach ($data as $month => $transactions) {
            $months[] = date('M/Y', strtotime($month . '-01'));
            $income[] = $transactions->where('type', 'income')->sum('total');
            $expense[] = $transactions->where('type', 'expense')->sum('total');
        }

        return [
            'labels' => $months,
            'income' => $income,
            'expense' => $expense,
        ];
    }

    /* ─────────────────────────────────────
     | CHART DATA - Despesas por Categoria
     ─────────────────────────────────────*/
    public function getExpensesByCategoryProperty()
    {
        $categories = $this->getBaseQuery()
            ->where('type', FinancialTransaction::TYPE_EXPENSE)
            ->join('plans_of_accounts', 'financial_transactions.plan_of_account_id', '=', 'plans_of_accounts.id')
            ->select(
                'plans_of_accounts.name as category',
                DB::raw('SUM(financial_transactions.amount) as total')
            )
            ->groupBy('plans_of_accounts.id', 'plans_of_accounts.name')
            ->orderByDesc('total')
            ->limit(10)
            ->get();

        return [
            'labels' => $categories->pluck('category')->toArray(),
            'values' => $categories->pluck('total')->toArray(),
        ];
    }

    /* ─────────────────────────────────────
     | CHART DATA - Receitas por Categoria
     ─────────────────────────────────────*/
    public function getIncomesByCategoryProperty()
    {
        $categories = $this->getBaseQuery()
            ->where('type', FinancialTransaction::TYPE_INCOME)
            ->join('plans_of_accounts', 'financial_transactions.plan_of_account_id', '=', 'plans_of_accounts.id')
            ->select(
                'plans_of_accounts.name as category',
                DB::raw('SUM(financial_transactions.amount) as total')
            )
            ->groupBy('plans_of_accounts.id', 'plans_of_accounts.name')
            ->orderByDesc('total')
            ->limit(10)
            ->get();

        return [
            'labels' => $categories->pluck('category')->toArray(),
            'values' => $categories->pluck('total')->toArray(),
        ];
    }

    /* ─────────────────────────────────────
     | CHART DATA - Por Método de Pagamento
     ─────────────────────────────────────*/
    public function getPaymentMethodsProperty()
    {
        $methods = $this->getBaseQuery()
            ->select(
                'payment_method',
                DB::raw('COUNT(*) as count'),
                DB::raw('SUM(amount) as total')
            )
            ->whereNotNull('payment_method')
            ->groupBy('payment_method')
            ->orderByDesc('total')
            ->get();

        $labels = [];
        foreach ($methods as $method) {
            $labels[] = FinancialTransaction::getPaymentMethods()[$method->payment_method] ?? $method->payment_method;
        }

        return [
            'labels' => $labels,
            'values' => $methods->pluck('total')->toArray(),
            'counts' => $methods->pluck('count')->toArray(),
        ];
    }

    /* ─────────────────────────────────────
     | TABLE DATA - Top Receitas
     ─────────────────────────────────────*/
    public function getTopIncomesProperty()
    {
        return $this->getBaseQuery()
            ->where('type', FinancialTransaction::TYPE_INCOME)
            ->with('planOfAccount')
            ->orderByDesc('amount')
            ->limit(10)
            ->get();
    }

    /* ─────────────────────────────────────
     | TABLE DATA - Top Despesas
     ─────────────────────────────────────*/
    public function getTopExpensesProperty()
    {
        return $this->getBaseQuery()
            ->where('type', FinancialTransaction::TYPE_EXPENSE)
            ->with('planOfAccount')
            ->orderByDesc('amount')
            ->limit(10)
            ->get();
    }

    /* ─────────────────────────────────────
     | TABLE DATA - Resumo por Categoria
     ─────────────────────────────────────*/
    public function getCategorySummaryProperty()
    {
        return $this->getBaseQuery()
            ->join('plans_of_accounts', 'financial_transactions.plan_of_account_id', '=', 'plans_of_accounts.id')
            ->select(
                'plans_of_accounts.id',
                'plans_of_accounts.name',
                'plans_of_accounts.code',
                'plans_of_accounts.type as category_type',
                'financial_transactions.type as transaction_type',
                DB::raw('COUNT(*) as transaction_count'),
                DB::raw('SUM(financial_transactions.amount) as total'),
                DB::raw('AVG(financial_transactions.amount) as average'),
                DB::raw('MIN(financial_transactions.amount) as minimum'),
                DB::raw('MAX(financial_transactions.amount) as maximum')
            )
            ->groupBy('plans_of_accounts.id', 'plans_of_accounts.name', 'plans_of_accounts.code', 'plans_of_accounts.type', 'financial_transactions.type')
            ->orderByDesc('total')
            ->get();
    }

    /* ─────────────────────────────────────
     | TABLE DATA - Evolução Diária
     ─────────────────────────────────────*/
    public function getDailyEvolutionProperty()
    {
        return $this->getBaseQuery()
            ->select(
                'transaction_date',
                'type',
                DB::raw('COUNT(*) as count'),
                DB::raw('SUM(amount) as total')
            )
            ->groupBy('transaction_date', 'type')
            ->orderBy('transaction_date', 'desc')
            ->get()
            ->groupBy('transaction_date');
    }

    /* ─────────────────────────────────────
     | BASE QUERY WITH DATE FILTER
     ─────────────────────────────────────*/
    protected function getBaseQuery()
    {
        return FinancialTransaction::query()
            ->whereBetween('transaction_date', [$this->startDate, $this->endDate]);
    }

    /* ─────────────────────────────────────
     | EXPORT METHODS
     ─────────────────────────────────────*/
    public function exportCSV(): void
    {
        // Implementar exportação CSV
        session()->flash('message', 'Exportação CSV em desenvolvimento');
    }

    public function exportPDF(): void
    {
        // Implementar exportação PDF
        session()->flash('message', 'Exportação PDF em desenvolvimento');
    }

    /* ─────────────────────────────────────
     | RENDER
     ─────────────────────────────────────*/
    public function render()
    {
        return view('livewire.financeiro.relatorios.index', [
            // KPIs
            'totalIncome' => $this->totalIncome,
            'totalExpense' => $this->totalExpense,
            'balance' => $this->balance,
            'transactionCount' => $this->transactionCount,

            // Charts
            'monthlyComparison' => $this->monthlyComparison,
            'expensesByCategory' => $this->expensesByCategory,
            'incomesByCategory' => $this->incomesByCategory,
            'paymentMethods' => $this->paymentMethods,

            // Tables
            'topIncomes' => $this->topIncomes,
            'topExpenses' => $this->topExpenses,
            'categorySummary' => $this->categorySummary,
            'dailyEvolution' => $this->dailyEvolution,
        ]);
    }
}

