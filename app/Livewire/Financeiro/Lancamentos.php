<?php

namespace App\Livewire\Financeiro;

use App\Models\FinancialTransaction;
use App\Models\PlanOfAccount;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
#[Title('Lançamentos')]
class Lancamentos extends Component
{
    use WithPagination;

    /* ─────────────────────────────────────
     | FILTERS
     ─────────────────────────────────────*/
    public string $search = '';
    public string $filterType = '';
    public string $filterPaymentMethod = '';
    public string $startDate = '';
    public string $endDate = '';

    /* ─────────────────────────────────────
     | MODAL STATE
     ─────────────────────────────────────*/
    public bool $modalOpen = false;
    public ?int $editingId = null;

    /* ─────────────────────────────────────
     | FORM FIELDS
     ─────────────────────────────────────*/
    public ?int $plan_of_account_id = null;
    public string $description = '';
    public string $amount = '';
    public string $type = 'expense';
    public string $transaction_date = '';
    public string $payment_method = 'dinheiro';
    public string $reference_document = '';
    public string $notes = '';

    public function mount(): void
    {
        $this->transaction_date = now()->format('Y-m-d');
        $this->startDate = now()->startOfMonth()->format('Y-m-d');
        $this->endDate = now()->endOfMonth()->format('Y-m-d');
    }

    /* ─────────────────────────────────────
     | RESET PAGINATION ON SEARCH
     ─────────────────────────────────────*/
    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingFilterType(): void
    {
        $this->resetPage();
    }

    public function updatingFilterPaymentMethod(): void
    {
        $this->resetPage();
    }

    public function updatingStartDate(): void
    {
        $this->resetPage();
    }

    public function updatingEndDate(): void
    {
        $this->resetPage();
    }

    /* ─────────────────────────────────────
     | CLEAR FILTERS
     ─────────────────────────────────────*/
    public function clearFilters(): void
    {
        $this->reset(['search', 'filterType', 'filterPaymentMethod']);
        $this->startDate = now()->startOfMonth()->format('Y-m-d');
        $this->endDate = now()->endOfMonth()->format('Y-m-d');
        $this->resetPage();
    }

    /* ─────────────────────────────────────
     | OPEN CREATE MODAL
     ─────────────────────────────────────*/
    public function create(): void
    {
        $this->resetForm();
        $this->modalOpen = true;
    }

    /* ─────────────────────────────────────
     | OPEN EDIT MODAL
     ─────────────────────────────────────*/
    public function edit(int $id): void
    {
        $transaction = FinancialTransaction::findOrFail($id);

        $this->editingId = $id;
        $this->plan_of_account_id = $transaction->plan_of_account_id;
        $this->description = $transaction->description;
        $this->amount = number_format($transaction->amount, 2, '.', '');
        $this->type = $transaction->type;
        $this->transaction_date = $transaction->transaction_date->format('Y-m-d');
        $this->payment_method = $transaction->payment_method ?? 'dinheiro';
        $this->reference_document = $transaction->reference_document ?? '';
        $this->notes = $transaction->notes ?? '';

        $this->modalOpen = true;
    }

    /* ─────────────────────────────────────
     | SAVE (CREATE OR UPDATE)
     ─────────────────────────────────────*/
    public function save(): void
    {
        $this->validate([
            'plan_of_account_id' => 'required|exists:plans_of_accounts,id',
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0.01',
            'type' => 'required|in:income,expense',
            'transaction_date' => 'required|date',
            'payment_method' => 'nullable|string',
            'reference_document' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);

        $data = [
            'plan_of_account_id' => $this->plan_of_account_id,
            'description' => $this->description,
            'amount' => $this->amount,
            'type' => $this->type,
            'transaction_date' => $this->transaction_date,
            'payment_method' => $this->payment_method ?: null,
            'reference_document' => $this->reference_document ?: null,
            'notes' => $this->notes ?: null,
        ];

        if ($this->editingId) {
            FinancialTransaction::findOrFail($this->editingId)->update($data);
            session()->flash('message', 'Lançamento atualizado com sucesso!');
        } else {
            FinancialTransaction::create($data);
            session()->flash('message', 'Lançamento criado com sucesso!');
        }

        $this->closeModal();
    }

    /* ─────────────────────────────────────
     | DELETE
     ─────────────────────────────────────*/
    public function delete(int $id): void
    {
        FinancialTransaction::findOrFail($id)->delete();
        session()->flash('message', 'Lançamento excluído com sucesso!');
    }

    /* ─────────────────────────────────────
     | CLOSE MODAL & RESET
     ─────────────────────────────────────*/
    public function closeModal(): void
    {
        $this->modalOpen = false;
        $this->resetForm();
    }

    protected function resetForm(): void
    {
        $this->reset([
            'editingId',
            'plan_of_account_id',
            'description',
            'amount',
            'reference_document',
            'notes',
        ]);
        $this->type = 'expense';
        $this->payment_method = 'dinheiro';
        $this->transaction_date = now()->format('Y-m-d');
        $this->resetErrorBag();
    }

    /* ─────────────────────────────────────
     | COMPUTED PROPERTIES
     ─────────────────────────────────────*/
    public function getSelectableAccountsProperty()
    {
        return PlanOfAccount::where('is_selectable', true)
            ->where('is_active', true)
            ->orderBy('code')
            ->get();
    }

    public function getTotalIncomeProperty()
    {
        return $this->getTransactionsQuery()
            ->where('type', 'income')
            ->sum('amount');
    }

    public function getTotalExpenseProperty()
    {
        return $this->getTransactionsQuery()
            ->where('type', 'expense')
            ->sum('amount');
    }

    public function getBalanceProperty()
    {
        return $this->totalIncome - $this->totalExpense;
    }

    protected function getTransactionsQuery()
    {
        $query = FinancialTransaction::query()
            ->with('planOfAccount');

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('description', 'like', '%' . $this->search . '%')
                  ->orWhere('reference_document', 'like', '%' . $this->search . '%')
                  ->orWhereHas('planOfAccount', function ($sq) {
                      $sq->where('name', 'like', '%' . $this->search . '%');
                  });
            });
        }

        if ($this->filterType) {
            $query->where('type', $this->filterType);
        }

        if ($this->filterPaymentMethod) {
            $query->where('payment_method', $this->filterPaymentMethod);
        }

        if ($this->startDate) {
            $query->where('transaction_date', '>=', $this->startDate);
        }

        if ($this->endDate) {
            $query->where('transaction_date', '<=', $this->endDate);
        }

        return $query;
    }

    /* ─────────────────────────────────────
     | RENDER
     ─────────────────────────────────────*/
    public function render()
    {
        return view('livewire.financeiro.lancamentos.index', [
            'transactions' => $this->getTransactionsQuery()
                ->orderBy('transaction_date', 'desc')
                ->orderBy('created_at', 'desc')
                ->paginate(15),
            'selectableAccounts' => $this->selectableAccounts,
            'totalIncome' => $this->totalIncome,
            'totalExpense' => $this->totalExpense,
            'balance' => $this->balance,
        ]);
    }
}

