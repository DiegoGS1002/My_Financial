<?php

namespace Database\Seeders;

use App\Models\FinancialTransaction;
use App\Models\PlanOfAccount;
use Illuminate\Database\Seeder;

class FinancialTransactionSeeder extends Seeder
{
    public function run(): void
    {
        // Get selectable accounts
        $receitas = PlanOfAccount::where('type', 'receita')
            ->where('is_selectable', true)
            ->get();

        $despesas = PlanOfAccount::where('type', 'despesa')
            ->where('is_selectable', true)
            ->get();

        if ($receitas->isEmpty() || $despesas->isEmpty()) {
            $this->command->warn('⚠️ Certifique-se de ter contas do Plano de Contas cadastradas primeiro.');
            return;
        }

        // Gerar transações dos últimos 6 meses
        $transactions = [];
        $paymentMethods = ['dinheiro', 'debito', 'credito', 'pix', 'transferencia', 'boleto'];

        // Receitas mensais
        for ($month = 5; $month >= 0; $month--) {
            $date = now()->subMonths($month);

            // 3-5 receitas por mês
            for ($i = 0; $i < rand(3, 5); $i++) {
                $transactions[] = [
                    'plan_of_account_id' => $receitas->random()->id,
                    'description' => $this->getIncomeDescription(),
                    'amount' => rand(1000, 8000) + (rand(0, 99) / 100),
                    'type' => 'income',
                    'transaction_date' => $date->copy()->addDays(rand(1, 28)),
                    'payment_method' => $paymentMethods[array_rand($paymentMethods)],
                    'reference_document' => 'NF-' . rand(100000, 999999),
                ];
            }

            // 8-15 despesas por mês
            for ($i = 0; $i < rand(8, 15); $i++) {
                $transactions[] = [
                    'plan_of_account_id' => $despesas->random()->id,
                    'description' => $this->getExpenseDescription(),
                    'amount' => rand(50, 2500) + (rand(0, 99) / 100),
                    'type' => 'expense',
                    'transaction_date' => $date->copy()->addDays(rand(1, 28)),
                    'payment_method' => $paymentMethods[array_rand($paymentMethods)],
                    'reference_document' => rand(0, 1) ? 'BOL-' . rand(10000, 99999) : null,
                    'notes' => rand(0, 3) === 0 ? 'Pagamento realizado conforme previsto' : null,
                ];
            }
        }

        foreach ($transactions as $transaction) {
            FinancialTransaction::create($transaction);
        }

        $this->command->info('✅ ' . count($transactions) . ' lançamentos de exemplo criados com sucesso!');
    }

    private function getIncomeDescription(): string
    {
        $descriptions = [
            'Venda de serviço - Cliente',
            'Pagamento projeto',
            'Comissão recebida',
            'Consultoria prestada',
            'Venda de produto',
            'Prestação de serviço',
            'Recebimento de honorários',
            'Mensalidade recebida',
            'Licença de software',
            'Manutenção contratada',
        ];
        return $descriptions[array_rand($descriptions)] . ' #' . rand(100, 999);
    }

    private function getExpenseDescription(): string
    {
        $descriptions = [
            'Aluguel do escritório',
            'Energia elétrica',
            'Material de escritório',
            'Internet - pacote empresarial',
            'Manutenção equipamentos',
            'Água e saneamento',
            'Telefonia',
            'Licença de software',
            'Combustível',
            'Refeições e alimentação',
            'Serviços de contabilidade',
            'Marketing digital',
            'Hospedagem servidor',
            'Seguro empresarial',
            'Material de limpeza',
        ];
        return $descriptions[array_rand($descriptions)];
    }
}

