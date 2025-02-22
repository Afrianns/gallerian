<?php

namespace App\Livewire\Admin;

use App\Models\Image;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.admin')] 
class Approved extends Component
{
    public $approvedImage;
    
    public function mount()
    {
        $this->approvedImage = Image::where("is_reviewed", "approved")->get();
    }

    public function render()
    {
        return view('livewire.admin.approved');
    }
}
