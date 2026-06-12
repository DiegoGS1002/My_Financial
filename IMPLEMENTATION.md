# MF My Financial - Laravel & Livewire Application

## ✅ Implementação Completa da Página Home

A aplicação financeira **My Financial** foi criada com sucesso usando Laravel 13 + Livewire 4 + Tailwind CSS.

## 📋 O que foi implementado:

### 1. **Estrutura do Banco de Dados**
- ✅ Migração completa para a tabela `plans_of_accounts`
- ✅ Colunas adicionadas: `parent_id`, `code`, `type`, `is_selectable`, `is_active`
- ✅ Relacionamentos hierárquicos (contas pai/filho)
- ✅ Seeder com 71 contas pré-cadastradas (Receitas, Despesas, Ativos, Passivos)

### 2. **Layout Base**
- ✅ `layouts/app.blade.php` - Layout principal com:
  - Sidebar escura com navegação colapsável
  - Logo "MF My Financial"
  - Menu de navegação com ícones
  - Header superior com saudação e notificações
  - Footer do usuário na sidebar

### 3. **Sistema de Design CSS (nx-*)**
- ✅ `resources/css/app.css` - Sistema completo de classes utilitárias:
  - Sidebar (.nx-sidebar, .nx-nav-item, etc.)
  - Header (.nx-header, .nx-header-title, etc.)
  - Cards KPI (.nx-kpi-card, .nx-kpi-card-value, etc.)
  - Módulos (.nx-module-card, .nx-module-grid, etc.)
  - Chat AI (.nx-chat-card, .nx-chat-bubble, etc.)
  - Formulários (.nx-field, .nx-btn, .nx-modal, etc.)
  - Tree view para Plano de Contas (.nx-tree-row, .nx-tree-toggle, etc.)

### 4. **Página Home (Livewire Component)**
- ✅ `app/Livewire/Home.php` - Componente principal
- ✅ `resources/views/livewire/home/index.blade.php` - View com:
  - **Banner de boas-vindas** com gradiente
  - **4 Cards KPI** mostrando estatísticas do Plano de Contas:
    - Total de Contas: 71
    - Receitas: 11 contas
    - Despesas: 40 contas
    - Ativos/Passivos: 10/10 contas
  - **Interface de Chat com IA** (UI pronta, backend será integrado)
    - Histórico de mensagens
    - Input com anexo de comprovantes
    - Sidebar com resumo mensal e ações rápidas
  - **Grid de Módulos** do sistema:
    - Plano de Contas (funcional)
    - Lançamentos (em breve)
    - Relatórios (em breve)
    - Configurações (em breve)

### 5. **Plano de Contas (Livewire Component)**
- ✅ `app/Livewire/Financeiro/PlanoContas.php` - Componente funcional
- ✅ `resources/views/livewire/financeiro/plano-contas/` - Views com:
  - Visualização em árvore hierárquica
  - Filtros por tipo (Receita, Despesa, Ativo, Passivo)
  - Busca em tempo real
  - Cards KPI específicos
  - Modal de criação/edição de contas
  - Ações: Adicionar, Editar, Excluir
  - Expansão/colapso de subcontas

### 6. **Rotas Configuradas**
```php
Route::get('/', Home::class)->name('home');
Route::get('/financeiro/plano-contas', PlanoContas::class)->name('financeiro.plano-contas');
```

## 🚀 Como Executar:

### Servidor já está rodando!
O servidor PHP está ativo na porta **9000**:

```bash
# Acesse no navegador:
http://localhost:9000
```

### Ou reinicie o servidor:

```bash
# Parar processos existentes
pkill -f "php.*-S"

# Iniciar novo servidor
cd /home/dg/projects/meu_financeiro
php -S localhost:9000 -t public
```

### Build do Frontend (se necessário):
```bash
npm run build
# ou para desenvolvimento com hot-reload:
npm run dev
```

## 📊 Dados do Banco:

