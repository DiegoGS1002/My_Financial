# MF My Financial - Design System (nx-*)

## 📐 Sistema de Classes CSS Customizadas

Todas as classes seguem o prefixo `nx-*` para evitar conflitos com Tailwind.

---

## 🎨 Layout Base

### Sidebar
```html
<aside class="nx-sidebar nx-sidebar--open">
  <div class="nx-sidebar-logo">
    <div class="nx-sidebar-logo-icon">...</div>
    <span class="nx-sidebar-logo-text">...</span>
  </div>
  
  <nav class="nx-sidebar-nav">
    <p class="nx-sidebar-nav-label">Label</p>
    <a class="nx-nav-item nx-nav-item--active">
      <span class="nx-nav-item-icon">...</span>
      <span class="nx-nav-item-label">...</span>
    </a>
  </nav>
  
  <div class="nx-sidebar-footer">...</div>
</aside>
```

### Header
```html
<header class="nx-header">
  <div class="nx-header-left">
    <button class="nx-header-toggle">...</button>
    <h2 class="nx-header-title">...</h2>
  </div>
  <div class="nx-header-right">...</div>
</header>
```

### Content Area
```html
<main class="nx-content">
  <!-- Conteúdo da página -->
</main>
```

---

## 📊 Componentes

### KPI Cards
```html
<div class="nx-kpi-grid">
  <div class="nx-kpi-card">
    <div class="nx-kpi-card-inner">
      <div class="nx-kpi-card-left">
        <p class="nx-kpi-card-title">Título</p>
        <p class="nx-kpi-card-value">100</p>
        <span class="nx-kpi-card-trend">Descrição</span>
      </div>
      <div class="nx-kpi-card-icon">...</div>
    </div>
  </div>
</div>
```

### Module Cards
```html
<div class="nx-module-grid">
  <a href="#" class="nx-module-card">
    <div class="nx-module-card-icon">...</div>
    <div>
      <p class="nx-module-card-title">Título</p>
      <p class="nx-module-card-desc">Descrição</p>
    </div>
    <div class="nx-module-card-footer">...</div>
  </a>
</div>
```

### Buttons
```html
<button class="nx-btn nx-btn-primary">Botão Primário</button>
<button class="nx-btn nx-btn-ghost">Botão Ghost</button>
```

---

## 💬 Chat Interface

### Chat Layout
```html
<div class="nx-chat-layout">
  <div class="nx-chat-card">
    <div class="nx-chat-messages">
      <!-- Mensagens -->
    </div>
    <div class="nx-chat-input-bar">
      <!-- Input -->
    </div>
  </div>
  
  <div class="nx-chat-sidebar">
    <!-- Resumo e ações -->
  </div>
</div>
```

### Chat Messages
```html
<div class="nx-chat-msg nx-chat-msg--ai">
  <div class="nx-chat-avatar nx-chat-avatar--ai">AI</div>
  <div class="nx-chat-bubble nx-chat-bubble--ai">
    Mensagem da IA
  </div>
</div>

<div class="nx-chat-msg nx-chat-msg--user">
  <div class="nx-chat-avatar nx-chat-avatar--user">EU</div>
  <div class="nx-chat-bubble nx-chat-bubble--user">
    Mensagem do usuário
  </div>
</div>
```

---

## 🌳 Tree View (Plano de Contas)

### Tree Structure
```html
<div class="nx-tree-table-header">
  <span class="nx-tree-th">Coluna</span>
</div>

<div class="nx-tree-body">
  <div class="nx-tree-row nx-tree-row--group">
    <button class="nx-tree-toggle">...</button>
    <span class="nx-tree-icon">...</span>
    <span class="nx-tree-code">1.01</span>
    <span class="nx-tree-name nx-tree-name--group">Nome</span>
    <span class="nx-tree-type-badge nx-type--receita">Receita</span>
    <span class="nx-tree-selectable-badge nx-tree-selectable--group">Sintética</span>
    <span class="nx-tree-status nx-tree-status--active">Ativo</span>
    <div class="nx-tree-actions">
      <button class="nx-tree-action-btn nx-tree-action-btn--add">+</button>
      <button class="nx-tree-action-btn nx-tree-action-btn--edit">✏️</button>
      <button class="nx-tree-action-btn nx-tree-action-btn--delete">🗑️</button>
    </div>
  </div>
</div>
```

