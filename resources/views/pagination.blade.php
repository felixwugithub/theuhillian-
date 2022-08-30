

@if ($paginator->hasPages())
    <ul class="pagination">

        <p>{{ "Page " . $paginator->currentPage() . "  of  " . $paginator->lastPage() }}</p>
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span>&laquo;</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev">&laquo;</a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="disabled"><span>{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                  <span>{{ $page }}</span>
                    @else
                      <a href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next">&raquo;</a>
        @else
           <span>&raquo;</span>
        @endif
    </ul>
@endif
