<div class="nk-block-between-md g-3">
    <div class="g">
        <ul class="pagination justify-content-center justify-content-md-start">
            <li class="page-item {{ $paginator->onFirstPage() ? 'disabled' : '' }}">
                <button class="page-link" wire:click.prevent="previousPage('{{ $paginator->getPageName() }}')">Prev</button>
            </li>

            @php
            $currentPage = $paginator->currentPage();
            $lastPage = $paginator->lastPage();
            @endphp

            @if ($currentPage > 3)
                <li class="page-item">
                    <button class="page-link" wire:click.prevent="gotoPage(1, '{{ $paginator->getPageName() }}')">1</button>
                </li>
                @if ($currentPage > 4)
                    <li class="page-item">
                        <span class="page-link"><em class="icon ni ni-more-h"></em></span>
                    </li>
                @endif
            @endif
            @php
                $startPage = $currentPage === $lastPage ? max(1, $lastPage - 9) : ($currentPage === 1 ? 1 : max(1, $currentPage - 2));
                $endPage = $currentPage === $lastPage ? $lastPage : ($currentPage === 1 ? min($currentPage + 9, $lastPage) : min($currentPage + 2, $lastPage));
            @endphp

            @for ($page = $startPage; $page <= $endPage; $page++)
                <li class="page-item {{ $page == $currentPage ? 'active' : '' }}">
                    <button class="page-link {{ $page == $currentPage ? 'text-light' : '' }}" wire:click.prevent="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')">{{ $page }}</button>
                </li>
            @endfor

            @if ($currentPage < $lastPage - 2)
                @if ($currentPage < $lastPage - 3)
                    <li class="page-item">
                        <span class="page-link"><em class="icon ni ni-more-h"></em></span>
                    </li>
                @endif
                <li class="page-item">
                    <button class="page-link" wire:click.prevent="gotoPage({{ $lastPage }}, '{{ $paginator->getPageName() }}')">{{ $lastPage }}</button>
                </li>
            @endif

            <li class="page-item {{ !$paginator->hasMorePages() ? 'disabled' : '' }}">
                <button class="page-link" wire:click.prevent="nextPage('{{ $paginator->getPageName() }}')">Next</button>
            </li>
        </ul><!-- .pagination -->
    </div>

    <div class="g tb-col-lg" wire:ignore>
        <div class="pagination-goto d-flex justify-content-center justify-content-md-start gx-3">
            <div>Page</div>
            <div>
                <select id="goToPage" class="form-select js-select2" data-search="on" data-dropdown="xs center">
                    @for ($i = 1; $i <= $paginator->lastPage(); $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div>
            <div>OF {{ $paginator->lastPage() }}</div>
        </div><!-- .pagination-goto -->
    </div><!-- .pagination-goto -->
</div><!-- .nk-block-between -->

@once
@push('scripts')
<script>
    $(document).ready(function() {
        $('#goToPage').on('change', function(e) {
            @this.set('selectAll', false);
            @this.gotoPage(e.target.value, '{{ $paginator->getPageName() }}');
        });
    });
</script>
@endpush
@endonce
