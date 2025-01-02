<?php

namespace App\Livewire\Components;

use Livewire\Component;

class EditorLink extends Component
{
    public $info = '';

    public function mount($info = 'update')
    {
        $this->info = $info;
    }

    public function render()
    {
        return view('livewire.components.editor-link');
    }
}
