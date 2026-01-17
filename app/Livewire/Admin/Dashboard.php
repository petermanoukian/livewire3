<?php

namespace App\Livewire\Admin;

class Dashboard extends BaseComponent
{
    public function render()
    {
        // Use the helper from BaseComponent
        return $this->renderView('livewire.admin.dashboard');
    }
}
