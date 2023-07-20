@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="pagination-container">
        <div class="pagination font-medium">
            @if ($paginator->onFirstPage())
                <span class="active">
                    {!! __('pagination.previous') !!}
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="">
                    {!! __('pagination.previous') !!}
                </a>
            @endif

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="">
                    {!! __('pagination.next') !!}
                </a>
            @else
                <span class="active">
                    {!! __('pagination.next') !!}
                </span>
            @endif
        </div>

        <div class="pagination">
            <div class="">
                <p class="font-medium">
                    {!! __('Showing') !!}
                    @if ($paginator->firstItem())
                        <span >{{ $paginator->firstItem() }}</span>
                        {!! __('to') !!}
                        <span >{{ $paginator->lastItem() }}</span>
                    @else
                        {{ $paginator->count() }}
                    @endif
                    {!! __('of') !!}
                    <span >{{ $paginator->total() }}</span>
                    {!! __('results') !!}
                </p>
            </div>
        </div>
    </nav>
@endif
