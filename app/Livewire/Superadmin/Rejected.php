<?php

namespace App\Livewire\Superadmin;

use App\Models\Image;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.admin')] 
class Rejected extends Component
{
    public $all_rejected_images = [];

    public function mount()
    {
        $this->all_rejected_images = Image::where('is_reviewed', 'rejected')->get();
    }

    public function deleteImage($id)
    {
        Image::find($id);
        dump($id);
    }

    public function render()
    {
        return view('livewire.superadmin.rejected');
    }
}
