<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class BaseComponent extends Component
{
    protected string $layout = 'livewire.layouts.appadmin';

    public function renderView(string $view)
    {
        return view($view)->layout($this->layout);
    }
}
