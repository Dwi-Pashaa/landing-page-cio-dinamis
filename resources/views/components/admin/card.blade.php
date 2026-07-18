<div {{ $attributes->merge(['class' => 'card border-0 shadow-sm']) }}>
    @if(isset($header))
        <div class="card-header bg-transparent border-bottom d-flex align-items-center justify-content-between px-4 py-3">
            @if(isset($icon))
                <i class="fa-solid {{ $icon }} me-2" style="color: #3B82F6;"></i>
            @endif
            <span class="fw-bold" style="font-size: 15px; color: var(--admin-text);">{{ $header }}</span>
            @if(isset($headerAction))
                <div>{{ $headerAction }}</div>
            @endif
        </div>
    @endif
    <div class="card-body {{ isset($flush) ? 'p-0' : 'p-4' }}">
        {{ $slot }}
    </div>
</div>
