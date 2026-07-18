@props([
    'id' => 'dataTable',
    'headers' => [],
    'rows' => [],
    'searchable' => true,
    'sortable' => true,
    'entriesOptions' => [10, 25, 50, 100],
])

<div class="data-table-container" id="{{ $id }}Container">
    @if($searchable)
    <div class="table-toolbar">
        <div class="table-toolbar-left">
            <div class="search-wrapper">
                <i class="fa-solid fa-search search-icon"></i>
                <input type="text" class="form-control table-search" id="{{ $id }}Search" placeholder="Cari data..." autocomplete="off">
            </div>
        </div>
        <div class="table-toolbar-right">
            <select class="entries-select" id="{{ $id }}Entries">
                @foreach($entriesOptions as $opt)
                    <option value="{{ $opt }}" {{ $loop->first ? 'selected' : '' }}>{{ $opt }} entries</option>
                @endforeach
            </select>
        </div>
    </div>
    @endif

    <div class="data-table-wrap" id="{{ $id }}Wrap">
        <table class="data-table table-inline" id="{{ $id }}">
            <thead>
                <tr>
                    @foreach($headers as $header)
                        <th {{ isset($header['sort']) ? 'data-sort='.$header['sort'] : '' }}
                            {{ isset($header['width']) ? 'style=width:'.$header['width'] : '' }}
                            class="{{ isset($header['class']) ? $header['class'] : '' }}">
                            {{ $header['label'] }}
                            @if($sortable && isset($header['sort']))
                                <i class="fa-solid fa-sort sort-icon"></i>
                            @endif
                        </th>
                    @endforeach
                </tr>
            </thead>
            <tbody id="{{ $id }}Body">
                {{ $slot }}
            </tbody>
        </table>

        <div id="{{ $id }}EmptySearch" style="display: none;">
            <div class="empty-state">
                <div class="empty-state-icon"><i class="fa-solid fa-magnifying-glass"></i></div>
                <h3 class="empty-state-title">Tidak Ditemukan</h3>
                <p class="empty-state-desc">Tidak ada data yang cocok dengan pencarian "<span id="{{ $id }}SearchTerm"></span>".</p>
            </div>
        </div>
    </div>

    <div class="table-footer" id="{{ $id }}Footer">
        <div class="table-info" id="{{ $id }}Info">Showing 0 of 0 entries</div>
        <div class="pagination-wrapper" id="{{ $id }}Pagination"></div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function () {
        var dt = initDataTable('#{{ $id }}Container');
    });
</script>
@endpush
