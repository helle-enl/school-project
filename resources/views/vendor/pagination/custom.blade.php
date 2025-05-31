@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="pagination-nav">
        <ul style="list-style: none; display: inline-flex; gap: 8px; padding: 0;">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li aria-disabled="true" aria-label="Previous page">
                    <span
                        style="color: #aaa; padding: 6px 12px; border-radius: 4px; border: 1px solid #ccc;">&laquo;</span>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
                        style="background:#4caf50; color:white; padding: 6px 12px; border-radius: 4px; text-decoration: none;"
                        aria-label="Previous page">&laquo;</a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li aria-disabled="true"><span style="padding: 6px 12px;">{{ $element }}</span></li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li aria-current="page">
                                <span
                                    style="background:#388e3c; color:white; padding: 6px 12px; border-radius: 4px; font-weight: 700;">{{ $page }}</span>
                            </li>
                        @else
                            <li>
                                <a href="{{ $url }}"
                                    style="padding: 6px 12px; border-radius: 4px; color:#4caf50; text-decoration: none;">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next"
                        style="background:#4caf50; color:white; padding: 6px 12px; border-radius: 4px; text-decoration: none;"
                        aria-label="Next page">&raquo;</a>
                </li>
            @else
                <li aria-disabled="true" aria-label="Next page">
                    <span
                        style="color: #aaa; padding: 6px 12px; border-radius: 4px; border: 1px solid #ccc;">&raquo;</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
