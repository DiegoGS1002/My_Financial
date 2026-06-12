<!DOCTYPE html>
<html lang="pt-BR" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ isset($title) ? $title . ' — MF My Financial' : 'MF My Financial' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="nx-body" x-data="{ sidebarOpen: true }">

    {{-- ═══════════════════════════════════════════════════════
         SIDEBAR
    ═══════════════════════════════════════════════════════ --}}
    <aside class="nx-sidebar" :class="sidebarOpen ? 'nx-sidebar--open' : 'nx-sidebar--closed'">

        {{-- Logo --}}
        <div class="nx-sidebar-logo">
            <div class="nx-sidebar-logo-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"
                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="12" y1="1" x2="12" y2="23"/>
                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>
                </svg>
            </div>
            <span class="nx-sidebar-logo-text" x-show="sidebarOpen">
                <span style="font-weight:800;letter-spacing:-0.02em;">MF</span>
                <span style="font-weight:400;opacity:0.7;margin-left:4px;">My Financial</span>
            </span>
        </div>

        {{-- Navigation --}}
        <nav class="nx-sidebar-nav">
            <p class="nx-sidebar-nav-label" x-show="sidebarOpen">Principal</p>

            {{-- Home --}}
            <a href="{{ route('home') }}"
               class="nx-nav-item {{ request()->routeIs('home') ? 'nx-nav-item--active' : '' }}">
                <span class="nx-nav-item-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                        <polyline points="9 22 9 12 15 12 15 22"/>
                    </svg>
                </span>
                <span class="nx-nav-item-label" x-show="sidebarOpen">Início</span>
            </a>

            <p class="nx-sidebar-nav-label" x-show="sidebarOpen" style="margin-top:20px;">Financeiro</p>

            {{-- Plano de Contas --}}
            <a href="{{ route('financeiro.plano-contas') }}"
               class="nx-nav-item {{ request()->routeIs('financeiro.plano-contas') ? 'nx-nav-item--active' : '' }}">
                <span class="nx-nav-item-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="8" y1="6" x2="21" y2="6"/>
                        <line x1="8" y1="12" x2="21" y2="12"/>
                        <line x1="8" y1="18" x2="21" y2="18"/>
                        <line x1="3" y1="6" x2="3.01" y2="6"/>
                        <line x1="3" y1="12" x2="3.01" y2="12"/>
                        <line x1="3" y1="18" x2="3.01" y2="18"/>
                    </svg>
                </span>
                <span class="nx-nav-item-label" x-show="sidebarOpen">Plano de Contas</span>
            </a>

            {{-- Lançamentos --}}
            <a href="{{ route('financeiro.lancamentos') }}"
               class="nx-nav-item {{ request()->routeIs('financeiro.lancamentos') ? 'nx-nav-item--active' : '' }}">
                <span class="nx-nav-item-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                        <line x1="16" y1="2" x2="16" y2="6"/>
                        <line x1="8" y1="2" x2="8" y2="6"/>
                        <line x1="3" y1="10" x2="21" y2="10"/>
                    </svg>
                </span>
                <span class="nx-nav-item-label" x-show="sidebarOpen">Lançamentos</span>
            </a>

            <p class="nx-sidebar-nav-label" x-show="sidebarOpen" style="margin-top:20px;">Análise</p>

            {{-- Relatórios --}}
            <a href="{{ route('financeiro.relatorios') }}"
               class="nx-nav-item {{ request()->routeIs('financeiro.relatorios') ? 'nx-nav-item--active' : '' }}">
                <span class="nx-nav-item-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="20" x2="18" y2="10"/>
                        <line x1="12" y1="20" x2="12" y2="4"/>
                        <line x1="6" y1="20" x2="6" y2="14"/>
                    </svg>
                </span>
                <span class="nx-nav-item-label" x-show="sidebarOpen">Relatórios</span>
            </a>

            <p class="nx-sidebar-nav-label" x-show="sidebarOpen" style="margin-top:20px;">Sistema</p>

            {{-- Configurações --}}
            <a href="#" class="nx-nav-item nx-nav-item--disabled">
                <span class="nx-nav-item-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="3"/>
                        <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83-2.83l.06-.06A1.65 1.65 0 0 0 4.68 15a1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 2.83-2.83l.06.06A1.65 1.65 0 0 0 9 4.68a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 2.83l-.06.06A1.65 1.65 0 0 0 19.4 9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"/>
                    </svg>
                </span>
                <span class="nx-nav-item-label" x-show="sidebarOpen">
                    Configurações
                    <span class="nx-nav-badge">Em breve</span>
                </span>
            </a>
        </nav>

        {{-- User Footer --}}
        <div class="nx-sidebar-footer" x-show="sidebarOpen">
            <div class="nx-sidebar-user">
                <div class="nx-sidebar-user-avatar">
                    {{ auth()->check() ? strtoupper(substr(auth()->user()->name, 0, 2)) : 'MF' }}
                </div>
                <div class="nx-sidebar-user-info">
                    <p class="nx-sidebar-user-name">{{ auth()->check() ? auth()->user()->name : 'My Financial' }}</p>
                    <p class="nx-sidebar-user-email">{{ auth()->check() ? auth()->user()->email : 'sistema@mf.local' }}</p>
                </div>
            </div>
        </div>

    </aside>

    {{-- ═══════════════════════════════════════════════════════
         MAIN WRAPPER
    ═══════════════════════════════════════════════════════ --}}
    <div class="nx-main-wrapper" :class="sidebarOpen ? 'nx-main-wrapper--sidebar-open' : 'nx-main-wrapper--sidebar-closed'">

        {{-- TOP HEADER --}}
        <header class="nx-header">
            <div class="nx-header-left">
                <button type="button" @click="sidebarOpen = !sidebarOpen" class="nx-header-toggle" aria-label="Toggle sidebar">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="3" y1="6" x2="21" y2="6"/>
                        <line x1="3" y1="12" x2="21" y2="12"/>
                        <line x1="3" y1="18" x2="21" y2="18"/>
                    </svg>
                </button>
                <h2 class="nx-header-title">{{ $title ?? 'MF My Financial' }}</h2>
            </div>
        </header>

        {{-- PAGE CONTENT --}}
        <main class="nx-content">
            {{ $slot }}
        </main>

    </div>

    @livewireScripts
</body>
</html>

