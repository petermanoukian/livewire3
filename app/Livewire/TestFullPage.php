<?php

namespace App\Livewire;

use Livewire\Component;

class TestFullPage extends Component
{
    public $message = '';

    public function sayHello()
    {
        $this->message = 'Hello! Livewire full-page component is working perfectly 🚀';
    }

    public function render()
    {
        return view('livewire.test-full-page');
    }
}