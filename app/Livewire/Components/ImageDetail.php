<?php

namespace App\Livewire\Components;

use App\Models\Image;
use Livewire\Component;

class ImageDetail extends Component
{
    private $id;

    public function mount($imageID)
    {
        $this->id = $imageID;

        if($this->id == null){
            return $this->redirect('gallery', true);
        }
    }

    public function render()
    {
        return view('livewire.components.image-detail', [
            'image' => Image::find($this->id)
        ]);
    }
}
