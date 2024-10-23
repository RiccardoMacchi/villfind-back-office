<?php

namespace App\View\Components\Admin;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Table extends Component
{
    public $items;
    public $columns;
    public $is_viewable;
    public $is_modifiable;
    public $is_deletable;

    /**
     * Create a new component instance.
     */
    public function __construct(
        $items,
        $columns,
        $isViewable = false,
        $isModifiable = false,
        $isDeletable = false
    ) {
        $this->items = $items;
        $this->columns = $columns;
        $this->is_viewable = $isViewable;
        $this->is_modifiable = $isModifiable;
        $this->is_deletable = $isDeletable;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('admin.components.table');
    }
}
