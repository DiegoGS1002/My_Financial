# 📊 Módulo de Relatórios - MF My Financial

## 🎯 Visão Geral

O módulo de Relatórios fornece análises completas e visuais dos dados financeiros do sistema, com gráficos interativos, tabelas detalhadas e filtros personalizáveis.

## 🚀 Acesso

**URL:** http://localhost:9000/financeiro/relatorios

**Menu:** Sidebar → Análise → Relatórios

## ✨ Funcionalidades

### 1. Filtros de Período

Selecione facilmente o período de análise:
- **Este Mês** - Dados do mês atual
- **Trimestre** - Últimos 3 meses
- **Ano** - Últimos 12 meses
- **Personalizado** - Escolha data início e fim

### 2. KPIs (Indicadores)

Cards com informações em tempo real:
- 💰 **Total Receitas** - Soma de todas receitas no período
- 💸 **Total Despesas** - Soma de todas despesas no período
- 📈 **Saldo** - Diferença entre receitas e despesas (verde/vermelho)
- 📝 **Transações** - Quantidade total de lançamentos

### 3. Gráficos Interativos

Todos os gráficos são gerados com **Chart.js 4.4.0**:

#### 📊 Receitas vs Despesas (Linha)
- Comparação mensal de receitas e despesas
- Visualização de tendências ao longo do tempo
- Cores: Verde (receitas) e Vermelho (despesas)

#### 🔴 Top 10 Despesas por Categoria (Barra Horizontal)
- As 10 categorias com maiores gastos
- Ordenado por valor total
- Ideal para identificar onde você mais gasta

#### 🟢 Top 10 Receitas por Categoria (Barra Horizontal)
- As 10 categorias com maiores receitas
- Ordenado por valor total
- Identifique suas principais fontes de renda

#### 💳 Distribuição por Método de Pagamento (Rosca)
- Visualização percentual dos métodos usados
- Métodos disponíveis:
  - Dinheiro
  - Cartão de Débito
  - Cartão de Crédito
  - PIX
  - Transferência Bancária
  - Boleto

### 4. Tabelas Detalhadas

#### 🏆 Top 10 Maiores Receitas
Colunas:
- Descrição
- Categoria
- Valor (em verde)

#### 🔻 Top 10 Maiores Despesas
Colunas:
- Descrição
- Categoria
- Valor (em vermelho)

#### 📋 Resumo por Categoria
Estatísticas completas por categoria:
- Código da conta
- Nome da categoria
- Tipo (Receita/Despesa)
- Quantidade de transações
- Total acumulado
- Média por transação
- Valor mínimo
- Valor máximo

#### 📅 Evolução Diária
Análise dia a dia:
- Data
- Receitas do dia + quantidade
- Despesas do dia + quantidade
- Saldo do dia (verde/vermelho com seta)

### 5. Exportação (Em Desenvolvimento)

- 📥 **Exportar CSV** - Dados tabulares para Excel/Google Sheets
- 📄 **Exportar PDF** - Relatório completo em PDF

## 🎨 Design

### Cores
- **Verde (#10B981)** - Receitas / Positivo
- **Vermelho (#EF4444)** - Despesas / Negativo
- **Azul (#3B82F6)** - Geral / Primário
- **Roxo (#8B5CF6)** - Secundário

### Componentes
- Cards KPI com gradientes
- Gráficos responsivos
- Tabelas com hover effects
- Filtros intuitivos
- Layout adaptável (mobile/desktop)

## 💾 Dados

### Fonte de Dados
Todos os dados são **oficiais** do banco de dados:
- Tabela: `financial_transactions`
- Relacionamento: `plans_of_accounts`
- Período: Configurável pelo usuário

### Agregações
- **SUM** - Totais de receitas/despesas
- **COUNT** - Quantidade de transações
- **AVG** - Médias por categoria
- **MIN/MAX** - Valores extremos
- **GROUP BY** - Agrupamentos por mês/categoria/método

## 🔧 Tecnologias

### Backend
- **Laravel 13** - Framework PHP
- **Livewire 4** - Componentes reativos
- **MySQL** - Banco de dados

### Frontend
- **Tailwind CSS** - Estilização
- **Chart.js 4.4.0** - Gráficos interativos
- **Alpine.js** - Interatividade leve

## 📁 Arquivos

```
app/Livewire/Financeiro/
└── Relatorios.php               # Componente principal

resources/views/livewire/financeiro/relatorios/
└── index.blade.php              # View do relatório

routes/
└── web.php                      # Rota: /financeiro/relatorios
```

## 🎓 Como Usar

1. **Acesse o módulo** via menu lateral
2. **Selecione o período** desejado (mês, trimestre, ano ou personalizado)
3. **Analise os KPIs** no topo da página
4. **Explore os gráficos** para visualizações rápidas
5. **Consulte as tabelas** para detalhes específicos
6. **Exporte os dados** (quando disponível)

## 🔮 Melhorias Futuras

- [ ] Exportação CSV funcional
- [ ] Exportação PDF com gráficos
- [ ] Comparação entre períodos
- [ ] Projeções e previsões
- [ ] Alertas e notificações
- [ ] Dashboard customizável
- [ ] Relatórios salvos
- [ ] Compartilhamento de relatórios
- [ ] Gráficos de pizza animados
- [ ] Filtro por categoria específica
- [ ] Drill-down nos gráficos

## 📊 Exemplos de Insights

Com este módulo você pode responder:

✅ Quanto gastei este mês?
✅ Qual minha principal fonte de receita?
✅ Onde estou gastando mais?
✅ Qual método de pagamento mais uso?
✅ Qual foi meu melhor/pior dia financeiramente?
✅ Qual categoria tem maior variação de valores?
✅ Estou tendo lucro ou prejuízo?

---

**Desenvolvido com Laravel + Livewire + Chart.js**

