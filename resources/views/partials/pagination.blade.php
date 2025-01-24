@if ($paginator->hasPages())

<div class="pagination">
    @if (!$paginator->onFirstPage())
    <a href="{{ $paginator->previousPageUrl() }}" class="prevposts-link"><i class="fa fa-caret-left"></i></a>
    @endif
    @foreach ($elements as $element)
        {{-- "Three Dots" Separator --}}
        @if (is_string($element))
            <a href="javascript:;">{{ $element }}</a>
        @endif

        {{-- Array Of Links --}}
        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <a href="javascript:;" class="current-page">{{ $page }}</a>
                @else
                    <a href="{{ $url }}">{{ $page }}</a>
                @endif
            @endforeach
        @endif
    @endforeach

    @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}" class="nextposts-link"><i class="fa fa-caret-right"></i></a>
    @endif

</div>

@endif
