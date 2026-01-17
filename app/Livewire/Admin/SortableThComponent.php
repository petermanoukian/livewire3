<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class SortableThComponent extends Component
{
    public string $field;
    public string $label;
    public string $orderField;
    public string $orderDirection;

    public function render()
    {
        return view('livewire.admin.sortable-th-component');
    }
}
