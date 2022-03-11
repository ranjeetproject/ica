 @if ($paginator->hasPages())
            
    <ul class="pagination">
        @if ($paginator->onFirstPage())
            <li class="page-item disabled">
                <a class="page-link"><img src="{{asset('css/images/pagi-prev.png')}}" class="img-fluid me-2" /> Prv-</a>
            </li>
        @else
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->previousPageUrl() }}"><img src="{{asset('css/images/pagi-prev.png')}}" class="img-fluid me-2" /> Prv-</a>
            </li>
        @endif
        @foreach ($elements  as $element)
            {{-- @if (is_string($element))
                <li class="page-link disabled"><a class="page-link" href="#">{{ $element }}</a></li>
            @endif --}}



            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active my-active"><span>{{ $page }}</span></li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach
        

        @if ($paginator->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->nextPageUrl() }}">-Nxt<img src="{{asset('css/images/pagi-nxt.png')}}" class="img-fluid ms-2" /></a>
            </li>
        @else
            <li class="page-item">
                <a class="page-link disabled" href="#">-Nxt<img src="{{asset('css/images/pagi-nxt.png')}}" class="img-fluid ms-2" /></a>
            </li>
        @endif
    </ul>
@endif