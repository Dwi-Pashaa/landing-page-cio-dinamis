<div class="modal fade" id="{{ $id }}" tabindex="-1" aria-labelledby="{{ $id }}Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered {{ $size ?? 'modal-sm' }}">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 16px;">
            @if(isset($header))
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold" id="{{ $id }}Label">{{ $header }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
            @endif
            <div class="modal-body {{ isset($header) ? '' : 'pt-4' }}">
                {{ $slot }}
            </div>
            @if(isset($footer))
                <div class="modal-footer border-0 pt-0">
                    {{ $footer }}
                </div>
            @endif
        </div>
    </div>
</div>
