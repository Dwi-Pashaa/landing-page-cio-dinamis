$(document).ready(function () {
    var $sidebar = $('#adminSidebar');
    var $overlay = $('#sidebarOverlay');
    var $toggle = $('#sidebarToggle');

    if ($toggle.length) {
        $toggle.on('click', function () {
            if ($(window).width() < 768) {
                $sidebar.toggleClass('show');
                $overlay.toggleClass('show');
            } else {
                $sidebar.toggleClass('collapsed');
            }
        });
    }

    if ($overlay.length) {
        $overlay.on('click', function () {
            $sidebar.removeClass('show');
            $overlay.removeClass('show');
        });
    }

    $(document).on('click', function (e) {
        if ($(window).width() < 768) {
            if (!$sidebar.is(e.target) && $sidebar.has(e.target).length === 0 &&
                !$toggle.is(e.target) && $toggle.has(e.target).length === 0) {
                if ($sidebar.hasClass('show')) {
                    $sidebar.removeClass('show');
                    $overlay.removeClass('show');
                }
            }
        }
    });

    $(document).on('click', '[data-delete]', function (e) {
        e.preventDefault();
        var $btn = $(this);
        var message = $btn.data('confirm') || 'Apakah Anda yakin ingin menghapus data ini?';
        var title = $btn.data('title') || 'Konfirmasi Hapus';

        if (typeof Swal !== 'undefined') {
            Swal.fire({
                title: title,
                text: message,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#EF4444',
                cancelButtonColor: '#64748B',
                confirmButtonText: '<i class="fa-solid fa-trash me-1"></i> Ya, Hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                customClass: {
                    popup: 'rounded-4 shadow-lg border-0',
                    confirmButton: 'btn btn-danger px-4 py-2',
                    cancelButton: 'btn btn-secondary px-4 py-2',
                },
                buttonsStyling: false,
            }).then(function (result) {
                if (result.isConfirmed) {
                    var $form = $btn.closest('form');
                    if ($form.length) {
                        if ($btn.data('ajax') !== undefined) {
                            $.ajax({
                                url: $form.attr('action'),
                                method: 'POST',
                                data: $form.serialize(),
                                success: function () {
                                    if (typeof showToast === 'function') {
                                        showToast('Data berhasil dihapus.', 'success');
                                    }
                                    setTimeout(function () { location.reload(); }, 800);
                                },
                                error: function () {
                                    if (typeof showToast === 'function') {
                                        showToast('Gagal menghapus data.', 'error');
                                    }
                                }
                            });
                        } else {
                            $form.submit();
                        }
                    }
                }
            });
        } else {
            if (confirm(message)) {
                var $form = $btn.closest('form');
                if ($form.length) {
                    if ($btn.data('ajax') !== undefined) {
                        $.ajax({
                            url: $form.attr('action'),
                            method: 'POST',
                            data: $form.serialize(),
                            success: function () { location.reload(); },
                            error: function () { alert('Gagal menghapus data.'); }
                        });
                    } else {
                        $form.submit();
                    }
                }
            }
        }
    });

    if (typeof bootstrap !== 'undefined' && bootstrap.Tooltip) {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function (el) {
            return new bootstrap.Tooltip(el);
        });
    }

    $('.toggle-switch').on('change', function () {
        $(this).closest('form').submit();
    });

    function readURL(input, previewId) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $(previewId).attr('src', e.target.result).show();
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    $('#hero_image').on('change', function () {
        readURL(this, '#heroPreview');
    });

    $('.btn-play-preview').on('click', function () {
        var iconClass = $('#icon_class').val();
        if (iconClass) {
            $('.icon-preview').attr('class', 'fa-solid ' + iconClass);
        }
    });

    $('.btn-add-fitur').on('click', function () {
        var container = $(this).closest('.dynamic-fields');
        var list = container.find('.fitur-list');
        var item = list.find('.fitur-item:first').clone();
        item.find('input').val('');
        item.find('textarea').val('');
        list.append(item);
    });

    $(document).on('click', '.btn-remove-fitur', function () {
        if ($(this).closest('.fitur-list').find('.fitur-item').length > 1) {
            $(this).closest('.fitur-item').remove();
        }
    });

    $('input[name="meta_title"], input[name$="[meta_title]"]').on('input', function () {
        var len = $(this).val().length;
        var counter = $(this).closest('.tab-pane, .card-body, form').find('.char-counter');
        if (counter.length) {
            counter.text(len + '/60');
            counter.removeClass('success danger');
            if (len > 60) counter.addClass('danger');
            else counter.addClass('success');
        }
    });

    $('textarea[name$="[meta_description]"], textarea[name="meta_description"]').on('input', function () {
        var len = $(this).val().length;
        var counter = $(this).closest('.tab-pane, .card-body, form').find('.char-counter');
        if (counter.length) {
            counter.text(len + '/160');
            counter.removeClass('success danger');
            if (len > 160) counter.addClass('danger');
            else counter.addClass('success');
        }
    });

    window.initDataTable = function (containerSelector) {
        var $container = $(containerSelector);
        if (!$container.length) return null;

        var $table = $container.find('.data-table');
        var $tbody = $container.find('table tbody');
        var $emptyRow = $container.find('#emptyRow');
        var $emptySearch = $container.find('[id$=EmptySearch]');
        var $searchInput = $container.find('.table-search');
        var $entriesSelect = $container.find('.entries-select');
        var $tableInfo = $container.find('.table-info');
        var $pagination = $container.find('.pagination-wrapper');

        if (!$table.length) return null;

        var allRows = [];
        var filteredRows = [];
        var currentPage = 1;
        var entriesPerPage = parseInt($entriesSelect.length ? $entriesSelect.val() : 10);
        var sortColumn = null;
        var sortDirection = 'asc';
        var isSearchActive = false;

        function collectRows() {
            allRows = [];
            $tbody.find('tr').each(function () {
                var $row = $(this);
                if ($row.attr('id') === 'emptyRow') return;
                if ($row.attr('data-keep') !== undefined) return;
                allRows.push($row);
            });
        }

        function getRawFiltered() {
            var q = $searchInput.length ? $searchInput.val().toLowerCase().trim() : '';
            isSearchActive = q.length > 0;
            var searchTermEl = $container.find('[id$=SearchTerm]');
            if (searchTermEl.length) searchTermEl.text(q);
            if (!q) return allRows.slice();
            return allRows.filter(function ($row) {
                var text = $row.text().toLowerCase();
                return text.indexOf(q) !== -1;
            });
        }

        function doSort(rows) {
            if (!sortColumn) return rows;
            return rows.slice().sort(function ($a, $b) {
                var $th = $table.find('thead th[data-sort="' + sortColumn + '"]');
                var idx = $th.length ? $th.index() : -1;
                if (idx < 0) return 0;
                var valA = $a.find('td').eq(idx).text().trim().toLowerCase();
                var valB = $b.find('td').eq(idx).text().trim().toLowerCase();
                if (!isNaN(valA) && !isNaN(valB)) {
                    return sortDirection === 'asc' ? parseFloat(valA) - parseFloat(valB) : parseFloat(valB) - parseFloat(valA);
                }
                return sortDirection === 'asc' ? valA.localeCompare(valB) : valB.localeCompare(valA);
            });
        }

        function render() {
            filteredRows = doSort(getRawFiltered());
            var total = filteredRows.length;
            var hasData = allRows.length > 0;

            $tbody.show();
            if ($emptySearch.length) $emptySearch.hide();

            if (isSearchActive && total === 0 && hasData) {
                if ($emptySearch.length) $emptySearch.show();
                $tbody.hide();
            }

            if ($emptyRow.length) {
                if (total === 0 && !hasData) {
                    $emptyRow.show();
                } else {
                    $emptyRow.hide();
                }
            }

            var totalPages = Math.max(1, Math.ceil(total / entriesPerPage));
            if (currentPage > totalPages) currentPage = totalPages;
            if (currentPage < 1) currentPage = 1;

            var start = (currentPage - 1) * entriesPerPage;
            var end = Math.min(start + entriesPerPage, total);
            var pageRows = filteredRows.slice(start, end);

            $tbody.find('tr').not('[data-keep]').not('#emptyRow').remove();

            if (pageRows.length > 0) {
                $.each(pageRows, function (i, $row) { $tbody.append($row); });
            }

            $tbody.find('tr[data-keep]').each(function () { $tbody.append(this); });

            if ($tableInfo.length) {
                if (total === 0) $tableInfo.text('Showing 0 of 0 entries');
                else $tableInfo.text('Showing ' + (start + 1) + ' to ' + end + ' of ' + total + ' entries');
            }

            if ($pagination.length) {
                $pagination.empty();
                if (totalPages > 1) {
                    var prevBtn = $('<button class="pagination-btn disabled"><i class="fa-solid fa-chevron-left"></i></button>');
                    if (currentPage > 1) {
                        prevBtn.removeClass('disabled').on('click', function () { currentPage--; render(); });
                    }
                    $pagination.append(prevBtn);

                    var maxVisible = 5;
                    var startP = Math.max(1, currentPage - Math.floor(maxVisible / 2));
                    var endP = Math.min(totalPages, startP + maxVisible - 1);
                    if (endP - startP < maxVisible - 1) {
                        startP = Math.max(1, endP - maxVisible + 1);
                    }
                    if (startP > 1) {
                        $pagination.append($('<button class="pagination-btn">1</button>').on('click', function () { currentPage = 1; render(); }));
                        if (startP > 2) $pagination.append($('<span class="px-1" style="color: #94a3b8;">...</span>'));
                    }
                    for (var i = startP; i <= endP; i++) {
                        var $b = $('<button class="pagination-btn">' + i + '</button>');
                        if (i === currentPage) $b.addClass('active');
                        $b.on('click', (function (p) { return function () { currentPage = p; render(); }; })(i));
                        $pagination.append($b);
                    }
                    if (endP < totalPages) {
                        if (endP < totalPages - 1) $pagination.append($('<span class="px-1" style="color: #94a3b8;">...</span>'));
                        $pagination.append($('<button class="pagination-btn">' + totalPages + '</button>').on('click', function () { currentPage = totalPages; render(); }));
                    }
                    var nextBtn = $('<button class="pagination-btn disabled"><i class="fa-solid fa-chevron-right"></i></button>');
                    if (currentPage < totalPages) {
                        nextBtn.removeClass('disabled').on('click', function () { currentPage++; render(); });
                    }
                    $pagination.append(nextBtn);
                }
            }

            if (typeof bootstrap !== 'undefined' && bootstrap.Tooltip) {
                var tips = [].slice.call($container.find('[data-bs-toggle="tooltip"]'));
                tips.map(function (el) { return new bootstrap.Tooltip(el); });
            }
        }

        if ($searchInput.length) {
            $searchInput.on('input', function () { currentPage = 1; render(); });
        }

        if ($entriesSelect.length) {
            $entriesSelect.on('change', function () {
                entriesPerPage = parseInt($(this).val());
                currentPage = 1;
                render();
            });
        }

        $table.find('thead th[data-sort]').on('click', function () {
            var col = $(this).data('sort');
            if (sortColumn === col) {
                sortDirection = sortDirection === 'asc' ? 'desc' : 'asc';
            } else {
                sortColumn = col;
                sortDirection = 'asc';
            }
            $table.find('thead th').removeClass('sort-active').find('.sort-icon').attr('class', 'fa-solid fa-sort sort-icon');
            $(this).addClass('sort-active');
            var icon = sortDirection === 'asc' ? 'sort-up' : 'sort-down';
            $(this).find('.sort-icon').attr('class', 'fa-solid fa-' + icon + ' sort-icon');
            render();
        });

        collectRows();
        render();

        return {
            refresh: function () { collectRows(); render(); },
            getFilteredCount: function () { return filteredRows.length; }
        };
    };
});
