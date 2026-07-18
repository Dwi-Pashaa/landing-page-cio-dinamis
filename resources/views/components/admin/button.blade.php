<button {{ $attributes->merge(['class' => 'btn btn-' . ($variant ?? 'primary') . ' btn-' . ($size ?? 'md')]) }}>
    @if(isset($icon))<i class="fa-solid {{ $icon }} me-1"></i>@endif
    {{ $slot }}
</button>
