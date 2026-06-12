# 💰 MF My Financial

Sistema de gestão financeira completo desenvolvido com Laravel 13 + Livewire 4 + Tailwind CSS.

## ✨ Módulos Implementados

### ✅ 1. Home / Dashboard
- Interface com assistente de IA (UI pronta)
- Cards KPI com estatísticas do Plano de Contas
- Ações rápidas e resumo mensal

### ✅ 2. Plano de Contas
- Visualização hierárquica em árvore
- 71 contas pré-cadastradas
- Filtros por tipo (Receita, Despesa, Ativo, Passivo)
- CRUD completo com modais

### ✅ 3. Lançamentos
- Registro de receitas e despesas
- Filtros avançados (período, tipo, método pagamento)
- Paginação e busca em tempo real

### ✅ 4. Relatórios (NOVO!)
- 📊 Gráficos interativos com Chart.js
- 📈 KPIs em tempo real
- 📋 Tabelas detalhadas
- 🎯 Filtros de período personalizáveis
- **Documentação:** [RELATORIOS.md](RELATORIOS.md)

## 📊 Funcionalidades dos Relatórios

### Gráficos
- Receitas vs Despesas por mês (linha)
- Top 10 Despesas por categoria (barra)
- Top 10 Receitas por categoria (barra)
- Distribuição por método de pagamento (rosca)

### Tabelas
- Top 10 maiores receitas/despesas
- Resumo estatístico por categoria
- Evolução diária com saldo

### Filtros
- Este Mês / Trimestre / Ano
- Período personalizado

## 🎨 Design System

Sistema completo de classes CSS com prefixo `nx-*`:
- Sidebar responsiva
- Cards KPI
- Modais animados
- Tree view hierárquica
- Chat interface
- Componentes de formulário

**Documentação:** [DESIGN_SYSTEM.md](DESIGN_SYSTEM.md)

## 🗄️ Banco de Dados

- **Database:** `meu_financeiro`
- **Contas:** 71 pré-cadastradas
- **Transações:** 82 de exemplo (últimos 6 meses)

### Executar Seeders

```bash
php artisan migrate:fresh --seed
```

## 🛠️ Stack Tecnológica

- **Backend:** Laravel 13, PHP 8.3
- **Frontend:** Livewire 4, Alpine.js
- **CSS:** Tailwind CSS v4
- **Charts:** Chart.js 4.4.0
- **Database:** MySQL
- **Build:** Vite

## 📁 Estrutura Principal

```
app/Livewire/
├── Home.php
└── Financeiro/
    ├── PlanoContas.php
    ├── Lancamentos.php
    └── Relatorios.php         # NOVO!

resources/views/livewire/
├── home/
├── financeiro/
    ├── plano-contas/
    ├── lancamentos/
    └── relatorios/            # NOVO!

database/seeders/
├── PlanoContasSeeder.php
└── FinancialTransactionSeeder.php
```

## 🎯 Próximos Passos

- [ ] Integração com IA no chat
- [ ] Exportação CSV/PDF
- [ ] Módulo de configurações
- [ ] Sistema de autenticação
- [ ] Notificações e alertas

## 📚 Documentação

- [IMPLEMENTATION.md](IMPLEMENTATION.md) - Detalhes da implementação
- [DESIGN_SYSTEM.md](DESIGN_SYSTEM.md) - Guia de design
- [RELATORIOS.md](RELATORIOS.md) - Módulo de relatórios

---

**Desenvolvido com Laravel 13 + Livewire 4 + Tailwind CSS v4**
