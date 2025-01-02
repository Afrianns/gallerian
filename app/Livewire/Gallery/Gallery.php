<?php

namespace App\Livewire\Gallery;

use App\Models\Image;
use Livewire\Component;

class Gallery extends Component
{
    public $images;

    public function mount()
    {
        $this->images = Image::where('is_reviewed','approved')->get();
    }

    public function render()
    {
        return view('livewire.gallery.gallery');
    }
}
