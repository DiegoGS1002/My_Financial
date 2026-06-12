Development Prompt: Front-end ("My Financial")
Project Context:

I am developing the front-end of a personal/business financial management system called "My Financial". The backend and Accounts Plan (Tree Structure with Synthetic and Analytical Accounts) migrations/templates are now fully ready and functional in Laravel. I need to create modular, clean and modern user interface (UI) using Tailwind CSS and Livewire (reactive components).

The interface should strictly follow the modern Single Page Application (SPA) layout with a dark navigation sidebar (Dark Sidebar) and light content area, as per the prototype reference images.

1. Estrutura Global e Layout Base (Layout Master)
   Sidebar Esquerda (Fixa):

Dark background (bg-slate-900or similar).

Logo/Name at the top: "MF My Financial".

Navigation Menu with clear active states (bg-blue-50 text-blue-600):

Home (Home icon)

Chart of Accounts (Tree icon/hierarchical list)

Releases (Calendar Icon/Extract)

Reports (Chart Icon)

Settings (Gear Icon)

Sidebar Footer: User Avatar, Name, and Email.

superior header;

Dynamic current page title.

Right side: Greeting ("Hello, [Name]"), notifications icon with badge and global search button.

2. Tela 1: Home (Interface de Chat com IA)
   Create a Livewire component for the main screen focused on the conversational experience (UI same as image5539380397110906822.jpeg).

Central Area (Chat Card):

White centered container with rounded edges and light shade.

Message History:

System/AI Message: Left Aligned, Light Gray Balloon, Robot Icon.

User Message: Right-aligned, light blue balloon, user initials.

Reactive Decision Components (AI Actions):

When the AI successfully identifies the expenditure, display quick confirmation buttons below the response (e.g., e).[Sim, Transporte 🟩][Não, outra categoria 🔄]

Input of the text (Fixo na lower part of the Card):

Expandable text field (textareaorinput) with placeholder: "Write your spend or earn here... (e.g. Lunch R$25 on debit)".

Clip icon for attachments (proofs) on the left.

Blue "Send" button with paper airplane icon on the right.

Right Sidebar (Quick Summary):

"Monthly Summary" card (Earnings, Expenses, Balance updated via polling/events).

"Recent Activity" list showing the latest releases categorized by AI.

3. Tela 2: Plano de Contas (Visualização em Árvore)
   Create a Livewire component to manage and visualize the hierarchical structure (UI same as imagewatermarked_img_16258274418616679465.png).

Top Bar do Component:

Reative search input (real tempo filter by account code).

Blue button+ Nova Conta that opens a modal.

Hierarchical Data Table/Tree:

Columns: Code, Account Name, Type (Synthetic/Analytical), Actions (Edit/Delete).

Parent accounts (Synthetic) must have an arrow icon (/) to expand/collapse children (Analytical Accounts) via Alpine.js or Livewire.chevron-downchevron-right

Automatically created or AI-suggested accounts should display a discreet badge that says "IA" next to their name.

Side Summary Panel: Unified right showing the total synthetic, analytical accounts and the overall sum.

4. Tela 3: Relatórios (Dashboards e Gráficos)
   Create the report visualization using a ready-made charting library (suggestion: Chart.js or ApexCharts integrated with Livewire) based on the imagewatermarked_img_18332298704656593102.png.

Top Filters: Date-Range (Period) Input and "Generate New" button.

Graphics Grid (Responsive Grid):

Chart 1 (Bar): "Expenses by Category (Current Month)" with colored bars for each main analytics account (Food, Transportation, Housing).

Chart 2 (Pizza/Donut): "Sources of Revenue" dividing earnings proportionally.

Graph 3 (Line - Total Width): "Evolution of the Monthly Balance" comparing the line of Revenues (blue) versus Expenses (red) over the days of the month.

Advanced Filters Side Panel: Collapsible filters for Account Type (Synthetic/Analytical), Specific Period, and checkbox for "View Details".

5. Tela 4: Configurações (Perfil e Preferências)
   Configuration interface divided into logical blocks in Grid format (UI based on the imagewatermarked_img_12762766760818556060.png).

Block 1: User Profile: Circular profile picture, name, email, buttons for "Change Password" and "Upload Photo".

Block 2: Display Preferences: Selects for Language, Theme (Light/Dark/System), and color palette for the Core Accent (Primary Color Picker).

Block 3: Account Management: List of integrated bank accounts (e.g. Itaú, Banco do Brasil icons) with connection status and+ Adicionar Conta button.

Block 4: Notifications and Alerts: Toggles/Switches styled in Tailwind to enable/disable high expense alerts, payment reminders, and monthly summaries.

Block 5: Account Summary (Subscription Status): Badge indicating active plan (e.g. "Premium Plan") and button to manage subscription.

Front-End Implementation Technical Requirements:
Tailwind CSS: All styling should be done with Tailwind utility classes, keeping the design clean, consistent spacing (p-6,space-y-4 ) and rounded corners (rounded-xl).

Alpine.js: Use for pure UI interactions that don't require a server trip (like opening/closing modals, notification dropdowns, and collapsing/expanding chart rows).

Livewire State Management: The chat input should clear the state immediately after sending (wire:model.deferorwire:keydown.enter), displaying a flashing loading state (wire:loading) while the AI agent processes the response on the backend.

Componentization: Split each screen into a separate main Livewire component within resources/views/livewire/.

Generate the complete structured HTML/Blade framework code with Tailwind for the above components, focusing on the visual fidelity of the reference images.

