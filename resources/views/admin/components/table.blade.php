@php
    $route_array = explode('.', Route::currentRouteName());
    array_pop($route_array);
    $resource_route = implode('.', $route_array);
@endphp

<div class="card shadow-lg mb-3 overflow-hidden border-primary-subtle">
    <div class="card-header bg-primary-subtle border-primary-subtle">
        {{ $items->links() }}
    </div>

    <div class="card-body p-0">
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
                        @if (isset($item->villains) && $item->villains->count())
                            @foreach ($item->villains as $villain)
                                <tr>
                                    @foreach ($columns as $column)
                                        <td class="border-bottom-0">
                                            @php
                                                $field = $column['field'];
                                                $value = $villain->pivot->{$field} ?? null; // Usa null se non esiste
                                            @endphp

                                            @if ($value)
                                                {{ $value }}
                                            @else
                                                {{ isset($column['default_content']) ? $column['default_content'] : '' }}
                                            @endif
                                        </td>
                                    @endforeach

                                    @if ($is_viewable || $is_modifiable || $is_deletable)
                                        <td class="col-1 text-center border-bottom-0">
                                            <menu class="d-flex justify-content-center gap-1">
                                                @if ($is_viewable)
                                                    <li>
                                                        @include('admin.general.button_view', [
                                                            'link' => route(
                                                                $resource_route . '.show',
                                                                $item),
                                                        ])
                                                    </li>
                                                @endif

                                                @if ($is_modifiable)
                                                    <li>
                                                        @include('admin.general.button_edit', [
                                                            'link' => route(
                                                                $resource_route . '.update',
                                                                $item),
                                                        ])
                                                    </li>
                                                @endif

                                                @if ($is_deletable)
                                                    <li>
                                                        @include('admin.general.button_delete', [
                                                            'link' => route(
                                                                $resource_route . '.destroy',
                                                                $item),
                                                        ])
                                                    </li>
                                                @endif
                                            </menu>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                @foreach ($columns as $column)
                                    <td class="border-bottom-0">
                                        {{ $item->{$column['field']} ?? (isset($column['default_content']) ? $column['default_content'] : '') }}
                                    </td>
                                @endforeach

                                @if ($is_viewable || $is_modifiable || $is_deletable)
                                    <td class="col-1 text-center border-bottom-0">
                                        <menu class="d-flex justify-content-center gap-1">
                                            @if ($is_viewable)
                                                <li>
                                                    @include('admin.general.button_view', [
                                                        'link' => route(
                                                            $resource_route . '.show',
                                                            $item),
                                                    ])
                                                </li>
                                            @endif

                                            @if ($is_modifiable)
                                                <li>
                                                    @include('admin.general.button_edit', [
                                                        'link' => route(
                                                            $resource_route . '.update',
                                                            $item),
                                                    ])
                                                </li>
                                            @endif

                                            @if ($is_deletable)
                                                <li>
                                                    @include('admin.general.button_delete', [
                                                        'link' => route(
                                                            $resource_route . '.destroy',
                                                            $item),
                                                    ])
                                                </li>
                                            @endif
                                        </menu>
                                    </td>
                                @endif
                            </tr>
                        @endif
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
