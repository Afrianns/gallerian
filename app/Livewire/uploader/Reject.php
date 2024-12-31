<?php

namespace App\Livewire\Uploader;
use App\Models\Image;
use Livewire\Component;

class Reject extends Component
{
    public $rejectedImages = [];

    public function mount()
    {
        $this->fetchImage();
    }
    
    private function fetchImage()
    {
        $this->rejectedImages = Image::where('is_reviewed', 'rejected')->get();
    }


    public function render()
    {
        return view('livewire.uploader.reject');
    }
}
