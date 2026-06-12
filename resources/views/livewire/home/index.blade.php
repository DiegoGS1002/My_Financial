<div style="display:flex;flex-direction:column;height:calc(100vh - 60px - 40px);gap:10px;overflow:hidden;">

    {{-- ══════════════════════════════════════════════════
         WELCOME BANNER
    ══════════════════════════════════════════════════ --}}
    <div class="nx-welcome-banner">
        <div class="nx-welcome-badge">
            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
            My Financial — Assistente Inteligente
        </div>
        <h1 class="nx-welcome-title">Olá, {{ auth()->check() ? explode(' ', auth()->user()->name)[0] : 'usuário' }}! O que vamos registrar hoje?</h1>
        <p class="nx-welcome-subtitle">
            Use o assistente abaixo para registrar receitas e despesas em linguagem natural.
            Nosso sistema irá categorizar automaticamente no seu Plano de Contas.
        </p>
    </div>

    {{-- ══════════════════════════════════════════════════
         KPI CARDS — RESUMO DO PLANO DE CONTAS
    ══════════════════════════════════════════════════ --}}
    <div class="nx-kpi-grid" style="flex-shrink:0;">

        {{-- Total de Contas --}}
        <div class="nx-kpi-card">
            <div class="nx-kpi-card-inner">
                <div class="nx-kpi-card-left">
                    <p class="nx-kpi-card-title">Total de Contas</p>
                    <p class="nx-kpi-card-value">{{ $totalAccounts }}</p>
                    <span class="nx-kpi-card-trend">Plano de Contas</span>
                </div>
                <div class="nx-kpi-card-icon" style="background:rgba(59,130,246,0.1);color:#3B82F6;border-color:rgba(59,130,246,0.2)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/></svg>
                </div>
            </div>
        </div>

        {{-- Receitas --}}
        <div class="nx-kpi-card">
            <div class="nx-kpi-card-inner">
                <div class="nx-kpi-card-left">
                    <p class="nx-kpi-card-title">Receitas</p>
                    <p class="nx-kpi-card-value" style="color:#10B981">{{ $receitaCount }}</p>
                    <span class="nx-kpi-card-trend is-positive">Contas de receita</span>
                </div>
                <div class="nx-kpi-card-icon" style="background:rgba(16,185,129,0.1);color:#10B981;border-color:rgba(16,185,129,0.2)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/></svg>
                </div>
            </div>
        </div>

        {{-- Despesas --}}
        <div class="nx-kpi-card">
            <div class="nx-kpi-card-inner">
                <div class="nx-kpi-card-left">
                    <p class="nx-kpi-card-title">Despesas</p>
                    <p class="nx-kpi-card-value" style="color:#EF4444">{{ $despesaCount }}</p>
                    <span class="nx-kpi-card-trend is-negative">Contas de despesa</span>
                </div>
                <div class="nx-kpi-card-icon" style="background:rgba(239,68,68,0.1);color:#EF4444;border-color:rgba(239,68,68,0.2)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><polyline points="23 18 13.5 8.5 8.5 13.5 1 6"/><polyline points="17 18 23 18 23 12"/></svg>
                </div>
            </div>
        </div>

        {{-- Ativos + Passivos --}}
        <div class="nx-kpi-card">
            <div class="nx-kpi-card-inner">
                <div class="nx-kpi-card-left">
                    <p class="nx-kpi-card-title">Ativos / Passivos</p>
                    <p class="nx-kpi-card-value" style="color:#8B5CF6">{{ $ativoCount }} / {{ $passivoCount }}</p>
                    <span class="nx-kpi-card-trend">Contas patrimoniais</span>
                </div>
                <div class="nx-kpi-card-icon" style="background:rgba(139,92,246,0.1);color:#8B5CF6;border-color:rgba(139,92,246,0.2)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
                </div>
            </div>
        </div>

    </div>

    {{-- ══════════════════════════════════════════════════
         MAIN AREA — CHAT + SIDEBAR
    ══════════════════════════════════════════════════ --}}
    <div class="nx-chat-layout" style="flex:1;min-height:0;">

        {{-- ── CHAT CARD ── --}}
        <div class="nx-chat-card"
             x-data="{ scrollToBottom() { this.$refs.messages && (this.$refs.messages.scrollTop = this.$refs.messages.scrollHeight) } }"
             x-init="$watch('$wire.messages', () => { $nextTick(() => scrollToBottom()) })">

            {{-- Chat header --}}
            <div style="padding:16px 20px;border-bottom:1px solid #F1F5F9;display:flex;align-items:center;justify-content:space-between;">
                <div style="display:flex;align-items:center;gap:10px;">
                    <div style="width:36px;height:36px;border-radius:10px;background:linear-gradient(135deg,#6366F1,#8B5CF6);display:flex;align-items:center;justify-content:center;color:#FFF;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2a10 10 0 0 1 10 10c0 5.52-4.48 10-10 10S2 17.52 2 12 6.48 2 12 2"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg>
                    </div>
                    <div>
                        <p style="font-size:14px;font-weight:700;color:#0F172A;">Assistente MF</p>
                        <p style="font-size:11.5px;color:#10B981;display:flex;align-items:center;gap:4px;">
                            <span style="width:6px;height:6px;border-radius:50%;background:#10B981;display:inline-block;"></span>
                            Online
                        </p>
                    </div>
                </div>
                <div style="font-size:11.5px;color:#94A3B8;">
                    Registre gastos em linguagem natural
                </div>
            </div>

            {{-- Messages --}}
            <div class="nx-chat-messages" x-ref="messages">
                @foreach($messages as $msg)
                    <div class="nx-chat-msg {{ $msg['role'] === 'ai' ? 'nx-chat-msg--ai' : 'nx-chat-msg--user' }}">
                        <div class="nx-chat-avatar {{ $msg['role'] === 'ai' ? 'nx-chat-avatar--ai' : 'nx-chat-avatar--user' }}">
                            @if($msg['role'] === 'ai')
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg>
                            @else
                                {{ auth()->check() ? strtoupper(substr(auth()->user()->name, 0, 2)) : 'EU' }}
                            @endif
                        </div>
                        <div>
                            <div class="nx-chat-bubble {{ $msg['role'] === 'ai' ? 'nx-chat-bubble--ai' : 'nx-chat-bubble--user' }}">
                                {!! nl2br(e($msg['content'])) !!}
                            </div>
                            <div style="font-size:10.5px;color:#94A3B8;margin-top:4px;{{ $msg['role'] === 'user' ? 'text-align:right;' : '' }}">
                                {{ $msg['time'] }}
                            </div>
                            @if(isset($msg['actions']) && $msg['role'] === 'ai')
                                <div class="nx-chat-quick-actions">
                                    @foreach($msg['actions'] as $action)
                                        <button type="button" class="nx-chat-quick-btn nx-chat-quick-btn--{{ $action['type'] }}">
                                            {{ $action['label'] }}
                                        </button>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach

                {{-- Typing indicator --}}
                @if($isTyping)
                    <div class="nx-chat-msg nx-chat-msg--ai">
                        <div class="nx-chat-avatar nx-chat-avatar--ai">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg>
                        </div>
                        <div class="nx-chat-bubble nx-chat-bubble--ai">
                            <div class="nx-chat-typing">
                                <span class="nx-chat-typing-dot"></span>
                                <span class="nx-chat-typing-dot"></span>
                                <span class="nx-chat-typing-dot"></span>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            {{-- Input bar --}}
            <div class="nx-chat-input-bar">
                <div class="nx-chat-input-wrap">
                    <button type="button" class="nx-chat-attach-btn" title="Anexar comprovante">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21.44 11.05l-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.83-2.83l8.49-8.48"/></svg>
                    </button>
                    <textarea
                        wire:model="message"
                        wire:keydown.enter.prevent="sendMessage"
                        rows="1"
                        placeholder="Escreva seu gasto ou ganho aqui... (ex: Almoço R$ 25 no débito)"
                        style="height:40px;"
                        x-data
                        x-on:input="$el.style.height='40px'; $el.style.height = Math.min($el.scrollHeight, 120) + 'px'"
                    ></textarea>
                </div>
                <button type="button"
                        wire:click="sendMessage"
                        wire:loading.attr="disabled"
                        class="nx-chat-send-btn"
                        title="Enviar">
                    <svg wire:loading.remove wire:target="sendMessage"
                         xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                         fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="22" y1="2" x2="11" y2="13"/>
                        <polygon points="22 2 15 22 11 13 2 9 22 2"/>
                    </svg>
                    <svg wire:loading wire:target="sendMessage" class="nx-spin"
                         xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                         fill="none" stroke="currentColor" stroke-width="2.5">
                        <path d="M21 12a9 9 0 1 1-6.219-8.56"/>
                    </svg>
                </button>
            </div>
        </div>

        {{-- ── RIGHT SIDEBAR ── --}}
        <div class="nx-chat-sidebar">

            {{-- Monthly Summary --}}
            <div class="nx-summary-card">
                <div class="nx-summary-card-header">
                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#3B82F6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
                    Resumo Mensal
                </div>
                <div class="nx-summary-row">
                    <span class="nx-summary-row-label">Receitas</span>
                    <span class="nx-summary-row-value nx-summary-row-value--income">R$ 0,00</span>
                </div>
                <div class="nx-summary-row">
                    <span class="nx-summary-row-label">Despesas</span>
                    <span class="nx-summary-row-value nx-summary-row-value--expense">R$ 0,00</span>
                </div>
                <div class="nx-summary-row" style="background:#F8FAFC;">
                    <span class="nx-summary-row-label" style="font-weight:700;color:#0F172A;">Saldo</span>
                    <span class="nx-summary-row-value nx-summary-row-value--balance" style="font-size:15px;">R$ 0,00</span>
                </div>
            </div>

            {{-- Quick Actions --}}
            <div class="nx-summary-card">
                <div class="nx-summary-card-header">
                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#10B981" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
                    Ações Rápidas
                </div>
                <div style="padding:12px;">
                    <a href="{{ route('financeiro.plano-contas') }}"
                       style="display:flex;align-items:center;gap:10px;padding:10px;border-radius:8px;border:1px solid #E2E8F0;text-decoration:none;color:inherit;transition:all 0.15s;margin-bottom:8px;"
                       onmouseover="this.style.background='#F8FAFC'" onmouseout="this.style.background='transparent'">
                        <div style="width:32px;height:32px;border-radius:8px;background:#EFF6FF;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#3B82F6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/></svg>
                        </div>
                        <div>
                            <p style="font-size:13px;font-weight:600;color:#0F172A;">Plano de Contas</p>
                            <p style="font-size:11.5px;color:#94A3B8;">{{ $totalAccounts }} contas</p>
                        </div>
                    </a>
                    <a href="{{ route('financeiro.lancamentos') }}"
                       style="display:flex;align-items:center;gap:10px;padding:10px;border-radius:8px;border:1px solid #E2E8F0;text-decoration:none;color:inherit;transition:all 0.15s;"
                       onmouseover="this.style.background='#F8FAFC'" onmouseout="this.style.background='transparent'">
                        <div style="width:32px;height:32px;border-radius:8px;background:#ECFDF5;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#10B981" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                        </div>
                        <div>
                            <p style="font-size:13px;font-weight:600;color:#0F172A;">Lançamentos</p>
                            <p style="font-size:11.5px;color:#94A3B8;">Registrar receitas/despesas</p>
                        </div>
                    </a>
                </div>
            </div>

            {{-- Recent Activity placeholder --}}
            <div class="nx-summary-card" style="flex:1;">
                <div class="nx-summary-card-header">
                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#F59E0B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
                    Atividade Recente
                </div>
                <div class="nx-empty-state" style="padding:24px;">
                    <div class="nx-empty-state-icon" style="width:40px;height:40px;margin-bottom:10px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
                    </div>
                    <p class="nx-empty-state-title" style="font-size:13px;">Sem lançamentos</p>
                    <p class="nx-empty-state-desc" style="font-size:11.5px;margin-bottom:0;">
                        Use o chat para registrar seu primeiro gasto
                    </p>
                </div>
            </div>

        </div>
    </div>


</div>

