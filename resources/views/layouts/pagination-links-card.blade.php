<div class="nk-block-between-md g-3">
    @php(isset($this->numberOfPaginatorsRendered[$paginator->getPageName()]) ? $this->numberOfPaginatorsRendered[$paginator->getPageName()]++ : ($this->numberOfPaginatorsRendered[$paginator->getPageName()] = 1))
    <div class="g">
        <ul class="pagination justify-content-center justify-content-md-start">
            @if (!$paginator->onFirstPage())
            <li class="page-item "><button class="page-link" wire:click.prevent="previousPage('{{ $paginator->getPageName() }}')">Prev</button></li>
            @else
            <li class="page-item disabled "><button class="page-link" wire:click.prevent="previousPage('{{ $paginator->getPageName() }}')">Prev</button></li>
            @endif
            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
            <li class="page-item"><span class="page-link"><em class="icon ni ni-more-h"></em></span></li>
            @endif
            {{-- Array Of Links --}}
            @if (is_array($element))
            @foreach ($element as $page => $url)
            @if ($page == $paginator->currentPage())
            <li class="page-item active"><button class="page-link" wire:click.prevent="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')">{{ $page }}</button>
            </li>
            @else
            <li class="page-item"><button class="page-link" wire:click.prevent="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')">{{ $page }}</button>
            </li>
            @endif
            @endforeach
            @endif
            @endforeach
            @if ($paginator->hasMorePages())
            <li class="page-item"><button class="page-link" wire:click.prevent="nextPage('{{ $paginator->getPageName() }}')">Next</button></li>
            @else
            <li class="page-item disabled"><button class="page-link" wire:click.prevent="nextPage('{{ $paginator->getPageName() }}')">Next</button></li>
            @endif
        </ul><!-- .pagination -->
    </div>

    <div class="g tb-col-lg" wire:ignore>
        <div class="pagination-goto d-flex justify-content-center justify-content-md-start gx-3">
            <div>Page</div>
            <div>
                <select id="goToPage" class="form-select js-select2" data-search="on" data-dropdown="xs center">
                    @for($i=1;$i<=$paginator->lastPage();$i++)
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
