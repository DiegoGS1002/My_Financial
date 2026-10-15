# My Financial

Aplicação web para organizar receitas e despesas, estruturar um plano de contas e acompanhar indicadores financeiros em relatórios interativos.

O projeto é desenvolvido com Laravel 13, Livewire 4 e Tailwind CSS 4. A interface está em português e reúne o fluxo financeiro em três módulos principais: plano de contas, lançamentos e relatórios.

## Funcionalidades

### Dashboard

- Resumo do plano de contas por tipo.
- Atalhos para os módulos financeiros.
- Histórico dos lançamentos mais recentes.
- Interface de assistente financeiro em formato de chat.

> O assistente usa respostas simuladas nesta versão. Ainda não há integração com um provedor de IA nem criação automática de lançamentos pelo chat.

### Plano de contas

- Estrutura hierárquica de contas e subcontas.
- Categorias de receita, despesa, ativo e passivo.
- Pesquisa e filtros por tipo e situação.
- Criação, edição e exclusão de contas.
- Controle de contas ativas e de contas disponíveis para receber lançamentos.
- Carga inicial com uma estrutura contábil de exemplo.

### Lançamentos

- Cadastro de receitas e despesas.
- Associação ao plano de contas.
- Registro de data, valor, forma de pagamento, documento de referência e observações.
- Pesquisa, paginação e filtros por período, tipo e forma de pagamento.
- Edição e exclusão de registros.

### Relatórios

- Indicadores de receitas, despesas, saldo e quantidade de lançamentos.
- Comparativo mensal de receitas e despesas.
- Ranking de receitas e despesas por categoria.
- Distribuição por forma de pagamento.
- Maiores receitas e despesas.
- Resumo estatístico por categoria e evolução diária.
- Filtros para mês, trimestre, ano ou período personalizado.

> Os botões de exportação CSV e PDF estão visíveis na interface, mas a geração dos arquivos ainda não foi implementada.

## Tecnologias

- PHP 8.3 ou superior
- Laravel 13
- Livewire 4
- MySQL
- Tailwind CSS 4
- Alpine.js
- Chart.js
- Vite 8
- Pest 4

## Requisitos

Para executar localmente:

- PHP 8.3+ com as extensões exigidas pelo Laravel e `pdo_mysql`
- Composer 2
- Node.js 20.19+ ou 22.12+
- MySQL

Como alternativa, é possível usar Docker e Docker Compose. Nesse caso, apenas Docker é necessário na máquina host.

## Instalação local

1. Instale as dependências e crie o arquivo de ambiente:

   ```bash
   composer install
   cp .env.example .env
   npm install
   ```

2. Configure o banco no `.env`. Os valores padrão esperam um MySQL local:

   ```dotenv
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=meu_financeiro
   DB_USERNAME=root
   DB_PASSWORD=
   ```

3. Gere a chave, prepare o banco e compile os assets:

   ```bash
   php artisan key:generate
   php artisan migrate --seed
   npm run build
   ```

4. Inicie o ambiente de desenvolvimento:

   ```bash
   composer run dev
   ```

A aplicação ficará disponível em `http://127.0.0.1:8000`.

O script `composer run setup` automatiza a instalação inicial, mas executa somente as migrations. Para carregar o plano de contas e os lançamentos de demonstração, rode também:

```bash
php artisan db:seed
```

## Instalação com Docker

1. Crie o arquivo de ambiente:

   ```bash
   cp .env.example .env
   ```

2. Ajuste a conexão para o serviço MySQL definido no `docker-compose.yml`:

   ```dotenv
   DB_CONNECTION=mysql
   DB_HOST=mysql
   DB_PORT=3306
   DB_DATABASE=financial
   DB_USERNAME=financial
   DB_PASSWORD=123456
   ```

3. Construa e inicie os contêineres:

   ```bash
   docker compose up -d --build
   ```

4. Instale as dependências e inicialize a aplicação:

   ```bash
   docker compose exec app composer install
   docker compose exec app npm install
   docker compose exec app php artisan key:generate
   docker compose exec app php artisan migrate --seed
   docker compose exec app npm run build
   ```

A aplicação ficará disponível em `http://localhost:8000`. O MySQL também é exposto no host pela porta `3307`.

## Comandos úteis

```bash
# Ambiente completo de desenvolvimento
composer run dev

# Servidor da aplicação, sem os demais processos
php artisan serve

# Vite em modo de desenvolvimento
npm run dev

# Build dos assets
npm run build

# Testes
composer test

# Formatação do código PHP
./vendor/bin/pint

# Recriar o banco com os dados de demonstração
php artisan migrate:fresh --seed
```

## Rotas principais

| Rota | Módulo |
| --- | --- |
| `/` | Dashboard e assistente financeiro demonstrativo |
| `/financeiro/plano-contas` | Plano de contas |
| `/financeiro/lancamentos` | Lançamentos financeiros |
| `/financeiro/relatorios` | Indicadores, gráficos e tabelas |

## Estrutura do projeto

```text
app/
├── Livewire/
│   ├── Home.php
│   └── Financeiro/
│       ├── Lancamentos.php
│       ├── PlanoContas.php
│       └── Relatorios.php
└── Models/
    ├── FinancialTransaction.php
    └── PlanOfAccount.php

database/
├── migrations/
└── seeders/
    ├── FinancialTransactionSeeder.php
    └── PlanoContasSeeder.php

resources/
├── css/app.css
├── js/app.js
└── views/
    ├── layouts/app.blade.php
    └── livewire/
```

## Dados de demonstração

O comando `php artisan migrate:fresh --seed` cria:

- um usuário de teste (`test@example.com`);
- um plano de contas hierárquico para receitas, custos, despesas, ativos e passivos;
- lançamentos aleatórios distribuídos pelos últimos seis meses.

O projeto ainda não expõe um fluxo de autenticação, portanto o usuário criado pelo seeder não é necessário para acessar os módulos atuais.

## Estado atual

Em desenvolvimento. As principais funcionalidades de cadastro, consulta e análise estão disponíveis. Integração real com IA, autenticação e exportação de relatórios permanecem pendentes.
