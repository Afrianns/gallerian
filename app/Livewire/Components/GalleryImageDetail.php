<?php

namespace App\Livewire\Components;

use App\Models\Image;
use Livewire\Attributes\On;
use Livewire\Component;

class GalleryImageDetail extends Component
{
    public $image = null;
    public $totalLikes = 0;

    #[On('show-detail')]
    public function getDetailImage($index)
    {
        $this->image = Image::find($index);
        
        if($this->image){
            $this->totalLikes = $this->image->totalLikes($this->image->id);
        } else{
            session()->flash("status",['error','there is an error occur, please try again!']);
            return redirect('/gallery', true);
        }
    }

    public function resetImg()
    {
        $this->reset('image');
    }

    public function render()
    {
        return view('livewire.components.gallery-image-detail');
    }
}
