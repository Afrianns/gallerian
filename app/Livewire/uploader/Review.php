<?php

namespace App\Livewire\Uploader;

use App\Models\Image;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class Review extends Component
{

    public $reviewableImages = [];

    public function mount()
    {
        $this->fetchImage();
    }
    
    private function fetchImage()
    {
        $reviewable_image = Image::where('is_reviewed', 'pending')->get();
        $this->reviewableImages = $reviewable_image;
    }

    public function deleteFile($id) 
    {
        $image = Image::find($id);
        Storage::disk('public')->delete('photos/'. $image->name);
        $result = $image->delete();

        if($result){
            $this->dispatch('delete-status', success: true)->self();
            $this->fetchImage();
        } else{
            $this->dispatch('delete-status', success: false)->self();
        }
    }
    
    public function render()
    {
        return view('livewire.uploader.review');
    }
}
