@if ($paginator->hasPages())
 
    <div class="pagination flex-m flex-w p-t-26">
        {{-- Previous Page Link 
        @if ($paginator->onFirstPage())
            <li class="disabled"><span><i class="fa fa-2x fa-chevron-left"></i></span></li>
        @else
            <li><a class="content-to-load" href="{{ $paginator->previousPageUrl() }}" rel="prev"><i class="fa fa-2x fa-chevron-left"></i></a></li>
        @endif--}}

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
                        <li class="item-pagination flex-c-m trans-0-4 active-pagination content-to-load"><span>{{ $page }}</span></li>
                    @else
                        <li><a class="item-pagination flex-c-m trans-0-4 content-to-load" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link 
        @if ($paginator->hasMorePages())
            <li><a class="content-to-load" href="{{ $paginator->nextPageUrl() }}" rel="next"><i class="fa fa-2x fa-chevron-right"></i></a></li>
        @else
            <li class="disabled"><span><i class="fa fa-2x fa-chevron-right"></i></span></li>
        @endif--}}
    </div>
@endif