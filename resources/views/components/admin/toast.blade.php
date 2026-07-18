<div class="toast-container" id="toastContainer"></div>

@push('scripts')
<script>
    function showToast(message, type) {
        type = type || 'success';
        var icons = { success: 'fa-check-circle', error: 'fa-circle-exclamation', warning: 'fa-triangle-exclamation' };
        var $toast = $(
            '<div class="toast-notification toast-' + type + '">' +
                '<span class="toast-icon"><i class="fa-solid ' + (icons[type] || icons.success) + '"></i></span>' +
                '<span>' + message + '</span>' +
                '<button class="toast-close"><i class="fa-solid fa-xmark"></i></button>' +
            '</div>'
        );
        $('#toastContainer').append($toast);
        setTimeout(function () {
            $toast.addClass('removing');
            setTimeout(function () { $toast.remove(); }, 300);
        }, 4000);
        $toast.find('.toast-close').on('click', function () {
            $toast.addClass('removing');
            setTimeout(function () { $toast.remove(); }, 300);
        });
    }

    @if(session('success'))
        showToast('{{ session('success') }}', 'success');
    @endif
    @if(session('error'))
        showToast('{{ session('error') }}', 'error');
    @endif
</script>
@endpush
