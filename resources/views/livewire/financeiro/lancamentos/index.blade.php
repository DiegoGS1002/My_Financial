<div class="nx-plano-page">

    {{-- ══════════════════════════════════════════════════
         PAGE HEADER
    ══════════════════════════════════════════════════ --}}
    <div class="nx-page-header">
        <div class="nx-page-header-left">
            <nav class="nx-breadcrumb">
                <a href="{{ route('home') }}" class="nx-breadcrumb-link">Início</a>
                <span>/</span>
                <span class="nx-breadcrumb-current">Lançamentos</span>
            </nav>
            <h1 class="nx-page-title">Lançamentos Financeiros</h1>
            <p class="nx-page-subtitle">Registre e gerencie receitas e despesas</p>
        </div>
        <div class="nx-page-actions">
            <button type="button" wire:click="create" class="nx-btn nx-btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                Novo Lançamento
            </button>
        </div>
    </div>

    {{-- ══════════════════════════════════════════════════
         KPI CARDS
    ══════════════════════════════════════════════════ --}}
    <div class="nx-kpi-grid" style="margin-bottom:20px;">

        {{-- Receitas --}}
        <div class="nx-kpi-card">
            <div class="nx-kpi-card-inner">
                <div class="nx-kpi-card-left">
                    <p class="nx-kpi-card-title">Receitas</p>
                    <p class="nx-kpi-card-value" style="color:#10B981">R$ {{ number_format($totalIncome, 2, ',', '.') }}</p>
                    <span class="nx-kpi-card-trend is-positive">Entradas no período</span>
                </div>
                <div class="nx-kpi-card-icon" style="background:rgba(16,185,129,0.1);color:#10B981;border-color:rgba(16,185,129,0.2)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/></svg>
                </div>
            </div>
        </div>

        {{-- Despesas --}}
        <div class="nx-kpi-card">
            <div class="nx-kpi-card-inner">
                <div class="nx-kpi-card-left">
                    <p class="nx-kpi-card-title">Despesas</p>
                    <p class="nx-kpi-card-value" style="color:#EF4444">R$ {{ number_format($totalExpense, 2, ',', '.') }}</p>
                    <span class="nx-kpi-card-trend is-negative">Saídas no período</span>
                </div>
                <div class="nx-kpi-card-icon" style="background:rgba(239,68,68,0.1);color:#EF4444;border-color:rgba(239,68,68,0.2)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><polyline points="23 18 13.5 8.5 8.5 13.5 1 6"/><polyline points="17 18 23 18 23 12"/></svg>
                </div>
            </div>
        </div>

        {{-- Saldo --}}
        <div class="nx-kpi-card">
            <div class="nx-kpi-card-inner">
                <div class="nx-kpi-card-left">
                    <p class="nx-kpi-card-title">Saldo</p>
                    <p class="nx-kpi-card-value" style="color:{{ $balance >= 0 ? '#3B82F6' : '#EF4444' }}">
                        R$ {{ number_format($balance, 2, ',', '.') }}
                    </p>
                    <span class="nx-kpi-card-trend">Receitas - Despesas</span>
                </div>
                <div class="nx-kpi-card-icon" style="background:rgba(59,130,246,0.1);color:#3B82F6;border-color:rgba(59,130,246,0.2)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                </div>
            </div>
        </div>

        {{-- Total de Lançamentos --}}
        <div class="nx-kpi-card">
            <div class="nx-kpi-card-inner">
                <div class="nx-kpi-card-left">
                    <p class="nx-kpi-card-title">Lançamentos</p>
                    <p class="nx-kpi-card-value">{{ $transactions->total() }}</p>
                    <span class="nx-kpi-card-trend">Total no período</span>
                </div>
                <div class="nx-kpi-card-icon" style="background:rgba(139,92,246,0.1);color:#8B5CF6;border-color:rgba(139,92,246,0.2)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                </div>
            </div>
        </div>

    </div>

    {{-- ══════════════════════════════════════════════════
         FLASH MESSAGE
    ══════════════════════════════════════════════════ --}}
    @if (session()->has('message'))
        <div class="alert-success" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
            {{ session('message') }}
        </div>
    @endif

    {{-- ══════════════════════════════════════════════════
         MAIN CARD
    ══════════════════════════════════════════════════ --}}
    <div class="nx-card nx-plano-main-card">

        {{-- FILTER BAR --}}
        <div class="nx-plano-filter-bar">

            {{-- Search --}}
            <div class="nx-plano-search-wrap">
                <svg class="nx-plano-search-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                <input type="text"
                       wire:model.live.debounce.300ms="search"
                       class="nx-plano-search-input"
                       placeholder="Buscar por descrição, conta, documento...">
                @if($search)
                    <button type="button" wire:click="$set('search', '')" class="nx-plano-search-clear">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                    </button>
                @endif
            </div>

            {{-- Date Filters --}}
            <div style="display:flex;align-items:center;gap:8px;">
                <input type="date" wire:model.live="startDate" class="nx-plano-search-input" style="width:150px;">
                <span style="color:#94A3B8;">até</span>
                <input type="date" wire:model.live="endDate" class="nx-plano-search-input" style="width:150px;">
            </div>

            {{-- Type Filter --}}
            <div class="nx-plano-type-filter">
                <button type="button"
                        wire:click="$set('filterType', '')"
                        class="nx-plano-type-btn {{ $filterType === '' ? 'nx-plano-type-btn--active' : '' }}">
                    Todos
                </button>
                <button type="button"
                        wire:click="$set('filterType', 'income')"
                        class="nx-plano-type-btn {{ $filterType === 'income' ? 'nx-plano-type-btn--active-receita' : '' }}">
                    <span class="nx-plano-type-dot" style="background:#10B981;"></span>
                    Receitas
                </button>
                <button type="button"
                        wire:click="$set('filterType', 'expense')"
                        class="nx-plano-type-btn {{ $filterType === 'expense' ? 'nx-plano-type-btn--active-despesa' : '' }}">
                    <span class="nx-plano-type-dot" style="background:#EF4444;"></span>
                    Despesas
                </button>
            </div>

            {{-- Clear Filters --}}
            @if($search || $filterType || $filterPaymentMethod)
                <button type="button" wire:click="clearFilters" class="nx-btn nx-btn-ghost" style="margin-left:auto;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                    Limpar
                </button>
            @endif
        </div>

        {{-- TABLE --}}
        <div style="overflow-x:auto;">
            <table style="width:100%;border-collapse:collapse;">
                <thead style="background:#F8FAFC;border-bottom:1px solid #F1F5F9;">
                    <tr>
                        <th style="padding:10px 16px;text-align:left;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:0.06em;color:#94A3B8;">Data</th>
                        <th style="padding:10px 16px;text-align:left;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:0.06em;color:#94A3B8;">Conta</th>
                        <th style="padding:10px 16px;text-align:left;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:0.06em;color:#94A3B8;">Descrição</th>
                        <th style="padding:10px 16px;text-align:left;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:0.06em;color:#94A3B8;">Tipo</th>
                        <th style="padding:10px 16px;text-align:right;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:0.06em;color:#94A3B8;">Valor</th>
                        <th style="padding:10px 16px;text-align:left;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:0.06em;color:#94A3B8;">Pagamento</th>
                        <th style="padding:10px 16px;text-align:center;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:0.06em;color:#94A3B8;width:100px;">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transactions as $transaction)
                        <tr style="border-bottom:1px solid #F8FAFC;transition:background 0.15s;" onmouseover="this.style.background='#F8FAFC'" onmouseout="this.style.background='transparent'">
                            <td style="padding:12px 16px;font-size:13px;color:#64748B;white-space:nowrap;">
                                {{ $transaction->transaction_date->format('d/m/Y') }}
                            </td>
                            <td style="padding:12px 16px;font-size:13px;color:#334155;">
                                <div style="display:flex;align-items:center;gap:6px;">
                                    <span style="font-family:monospace;font-size:11px;color:#64748B;">{{ $transaction->planOfAccount->code }}</span>
                                    <span>{{ $transaction->planOfAccount->name }}</span>
                                </div>
                            </td>
                            <td style="padding:12px 16px;font-size:13px;color:#0F172A;max-width:300px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;" title="{{ $transaction->description }}">
                                {{ $transaction->description }}
                                @if($transaction->reference_document)
                                    <span style="font-size:11px;color:#94A3B8;margin-left:4px;">({{ $transaction->reference_document }})</span>
                                @endif
                            </td>
                            <td style="padding:12px 16px;">
                                <span class="nx-tree-type-badge nx-type--{{ $transaction->type === 'income' ? 'receita' : 'despesa' }}">
                                    {{ $transaction->getTypeLabel() }}
                                </span>
                            </td>
                            <td style="padding:12px 16px;text-align:right;font-size:14px;font-weight:700;color:{{ $transaction->type === 'income' ? '#10B981' : '#EF4444' }};">
                                {{ $transaction->type === 'income' ? '+' : '-' }} R$ {{ number_format($transaction->amount, 2, ',', '.') }}
                            </td>
                            <td style="padding:12px 16px;font-size:12px;color:#64748B;">
                                {{ $transaction->getPaymentMethodLabel() }}
                            </td>
                            <td style="padding:12px 16px;">
                                <div style="display:flex;align-items:center;justify-content:center;gap:4px;">
                                    <button type="button" wire:click="edit({{ $transaction->id }})" class="nx-tree-action-btn nx-tree-action-btn--edit" title="Editar">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                    </button>
                                    <button type="button"
                                            wire:click="delete({{ $transaction->id }})"
                                            wire:confirm="Tem certeza que deseja excluir este lançamento?"
                                            class="nx-tree-action-btn nx-tree-action-btn--delete"
                                            title="Excluir">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">
                                @include('partials.empty-state', [
                                    'title' => 'Nenhum lançamento encontrado',
                                    'description' => 'Comece criando seu primeiro lançamento financeiro.'
                                ])
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- PAGINATION --}}
        @if($transactions->hasPages())
            <div class="nx-plano-footer">
                <span class="nx-plano-footer-count">
                    Mostrando {{ $transactions->firstItem() }} a {{ $transactions->lastItem() }} de {{ $transactions->total() }} registros
                </span>
                {{ $transactions->links() }}
            </div>
        @endif

    </div>

    {{-- ══════════════════════════════════════════════════
         CREATE/EDIT MODAL
    ══════════════════════════════════════════════════ --}}
    @if($modalOpen)
        <div class="nx-modal-overlay" wire:click.self="closeModal">
            <div class="nx-modal nx-modal-lg">

                {{-- Header --}}
                <div class="nx-modal-header">
                    <div class="nx-modal-header-left">
                        <div class="nx-modal-icon-wrap" style="background:{{ $type === 'income' ? '#ECFDF5' : '#FEF2F2' }};border:1px solid {{ $type === 'income' ? '#BBF7D0' : '#FECACA' }};">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="{{ $type === 'income' ? '#10B981' : '#EF4444' }}" stroke-width="2">
                                @if($type === 'income')
                                    <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/>
                                @else
                                    <polyline points="23 18 13.5 8.5 8.5 13.5 1 6"/><polyline points="17 18 23 18 23 12"/>
                                @endif
                            </svg>
                        </div>
                        <div>
                            <p class="nx-modal-title">{{ $editingId ? 'Editar' : 'Novo' }} Lançamento</p>
                            <p class="nx-modal-subtitle">Preencha os dados do lançamento financeiro</p>
                        </div>
                    </div>
                    <button type="button" wire:click="closeModal" class="nx-modal-close">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                    </button>
                </div>

                {{-- Body --}}
                <form wire:submit.prevent="save">
                    <div class="nx-modal-body">

                        {{-- Type --}}
                        <div class="nx-field">
                            <label>Tipo <span class="nx-required">*</span></label>
                            <div style="display:flex;gap:12px;">
                                <label style="flex:1;display:flex;align-items:center;gap:8px;padding:10px 14px;border-radius:8px;border:2px solid {{ $type === 'income' ? '#10B981' : '#E2E8F0' }};background:{{ $type === 'income' ? '#ECFDF5' : 'transparent' }};cursor:pointer;transition:all 0.15s;">
                                    <input type="radio" wire:model.live="type" value="income" style="width:16px;height:16px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#10B981" stroke-width="2"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/></svg>
                                    <span style="font-weight:600;color:{{ $type === 'income' ? '#10B981' : '#64748B' }};">Receita</span>
                                </label>
                                <label style="flex:1;display:flex;align-items:center;gap:8px;padding:10px 14px;border-radius:8px;border:2px solid {{ $type === 'expense' ? '#EF4444' : '#E2E8F0' }};background:{{ $type === 'expense' ? '#FEF2F2' : 'transparent' }};cursor:pointer;transition:all 0.15s;">
                                    <input type="radio" wire:model.live="type" value="expense" style="width:16px;height:16px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#EF4444" stroke-width="2"><polyline points="23 18 13.5 8.5 8.5 13.5 1 6"/><polyline points="17 18 23 18 23 12"/></svg>
                                    <span style="font-weight:600;color:{{ $type === 'expense' ? '#EF4444' : '#64748B' }};">Despesa</span>
                                </label>
                            </div>
                            @error('type') <span class="nx-field-error">{{ $message }}</span> @enderror
                        </div>

                        <div class="grid-2">
                            {{-- Account --}}
                            <div class="nx-field">
                                <label>Conta <span class="nx-required">*</span></label>
                                <select wire:model="plan_of_account_id">
                                    <option value="">Selecione...</option>
                                    @foreach($selectableAccounts as $account)
                                        <option value="{{ $account->id }}">{{ $account->code }} - {{ $account->name }}</option>
                                    @endforeach
                                </select>
                                @error('plan_of_account_id') <span class="nx-field-error">{{ $message }}</span> @enderror
                            </div>

                            {{-- Date --}}
                            <div class="nx-field">
                                <label>Data <span class="nx-required">*</span></label>
                                <input type="date" wire:model="transaction_date">
                                @error('transaction_date') <span class="nx-field-error">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        {{-- Description --}}
                        <div class="nx-field">
                            <label>Descrição <span class="nx-required">*</span></label>
                            <input type="text" wire:model="description" placeholder="Ex: Pagamento de fornecedor">
                            @error('description') <span class="nx-field-error">{{ $message }}</span> @enderror
                        </div>

                        <div class="grid-2">
                            {{-- Amount --}}
                            <div class="nx-field">
                                <label>Valor <span class="nx-required">*</span></label>
                                <input type="number" step="0.01" wire:model="amount" placeholder="0,00">
                                @error('amount') <span class="nx-field-error">{{ $message }}</span> @enderror
                            </div>

                            {{-- Payment Method --}}
                            <div class="nx-field">
                                <label>Forma de Pagamento</label>
                                <select wire:model="payment_method">
                                    @foreach(\App\Models\FinancialTransaction::getPaymentMethods() as $key => $label)
                                        <option value="{{ $key }}">{{ $label }}</option>
                                    @endforeach
                                </select>
                                @error('payment_method') <span class="nx-field-error">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        {{-- Reference Document --}}
                        <div class="nx-field">
                            <label>Documento de Referência</label>
                            <input type="text" wire:model="reference_document" placeholder="Ex: NF-12345, Boleto 7890">
                            <small>Número da nota fiscal, boleto, etc.</small>
                            @error('reference_document') <span class="nx-field-error">{{ $message }}</span> @enderror
                        </div>

                        {{-- Notes --}}
                        <div class="nx-field">
                            <label>Observações</label>
                            <textarea wire:model="notes" rows="3" placeholder="Informações adicionais..."></textarea>
                            @error('notes') <span class="nx-field-error">{{ $message }}</span> @enderror
                        </div>

                    </div>

                    {{-- Footer --}}
                    <div class="nx-modal-footer">
                        <button type="button" wire:click="closeModal" class="nx-btn nx-btn-ghost">Cancelar</button>
                        <button type="submit" class="nx-btn nx-btn-primary" wire:loading.attr="disabled">
                            <span wire:loading.remove>{{ $editingId ? 'Atualizar' : 'Salvar' }}</span>
                            <span wire:loading>Salvando...</span>
                        </button>
                    </div>
                </form>

            </div>
        </div>
    @endif

</div>

