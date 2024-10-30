@php
    $route_array = explode('.', Route::currentRouteName());
    array_pop($route_array);
    $resource_route = implode('.', $route_array);
@endphp

<div class="card shadow-lg mb-3 overflow-hidden border-primary-subtle">
    @if ($items->count())
        <div class="card-header bg-primary-subtle border-primary-subtle">
            {{ $items->links() }}
        </div>
    @endif

    <div class="card-body p-0 table-responsive">
        @if ($items->count())
            <table class="table table-striped table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        @foreach ($columns as $column)
                            <th scope="col" class="text-primary">
                                {{ $column['label'] }}
                            </th>
                        @endforeach

                        @if ($is_viewable || $is_modifiable || $is_deletable)
                            <th scope="col" class="text-center text-primary">
                                Action
                            </th>
                        @endif
                    </tr>
                </thead>
                <tbody class="align-middle">
                    @foreach ($items as $item)
                        <tr>
                            @foreach ($columns as $column)
                                <td class="border-bottom-0 text-nowrap">
                                    @php
                                        $value = $item;
                                        $parts = explode('->', $column['field']);

                                        foreach ($parts as $part) {
                                            $value = $value->{$part};
                                        }
                                    @endphp

                                    @if ($column['field'] === 'value' && isset($item->pivot->stars))
                                        {!! $item->pivot->stars !!} {{-- Renderizza le stelle gialle --}}
                                    @elseif ($column['field'] === 'pivot->formatted_created_at')
                                        <span class="short-date">{{ $item->pivot->formatted_created_at }}</span>
                                        <span class="mobile-date">{{ $item->pivot->mobile_formatted_created_at }}</span>
                                    @elseif ($value)
                                        {{ $value }}
                                    @else
                                        {{ isset($column['default_content']) ? $column['default_content'] : '~' }}
                                    @endif
                                </td>
                            @endforeach

                            @if ($is_viewable || $is_modifiable || $is_deletable)
                                <td class="col-1 text-center border-bottom-0">
                                    <menu class="d-flex justify-content-center gap-1">
                                        @if ($is_viewable)
                                            @php
                                                $value = $item;

                                                if ($is_viewable !== true) {
                                                    $parts = explode('->', $is_viewable);

                                                    foreach ($parts as $part) {
                                                        $value = $value->{$part};
                                                    }
                                                }
                                            @endphp

                                            <li>
                                                @include('admin.general.button_view', [
                                                    'link' => route($resource_route . '.show', $value),
                                                ])
                                            </li>
                                        @endif

                                        @if ($is_modifiable)
                                            @php
                                                $value = $item;

                                                if ($is_viewable !== true) {
                                                    $parts = explode('->', $is_modifiable);

                                                    foreach ($parts as $part) {
                                                        $value = $value->{$part};
                                                    }
                                                }
                                            @endphp

                                            <li>
                                                @include('admin.general.button_edit', [
                                                    'link' => route($resource_route . '.update', $value),
                                                ])
                                            </li>
                                        @endif

                                        @if ($is_deletable)
                                            @php
                                                $value = $item;

                                                if ($is_viewable !== true) {
                                                    $parts = explode('->', $is_deletable);

                                                    foreach ($parts as $part) {
                                                        $value = $value->{$part};
                                                    }
                                                }
                                            @endphp

                                            <li>
                                                @include('admin.general.button_delete', [
                                                    'link' => route($resource_route . '.destroy', $value),
                                                ])
                                            </li>
                                        @endif
                                    </menu>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-center my-3 fst-italic fw-bold text-primary">
                {{ $empty_table_message ?? 'No results to show.' }}
            </p>
        @endif
    </div>
</div>
