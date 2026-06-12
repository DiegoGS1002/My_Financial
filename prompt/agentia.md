Development Prompt: AI Engine (RAG Agent + Vector + Tools)
System Context: I am developing the artificial intelligence backend for the "My Financial" system in Laravel. The database is MySQL 9.7, where the tableplano_contas has a column of the typeVECTOR to store the embeddings of the descriptions and account names (generated via OpenAI'text-embedding-3-smalls model).

Objective: Create the AI Agent logic (using OpenAI's Chat Completion API with Function Calling) that receives the user's text (e.g., "I spent R$38.50 on Uber for the office"), identifies the intention, searches for the best category in the bank by cosine similarity (Cosine Similarity), and categorizes the launch. If the category does not exist, the agent must propose creation using tools.

1. Arquitetura do Fluxo do Agente (Pipeline)
   The backend in Laravel should follow this flow with each message sent by the user in the chat:

Input Embedding Generation: User text is sent to the OpenAI API to generate its vector.

Vector Search (RAG): Run a query in MySQL 9.7 searching for the 3 closest analytical accounts using vector distance.

Context Assembly (System Prompt): Inject the accounts found into the prompt context.

Call from LLM (gpt-4oor similar): Send chat history, user input, chart of accounts context, and available Tools.

Response Processing: Treat whether the AI decided to respond directly to the user or whether it triggered a function (tool_calls).

2. Definição das Ferramentas (Tools / Function Calling)
   The OpenAI API must have access to the following Laravel system functions to interact with the database:

vincular_lancamento: Run when the AI is sure which analytical account the spend belongs to.

Arguments: conta_id (int),valor (float),tipo ('expense'|'revenue'),descricao_sugerida (string).

criar_nova_conta_analitica: Executed when the user confirms that they want to create a new subcategory.

Arguments: conta_pai_sintetica_id (int),nome_nova_conta (string),codigo_sugerido (string).

listar_contas_sinteticas_disponiveis: Run if the AI needs to ask the user which (synthetic) group they want to fit a new account into.

Arguments: None.

3. Engenharia de Prompt (System Prompt do Agente)
   This is the system prompt that should be sent to the OpenAI API:
```
Complaintext
Você é o "Assessor Financeiro IA", o núcleo de inteligência do sistema Meu Financeiro. Sua função é receber descrições de gastos ou ganhos de forma natural, extrair o valor, a intenção e classificar o registro no plano de contas do usuário.

Regras de Comportamento:
1. Extração de Dados: Sempre extraia o Valor (float), Tipo (Receita ou Despesa) e o Contexto do texto.
2. Análise de Similaridade: No contexto, você receberá as 3 contas mais próximas encontradas via busca vetorial no MySQL.
    - Se uma delas for uma correspondência exata ou altamente provável (ex: "Uber" -> "Transporte / Mobilidade Urbana"), use a tool `vincular_lancamento`.
    - Pergunte sempre ao usuário se a sugestão está correta antes de cravar, enviando as opções no texto (conforme a interface).
3. Caso de Não Existência (Nova Conta): Se o gasto não se encaixar em NENHUMA conta do plano atual:
    - Não invente um ID de conta.
    - Explique amigavelmente que essa categoria não existe.
    - Use a tool `listar_contas_sinteticas_disponiveis` para entender a estrutura e pergunte ao usuário em qual conta sintética (ex: Despesas Operacionais, Habitação, Lazer) ele gostaria de criar essa nova conta analítica, ou dê opções baseadas no que encontrou.
4. Tom de voz: Prestativo, focado em finanças, conciso e sem rodeios teóricos.

Contexto de Busca Vetorial Atual (RAG):
[INJETAR AQUI O RESULTADO DA QUERY DE VETORES DO MYSQL EX:
- ID 14: "Transporte Coletivo e Aplicativos" (Distância: 0.12)
- ID 19: "Manutenção de Veículos" (Distância: 0.45)
  ]
```  
  
4. Implementação Técnica Esperada no Laravel
   Gere or service code in Laravel (App\Services\FinancialAIService) that contemplates:

Query MySQL 9.7 with Vectors:
Example of query raw using the new MySQL 9.7 vector functions (such asVEC_DISTANCE cosine similarity operators):

```SQL
SELECT id, codigo, nome, tipo,
    VEC_DISTANCE(embedding, ?) AS distancia
FROM plano_contas
WHERE tipo = 'analitica'
ORDER BY distancia ASC
LIMIT 3;
```

OpenAI Client Integration:
Configuration of the payloadchat()->create() containing the arraytools mapping the functions mentioned in item 2.

Tool Calls Handler:
A loop thatswitch/case intercepts ifresponse->choices[0]->message->toolCalls it exists, executes the corresponding method in Laravel (e.g. saving the release to the bank), and returns the final response for the Livewire front-end to update the screen.

Safety and Performance Requirements:
Embedding Cache: To avoid repeated calls to the OpenAI API, if the user writes the exact same sentence that has already been processed recently, fetch from a cache or transaction log.

ACID Transactions: The creation of new analytical accounts through the AI tool must run within oneDB::transaction() to ensure the integrity of the chart of accounts' hierarchical codes.

Generate class structure, Vector column migrations and agent service in Laravel based on above specifications.
