<?php

namespace App\Livewire\Uploader;

use App\Models\Image;
use Livewire\Component;

class Publish extends Component
{
    public $approvedImages = [];

    public function mount()
    {
        $this->fetchImage();
    }
    
    private function fetchImage()
    {
        $this->approvedImages = Image::where('is_reviewed', 'approved')->get();
    }

    public function render()
    {
        return view('livewire.uploader.publish');
    }
}