### Type Badges
- `.nx-type--receita` - Verde (Receita)
- `.nx-type--despesa` - Vermelho (Despesa)
- `.nx-type--ativo` - Azul (Ativo)
- `.nx-type--passivo` - Amarelo (Passivo)

---

## 🎭 Modals

### Modal Structure
```html
<div class="nx-modal-overlay">
  <div class="nx-modal nx-modal-lg">
    <div class="nx-modal-header">
      <div class="nx-modal-header-left">
        <div class="nx-modal-icon-wrap">...</div>
        <div>
          <p class="nx-modal-title">Título</p>
          <p class="nx-modal-subtitle">Subtítulo</p>
        </div>
      </div>
      <button class="nx-modal-close">×</button>
    </div>
    
    <div class="nx-modal-body">
      <!-- Conteúdo -->
    </div>
    
    <div class="nx-modal-footer">
      <button class="nx-btn nx-btn-ghost">Cancelar</button>
      <button class="nx-btn nx-btn-primary">Salvar</button>
    </div>
  </div>
</div>
```

---

## 📝 Forms

### Form Fields
```html
<div class="nx-field">
  <label>
    Label <span class="nx-required">*</span>
  </label>
  <input type="text" />
  <span class="nx-field-error">Mensagem de erro</span>
  <small>Texto de ajuda</small>
</div>
```

### Toggle Switch
```html
<span class="nx-switch">
  <input type="checkbox" />
  <span class="nx-switch-track"></span>
</span>
```

---

## 🎨 Utilities

### Page Header
```html
<div class="nx-page-header">
  <div class="nx-page-header-left">
    <nav class="nx-breadcrumb">...</nav>
    <h1 class="nx-page-title">Título</h1>
    <p class="nx-page-subtitle">Subtítulo</p>
  </div>
  <div class="nx-page-actions">...</div>
</div>
```

### Welcome Banner
```html
<div class="nx-welcome-banner">
  <div class="nx-welcome-badge">Badge</div>
  <h1 class="nx-welcome-title">Título</h1>
  <p class="nx-welcome-subtitle">Subtítulo</p>
</div>
```

### Empty State
```html
<div class="nx-empty-state">
  <div class="nx-empty-state-icon">...</div>
  <p class="nx-empty-state-title">Título</p>
  <p class="nx-empty-state-desc">Descrição</p>
</div>
```

### Alerts
```html
<div class="alert-success">Mensagem de sucesso</div>
<div class="alert-error">Mensagem de erro</div>
```

---

## 🎯 Color Palette

### Primary Colors
- **Blue**: `#3B82F6` (Primary)
- **Green**: `#10B981` (Success / Receita)
- **Red**: `#EF4444` (Danger / Despesa)
- **Yellow**: `#F59E0B` (Warning / Passivo)
- **Purple**: `#8B5CF6` (Info / Accent)

### Neutrals
- **Dark**: `#0F172A` (Sidebar BG)
- **Slate**: `#64748B` (Text Secondary)
- **Gray**: `#94A3B8` (Text Muted)
- **Light**: `#F8FAFC` (Page BG)
- **White**: `#FFFFFF` (Cards BG)

---

## 📱 Responsive Breakpoints

```css
@media (max-width: 1200px) { /* Tablet */ }
@media (max-width: 1024px) { /* Small Tablet */ }
@media (max-width: 640px)  { /* Mobile */ }
```

---

## ⚡ Animations

### Transitions
- `.nx-tree-transition-enter` - Fade in + slide down
- `.nx-modal-enter` - Scale + fade in
- `.nx-spin` - Rotating animation (loading)

### Keyframes
- `@keyframes ripple` - Pulsing effect
- `@keyframes nx-bounce` - Typing dots animation
- `@keyframes nx-spin` - 360° rotation

---

**📚 Para mais detalhes, consulte: `resources/css/app.css`**

