<span {{ $attributes->merge(['class' => 'badge']) }}
      @if($type === 'success') style="background: #22C55E; color: #fff; box-shadow: 0 2px 8px rgba(34,197,94,0.25);"
      @elseif($type === 'danger') style="background: #EF4444; color: #fff; box-shadow: 0 2px 8px rgba(239,68,68,0.25);"
      @elseif($type === 'warning') style="background: #F59E0B; color: #fff; box-shadow: 0 2px 8px rgba(245,158,11,0.25);"
      @elseif($type === 'info') style="background: #3B82F6; color: #fff; box-shadow: 0 2px 8px rgba(59,130,246,0.25);"
      @else style="background: #F1F5F9; color: #475569;"
      @endif>
    @if(isset($icon))<i class="fa-solid {{ $icon }} me-1"></i>@endif
    {{ $slot }}
</span>
