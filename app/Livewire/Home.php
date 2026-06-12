<?php

namespace App\Livewire;

use App\Models\PlanOfAccount;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.app')]
#[Title('Início')]
class Home extends Component
{
    /* ─────────────────────────────────────
     | CHAT STATE
     ─────────────────────────────────────*/
    public string  $message     = '';
    public bool    $isTyping    = false;

    /* ─────────────────────────────────────
     | MESSAGES (in-memory for now)
     ─────────────────────────────────────*/
    public array $messages = [];

    public function mount(): void
    {
        $this->messages = [
            [
                'role'    => 'ai',
                'content' => 'Olá! 👋 Sou o assistente do **My Financial**. Posso te ajudar a registrar receitas, despesas e analisar seu financeiro. Como posso te ajudar hoje?',
                'time'    => now()->format('H:i'),
            ],
        ];
    }

    /* ─────────────────────────────────────
     | SEND MESSAGE
     ─────────────────────────────────────*/
    public function sendMessage(): void
    {
        $text = trim($this->message);
        if ($text === '') return;

        $this->messages[] = [
            'role'    => 'user',
            'content' => $text,
            'time'    => now()->format('H:i'),
        ];

        $this->message   = '';
        $this->isTyping  = true;

        // Simulate AI response (will be replaced with actual AI integration)
        $this->dispatch('ai-respond', userMessage: $text);
    }

    public function aiRespond(string $userMessage): void
    {
        // Simple demo response — will be wired to real AI later
        $responses = [
            'Entendido! Para registrar esse gasto, preciso confirmar: qual categoria você deseja usar?',
            'Ótima pergunta! Baseado no seu histórico, essa despesa se enquadra em **Alimentação**. Confirma?',
            'Registrado com sucesso! ✅ Posso ajudar com mais alguma coisa?',
            'Estou analisando seu financeiro... 📊 Você tem gastos acima da média nesta categoria este mês.',
        ];

        $this->messages[] = [
            'role'    => 'ai',
            'content' => $responses[array_rand($responses)],
            'time'    => now()->format('H:i'),
            'actions' => [
                ['label' => 'Sim, confirmar ✅', 'type' => 'yes'],
                ['label' => 'Não, outra categoria 🔄', 'type' => 'no'],
            ],
        ];

        $this->isTyping = false;
    }

    /* ─────────────────────────────────────
     | COMPUTED — SUMMARY STATS
     ─────────────────────────────────────*/
    public function getTotalAccountsProperty(): int
    {
        return PlanOfAccount::count();
    }

    public function getReceitaCountProperty(): int
    {
        return PlanOfAccount::where('type', 'receita')->count();
    }

    public function getDespesaCountProperty(): int
    {
        return PlanOfAccount::where('type', 'despesa')->count();
    }

    public function getAtivoCountProperty(): int
    {
        return PlanOfAccount::where('type', 'ativo')->count();
    }

    public function getPassivoCountProperty(): int
    {
        return PlanOfAccount::where('type', 'passivo')->count();
    }

    /* ─────────────────────────────────────
     | RENDER
     ─────────────────────────────────────*/
    public function render()
    {
        return view('livewire.home.index', [
            'totalAccounts' => $this->getTotalAccountsProperty(),
            'receitaCount'  => $this->getReceitaCountProperty(),
            'despesaCount'  => $this->getDespesaCountProperty(),
            'ativoCount'    => $this->getAtivoCountProperty(),
            'passivoCount'  => $this->getPassivoCountProperty(),
        ]);
    }
}

