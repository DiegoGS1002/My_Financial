{{--
    partials/empty-state.blade.php
    Variables: $title, $description, $actionLabel (optional), $actionRoute (optional)
--}}
<div class="nx-empty-state">
    <div class="nx-empty-state-icon">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
             fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10"/>
            <line x1="12" y1="8" x2="12" y2="12"/>
            <line x1="12" y1="16" x2="12.01" y2="16"/>
        </svg>
    </div>
    <p class="nx-empty-state-title">{{ $title ?? 'Nenhum resultado' }}</p>
    <p class="nx-empty-state-desc">{{ $description ?? 'Não há dados para exibir no momento.' }}</p>
    @if(isset($actionLabel) && isset($actionRoute))
        <a href="{{ $actionRoute }}" class="nx-btn nx-btn-primary">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                 fill="none" stroke="currentColor" stroke-width="2.5">
                <line x1="12" y1="5" x2="12" y2="19"/>
                <line x1="5" y1="12" x2="19" y2="12"/>
            </svg>
            {{ $actionLabel }}
        </a>
    @endif
</div>

