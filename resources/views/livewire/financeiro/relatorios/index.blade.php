<div>
    {{-- PAGE HEADER --}}
    <div class="nx-page-header">
        <div class="nx-page-header-left">
            <nav class="nx-breadcrumb">
                <a href="{{ route('home') }}">Home</a>
                <span>/</span>
                <span>Relatórios</span>
            </nav>
            <h1 class="nx-page-title">📊 Relatórios Financeiros</h1>
            <p class="nx-page-subtitle">Análise completa dos dados do sistema</p>
        </div>
        <div class="nx-page-actions">
            <button wire:click="exportCSV" class="nx-btn nx-btn-ghost">
                <span>📥</span>
                <span>Exportar CSV</span>
            </button>
            <button wire:click="exportPDF" class="nx-btn nx-btn-primary">
                <span>📄</span>
                <span>Exportar PDF</span>
            </button>
        </div>
    </div>

    {{-- FILTERS --}}
    <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
        <div class="flex flex-col lg:flex-row gap-4 items-end">
            {{-- Period Buttons --}}
            <div class="flex-1">
                <label class="block text-sm font-medium text-slate-700 mb-2">Período</label>
                <div class="flex gap-2 flex-wrap">
                    <button wire:click="setPeriod('month')"
                            class="nx-btn {{ $period === 'month' ? 'nx-btn-primary' : 'nx-btn-ghost' }}">
                        Este Mês
                    </button>
                    <button wire:click="setPeriod('quarter')"
                            class="nx-btn {{ $period === 'quarter' ? 'nx-btn-primary' : 'nx-btn-ghost' }}">
                        Trimestre
                    </button>
                    <button wire:click="setPeriod('year')"
                            class="nx-btn {{ $period === 'year' ? 'nx-btn-primary' : 'nx-btn-ghost' }}">
                        Ano
                    </button>
                    <button wire:click="setPeriod('custom')"
                            class="nx-btn {{ $period === 'custom' ? 'nx-btn-primary' : 'nx-btn-ghost' }}">
                        Personalizado
                    </button>
                </div>
            </div>

            {{-- Date Range --}}
            @if($period === 'custom')
            <div class="flex gap-3">
                <div class="nx-field">
                    <label>Data Início</label>
                    <input type="date" wire:model.live="startDate" />
                </div>
                <div class="nx-field">
                    <label>Data Fim</label>
                    <input type="date" wire:model.live="endDate" />
                </div>
            </div>
            @else
            <div class="text-sm text-slate-600">
                <strong>{{ \Carbon\Carbon::parse($startDate)->format('d/m/Y') }}</strong> até
                <strong>{{ \Carbon\Carbon::parse($endDate)->format('d/m/Y') }}</strong>
            </div>
            @endif
        </div>
    </div>

    {{-- KPI CARDS --}}
    <div class="nx-kpi-grid mb-6">
        {{-- Total Receitas --}}
        <div class="nx-kpi-card">
            <div class="nx-kpi-card-inner">
                <div class="nx-kpi-card-left">
                    <p class="nx-kpi-card-title">Total Receitas</p>
                    <p class="nx-kpi-card-value" style="color: #10B981;">
                        R$ {{ number_format($totalIncome, 2, ',', '.') }}
                    </p>
                    <span class="nx-kpi-card-trend">No período selecionado</span>
                </div>
                <div class="nx-kpi-card-icon" style="background: linear-gradient(135deg, #10B981 0%, #059669 100%);">
                    <span style="font-size: 2rem;">💰</span>
                </div>
            </div>
        </div>

        {{-- Total Despesas --}}
        <div class="nx-kpi-card">
            <div class="nx-kpi-card-inner">
                <div class="nx-kpi-card-left">
                    <p class="nx-kpi-card-title">Total Despesas</p>
                    <p class="nx-kpi-card-value" style="color: #EF4444;">
                        R$ {{ number_format($totalExpense, 2, ',', '.') }}
                    </p>
                    <span class="nx-kpi-card-trend">No período selecionado</span>
                </div>
                <div class="nx-kpi-card-icon" style="background: linear-gradient(135deg, #EF4444 0%, #DC2626 100%);">
                    <span style="font-size: 2rem;">💸</span>
                </div>
            </div>
        </div>

        {{-- Saldo --}}
        <div class="nx-kpi-card">
            <div class="nx-kpi-card-inner">
                <div class="nx-kpi-card-left">
                    <p class="nx-kpi-card-title">Saldo</p>
                    <p class="nx-kpi-card-value" style="color: {{ $balance >= 0 ? '#10B981' : '#EF4444' }};">
                        R$ {{ number_format(abs($balance), 2, ',', '.') }}
                    </p>
                    <span class="nx-kpi-card-trend">{{ $balance >= 0 ? 'Positivo' : 'Negativo' }}</span>
                </div>
                <div class="nx-kpi-card-icon" style="background: linear-gradient(135deg, {{ $balance >= 0 ? '#10B981, #059669' : '#EF4444, #DC2626' }});">
                    <span style="font-size: 2rem;">{{ $balance >= 0 ? '📈' : '📉' }}</span>
                </div>
            </div>
        </div>

        {{-- Total Transações --}}
        <div class="nx-kpi-card">
            <div class="nx-kpi-card-inner">
                <div class="nx-kpi-card-left">
                    <p class="nx-kpi-card-title">Transações</p>
                    <p class="nx-kpi-card-value">{{ $transactionCount }}</p>
                    <span class="nx-kpi-card-trend">Lançamentos no período</span>
                </div>
                <div class="nx-kpi-card-icon" style="background: linear-gradient(135deg, #8B5CF6 0%, #7C3AED 100%);">
                    <span style="font-size: 2rem;">📝</span>
                </div>
            </div>
        </div>
    </div>

    {{-- CHARTS SECTION --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        {{-- Monthly Comparison Chart --}}
        <div class="bg-white rounded-lg shadow-sm p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-slate-800">📊 Receitas vs Despesas</h3>
                <span class="text-xs text-slate-500">Por Mês</span>
            </div>
            <div class="h-64">
                <canvas id="monthlyComparisonChart"></canvas>
            </div>
        </div>

        {{-- Expenses by Category Chart --}}
        <div class="bg-white rounded-lg shadow-sm p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-slate-800">🔴 Top 10 Despesas por Categoria</h3>
                <span class="text-xs text-slate-500">Total</span>
            </div>
            <div class="h-64">
                <canvas id="expensesCategoryChart"></canvas>
            </div>
        </div>

        {{-- Incomes by Category Chart --}}
        <div class="bg-white rounded-lg shadow-sm p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-slate-800">🟢 Top 10 Receitas por Categoria</h3>
                <span class="text-xs text-slate-500">Total</span>
            </div>
            <div class="h-64">
                <canvas id="incomesCategoryChart"></canvas>
            </div>
        </div>

        {{-- Payment Methods Chart --}}
        <div class="bg-white rounded-lg shadow-sm p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-slate-800">💳 Por Método de Pagamento</h3>
                <span class="text-xs text-slate-500">Distribuição</span>
            </div>
            <div class="h-64">
                <canvas id="paymentMethodsChart"></canvas>
            </div>
        </div>
    </div>

    {{-- TABLES SECTION --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        {{-- Top Incomes --}}
        <div class="bg-white rounded-lg shadow-sm p-6">
            <h3 class="text-lg font-semibold text-slate-800 mb-4">🏆 Top 10 Maiores Receitas</h3>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b">
                            <th class="text-left py-2 text-sm font-medium text-slate-600">Descrição</th>
                            <th class="text-left py-2 text-sm font-medium text-slate-600">Categoria</th>
                            <th class="text-right py-2 text-sm font-medium text-slate-600">Valor</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($topIncomes as $income)
                        <tr class="border-b hover:bg-slate-50">
                            <td class="py-3 text-sm text-slate-700">{{ $income->description }}</td>
                            <td class="py-3 text-sm text-slate-600">{{ $income->planOfAccount->name ?? '-' }}</td>
                            <td class="py-3 text-sm font-semibold text-right text-green-600">
                                R$ {{ number_format($income->amount, 2, ',', '.') }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="py-8 text-center text-slate-500">
                                Nenhuma receita encontrada no período
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Top Expenses --}}
        <div class="bg-white rounded-lg shadow-sm p-6">
            <h3 class="text-lg font-semibold text-slate-800 mb-4">🔻 Top 10 Maiores Despesas</h3>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b">
                            <th class="text-left py-2 text-sm font-medium text-slate-600">Descrição</th>
                            <th class="text-left py-2 text-sm font-medium text-slate-600">Categoria</th>
                            <th class="text-right py-2 text-sm font-medium text-slate-600">Valor</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($topExpenses as $expense)
                        <tr class="border-b hover:bg-slate-50">
                            <td class="py-3 text-sm text-slate-700">{{ $expense->description }}</td>
                            <td class="py-3 text-sm text-slate-600">{{ $expense->planOfAccount->name ?? '-' }}</td>
                            <td class="py-3 text-sm font-semibold text-right text-red-600">
                                R$ {{ number_format($expense->amount, 2, ',', '.') }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="py-8 text-center text-slate-500">
                                Nenhuma despesa encontrada no período
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- CATEGORY SUMMARY TABLE --}}
    <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
        <h3 class="text-lg font-semibold text-slate-800 mb-4">📋 Resumo por Categoria</h3>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b">
                        <th class="text-left py-2 text-sm font-medium text-slate-600">Código</th>
                        <th class="text-left py-2 text-sm font-medium text-slate-600">Categoria</th>
                        <th class="text-center py-2 text-sm font-medium text-slate-600">Tipo</th>
                        <th class="text-center py-2 text-sm font-medium text-slate-600">Qtd</th>
                        <th class="text-right py-2 text-sm font-medium text-slate-600">Total</th>
                        <th class="text-right py-2 text-sm font-medium text-slate-600">Média</th>
                        <th class="text-right py-2 text-sm font-medium text-slate-600">Mín</th>
                        <th class="text-right py-2 text-sm font-medium text-slate-600">Máx</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categorySummary as $category)
                    <tr class="border-b hover:bg-slate-50">
                        <td class="py-3 text-sm text-slate-600">{{ $category->code }}</td>
                        <td class="py-3 text-sm text-slate-700 font-medium">{{ $category->name }}</td>
                        <td class="py-3 text-center">
                            <span class="nx-tree-type-badge nx-type--{{ $category->category_type }}">
                                {{ ucfirst($category->transaction_type) }}
                            </span>
                        </td>
                        <td class="py-3 text-sm text-center text-slate-600">{{ $category->transaction_count }}</td>
                        <td class="py-3 text-sm font-semibold text-right {{ $category->transaction_type === 'income' ? 'text-green-600' : 'text-red-600' }}">
                            R$ {{ number_format($category->total, 2, ',', '.') }}
                        </td>
                        <td class="py-3 text-sm text-right text-slate-600">
                            R$ {{ number_format($category->average, 2, ',', '.') }}
                        </td>
                        <td class="py-3 text-sm text-right text-slate-600">
                            R$ {{ number_format($category->minimum, 2, ',', '.') }}
                        </td>
                        <td class="py-3 text-sm text-right text-slate-600">
                            R$ {{ number_format($category->maximum, 2, ',', '.') }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="py-8 text-center text-slate-500">
                            Nenhuma transação encontrada no período
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- DAILY EVOLUTION TABLE --}}
    <div class="bg-white rounded-lg shadow-sm p-6">
        <h3 class="text-lg font-semibold text-slate-800 mb-4">📅 Evolução Diária</h3>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b">
                        <th class="text-left py-2 text-sm font-medium text-slate-600">Data</th>
                        <th class="text-center py-2 text-sm font-medium text-slate-600">Receitas</th>
                        <th class="text-center py-2 text-sm font-medium text-slate-600">Qtd</th>
                        <th class="text-center py-2 text-sm font-medium text-slate-600">Despesas</th>
                        <th class="text-center py-2 text-sm font-medium text-slate-600">Qtd</th>
                        <th class="text-right py-2 text-sm font-medium text-slate-600">Saldo Dia</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($dailyEvolution as $date => $transactions)
                    @php
                        $incomeData = $transactions->where('type', 'income')->first();
                        $expenseData = $transactions->where('type', 'expense')->first();
                        $dailyBalance = ($incomeData->total ?? 0) - ($expenseData->total ?? 0);
                    @endphp
                    <tr class="border-b hover:bg-slate-50">
                        <td class="py-3 text-sm text-slate-700 font-medium">
                            {{ \Carbon\Carbon::parse($date)->format('d/m/Y') }}
                        </td>
                        <td class="py-3 text-sm text-right text-green-600">
                            R$ {{ number_format($incomeData->total ?? 0, 2, ',', '.') }}
                        </td>
                        <td class="py-3 text-sm text-center text-slate-600">
                            {{ $incomeData->count ?? 0 }}
                        </td>
                        <td class="py-3 text-sm text-right text-red-600">
                            R$ {{ number_format($expenseData->total ?? 0, 2, ',', '.') }}
                        </td>
                        <td class="py-3 text-sm text-center text-slate-600">
                            {{ $expenseData->count ?? 0 }}
                        </td>
                        <td class="py-3 text-sm font-semibold text-right {{ $dailyBalance >= 0 ? 'text-green-600' : 'text-red-600' }}">
                            R$ {{ number_format(abs($dailyBalance), 2, ',', '.') }}
                            <span class="text-xs">{{ $dailyBalance >= 0 ? '↑' : '↓' }}</span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-8 text-center text-slate-500">
                            Nenhuma transação encontrada no período
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- CHARTS SCRIPTS --}}
    @script
    <script>
        // Chart.js Configuration
        const chartOptions = {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: true,
                    position: 'bottom',
                },
            },
        };

        // Monthly Comparison Chart
        const monthlyCtx = document.getElementById('monthlyComparisonChart');
        if (monthlyCtx) {
            new Chart(monthlyCtx, {
                type: 'line',
                data: {
                    labels: @js($monthlyComparison['labels']),
                    datasets: [
                        {
                            label: 'Receitas',
                            data: @js($monthlyComparison['income']),
                            borderColor: '#10B981',
                            backgroundColor: 'rgba(16, 185, 129, 0.1)',
                            tension: 0.4,
                            fill: true,
                        },
                        {
                            label: 'Despesas',
                            data: @js($monthlyComparison['expense']),
                            borderColor: '#EF4444',
                            backgroundColor: 'rgba(239, 68, 68, 0.1)',
                            tension: 0.4,
                            fill: true,
                        },
                    ],
                },
                options: chartOptions,
            });
        }

        // Expenses by Category Chart
        const expensesCatCtx = document.getElementById('expensesCategoryChart');
        if (expensesCatCtx) {
            new Chart(expensesCatCtx, {
                type: 'bar',
                data: {
                    labels: @js($expensesByCategory['labels']),
                    datasets: [{
                        label: 'Despesas',
                        data: @js($expensesByCategory['values']),
                        backgroundColor: '#EF4444',
                    }],
                },
                options: {
                    ...chartOptions,
                    indexAxis: 'y',
                },
            });
        }

        // Incomes by Category Chart
        const incomesCatCtx = document.getElementById('incomesCategoryChart');
        if (incomesCatCtx) {
            new Chart(incomesCatCtx, {
                type: 'bar',
                data: {
                    labels: @js($incomesByCategory['labels']),
                    datasets: [{
                        label: 'Receitas',
                        data: @js($incomesByCategory['values']),
                        backgroundColor: '#10B981',
                    }],
                },
                options: {
                    ...chartOptions,
                    indexAxis: 'y',
                },
            });
        }

        // Payment Methods Chart
        const paymentCtx = document.getElementById('paymentMethodsChart');
        if (paymentCtx) {
            new Chart(paymentCtx, {
                type: 'doughnut',
                data: {
                    labels: @js($paymentMethods['labels']),
                    datasets: [{
                        data: @js($paymentMethods['values']),
                        backgroundColor: [
                            '#3B82F6', '#10B981', '#F59E0B', '#8B5CF6',
                            '#EF4444', '#06B6D4', '#EC4899', '#14B8A6',
                        ],
                    }],
                },
                options: chartOptions,
            });
        }
    </script>
    @endscript
</div>

