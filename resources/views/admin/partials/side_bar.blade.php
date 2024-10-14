@php
    $side_bar_links = config('admin.side_bar_links');
@endphp

<nav class="navbar-dark bg-dark h-100 px-3 px-xxl-4 overflow-auto">
    <menu class="navbar-nav h-100">
        @foreach ($side_bar_links as $link)
            <li>
                <a href="{{ route($link['route_name']) }}"
                    class="d-flex gap-2 nav-link position-relative
                    @if (isset(explode('.', Route::currentRouteName())[1]) &&
                            explode('.', Route::currentRouteName())[1] == explode('.', $link['route_name'])[1]
                    ) active @endif">
                    <div class="flex-shrink-0">
                        {!! $link['menu_icon'] !!}
                    </div>

                    <div class="flex-shrink-0 d-none d-md-block overflow-hidden link-text">
                        {{ $link['menu_text'] }}
                    </div>

                    <!-- Fade -->
                    <div class="d-none d-md-block position-absolute top-0 end-0 w-25 h-100 text-fade"></div>
                </a>
            </li>
        @endforeach
    </menu>
</nav>
