<?php

namespace App\Livewire\Components;

use Livewire\Component;

class Search extends Component
{
    public $className = "bg-teal py-3 hover:bg-cyan-400";

    public function render()
    {
        return view('livewire.components.search');
    }
}