- **Database:** `meu_financeiro`
- **User:** `mf_user`
- **Password:** `mf_pass`
- **Contas cadastradas:** 71 (via seeder)
  - 6 categorias principais (Receitas, Custos, Despesas Operacionais, Impostos, Ativo, Passivo)
  - Estrutura hierárquica completa

## 🎨 Design System:

Todas as classes CSS seguem o padrão `nx-*` para evitar conflitos:

```css
.nx-sidebar          /* Sidebar escura */
.nx-nav-item         /* Itens de navegação */
.nx-kpi-card         /* Cards de KPI */
.nx-module-card      /* Cards de módulos */
.nx-chat-bubble      /* Balões de chat */
.nx-tree-row         /* Linhas da árvore */
.nx-btn-primary      /* Botão principal */
.nx-modal            /* Modal */
```

## 📁 Estrutura de Arquivos Criados:

```
app/Livewire/
├── Home.php
└── Financeiro/
    └── PlanoContas.php

resources/views/
├── layouts/
│   └── app.blade.php
├── livewire/
│   ├── home/
│   │   └── index.blade.php
│   └── financeiro/
│       └── plano-contas/
│           ├── index.blade.php
│           └── _tree-item.blade.php
└── partials/
    └── empty-state.blade.php

resources/css/
└── app.css (sistema nx-* completo)

database/migrations/
└── 2026_06_11_234840_add_columns_to_plans_of_accounts_table.php

database/seeders/
└── PlanoContasSeeder.php
```

## 🎯 Próximos Passos:

1. ✅ **Módulo de Relatórios** - Implementado com gráficos e dados reais
2. **Integrar IA no Chat** - Implementar backend para processar mensagens
3. **Módulo de Lançamentos** - Criar CRUD de receitas/despesas
4. **Configurações** - Perfil do usuário e preferências
5. **Autenticação** - Implementar login/registro (atualmente sem auth para desenvolvimento)

## 📊 Módulo de Relatórios (NOVO!)

### ✅ Implementado:
- **Componente Livewire:** `app/Livewire/Financeiro/Relatorios.php`
- **View:** `resources/views/livewire/financeiro/relatorios/index.blade.php`
- **Rota:** `/financeiro/relatorios`

### 📈 Funcionalidades:
- **Filtros de Período:**
  - Este Mês
  - Trimestre
  - Ano
  - Personalizado (data início/fim)

- **KPIs:**
  - Total de Receitas
  - Total de Despesas
  - Saldo (Positivo/Negativo)
  - Total de Transações

- **Gráficos (Chart.js):**
  - Receitas vs Despesas por Mês (Linha)
  - Top 10 Despesas por Categoria (Barra horizontal)
  - Top 10 Receitas por Categoria (Barra horizontal)
  - Distribuição por Método de Pagamento (Rosca)

- **Tabelas:**
  - Top 10 Maiores Receitas
  - Top 10 Maiores Despesas
  - Resumo por Categoria (com estatísticas: total, média, mín, máx)
  - Evolução Diária (receitas, despesas e saldo por dia)

- **Exportação:**
  - Botão Exportar CSV (em desenvolvimento)
  - Botão Exportar PDF (em desenvolvimento)

### 🎨 Design:
- Integrado ao Design System (nx-*)
- Gráficos responsivos com Chart.js 4.4.0
- Cards KPI com cores dinâmicas
- Tabelas com hover effects

## ✨ Recursos Implementados:

- ✅ Sidebar colapsável com animação
- ✅ Layout responsivo
- ✅ Dark mode na sidebar
- ✅ Componentes reutilizáveis
- ✅ Tree view hierárquica
- ✅ Filtros e busca em tempo real
- ✅ Modais com animações
- ✅ Cards KPI com ícones
- ✅ Interface de chat (UI pronta)
- ✅ Design system completo

## 🐛 Debug:

Se houver problemas, limpe o cache:

```bash
php artisan optimize:clear
php artisan config:clear
php artisan view:clear
```

---

**Desenvolvido com Laravel 13 + Livewire 4 + Tailwind CSS v4**

