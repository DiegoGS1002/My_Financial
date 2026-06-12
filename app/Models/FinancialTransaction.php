<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class FinancialTransaction extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'plan_of_account_id',
        'description',
        'amount',
        'type',
        'transaction_date',
        'payment_method',
        'reference_document',
        'notes',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'transaction_date' => 'date',
    ];

    public const TYPE_INCOME = 'income';
    public const TYPE_EXPENSE = 'expense';

    public static function getTypeOptions(): array
    {
        return [
            self::TYPE_INCOME => 'Receita',
            self::TYPE_EXPENSE => 'Despesa',
        ];
    }

    public static function getPaymentMethods(): array
    {
        return [
            'dinheiro' => 'Dinheiro',
            'debito' => 'Cartão de Débito',
            'credito' => 'Cartão de Crédito',
            'pix' => 'PIX',
            'transferencia' => 'Transferência Bancária',
            'boleto' => 'Boleto',
            'cheque' => 'Cheque',
            'outro' => 'Outro',
        ];
    }

    public function planOfAccount(): BelongsTo
    {
        return $this->belongsTo(PlanOfAccount::class, 'plan_of_account_id');
    }

    public function getTypeLabel(): string
    {
        return self::getTypeOptions()[$this->type] ?? '-';
    }

    public function getPaymentMethodLabel(): string
    {
        return self::getPaymentMethods()[$this->payment_method] ?? '-';
    }

    public function getFormattedAmount(): string
    {
        return 'R$ ' . number_format($this->amount, 2, ',', '.');
    }
}

