<?php

namespace App\Livewire\Components;

use Livewire\Component;

class Search extends Component
{
    public $className = "bg-teal hover:bg-cyan-400";
    public $classNameInput = "";

    public function queryData() 
    {
        $this->dispatch('query-value')->component(ImagesShowcase::class);
        // dd($this->query);
    }

    public function render()
    {
        return view('livewire.components.search');
    }
}
