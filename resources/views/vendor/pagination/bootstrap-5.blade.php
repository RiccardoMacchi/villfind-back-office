<nav class="d-flex justify-items-center justify-content-between">
    <div class="d-flex justify-content-end flex-fill d-lg-none">
        <ul class="pagination mb-0">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link">
                        <i class="fa-solid fa-chevron-left"></i>
                    </span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">
                        <i class="fa-solid fa-chevron-left"></i>
                    </a>
                </li>
            @endif

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">
                        <i class="fa-solid fa-chevron-right"></i>
                    </a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link">
                        <i class="fa-solid fa-chevron-right"></i>
                    </span>
                </li>
            @endif
        </ul>
    </div>

    <div class="d-none flex-lg-fill d-lg-flex align-items-lg-center justify-content-lg-between">
        <div>
            <p class="small text-primary">
                {!! __('Showing') !!}

                @if ($paginator->total())
                    <span class="fw-semibold">{{ $paginator->firstItem() }}</span>
                    {!! __('to') !!}
                    <span class="fw-semibold">{{ $paginator->lastItem() }}</span>
                    {!! __('of') !!}
                @endif

                <span class="fw-semibold">{{ $paginator->total() }}</span>
                {!! __('results') !!}
            </p>
        </div>

        <div>
            <ul class="pagination mb-0">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li class="page-item disabled" aria-disabled="true"
                        aria-label="@lang('pagination.previous')">
                        <span class="page-link" aria-hidden="true">
                            <i class="fa-solid fa-chevron-left"></i>
                        </span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->previousPageUrl() }}"
                           rel="prev" aria-label="@lang('pagination.previous')">
                            <i class="fa-solid fa-chevron-left"></i>
                        </a>
                    </li>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <li class="page-item disabled" aria-disabled="true"><span
                                  class="page-link">{{ $element }}</span></li>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="page-item active" aria-current="page"><span
                                          class="page-link">{{ $page }}</span></li>
                            @else
                                <li class="page-item"><a class="page-link"
                                       href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next"
                           aria-label="@lang('pagination.next')">
                            <i class="fa-solid fa-chevron-right"></i>
                        </a>
                    </li>
                @else
                    <li class="page-item disabled" aria-disabled="true"
                        aria-label="@lang('pagination.next')">
                        <span class="page-link" aria-hidden="true">
                            <i class="fa-solid fa-chevron-right"></i>
                        </span>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
