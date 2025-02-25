<?php

namespace App\Livewire\Components;

use App\Models\Comment;
use App\Models\Image;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ImageDetail extends Component
{
    private $id;

    public function mount($imageID)
    {
        $this->id = $imageID;

        if($this->id == null){
            return redirect('gallery', true);
        }
    }

    public function render()
    {
        return view('livewire.components.image-detail', [
            'image' => Image::find($this->id)
        ]);
    }
}
