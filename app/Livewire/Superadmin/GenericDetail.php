<?php

namespace App\Livewire\Superadmin;

use App\Models\Image;
use Livewire\Component;

class GenericDetail extends Component
{

    public $currentUrl;

    public function mount()
    {
        $this->currentUrl = request()->path();
    }

    public function renderContent($prop): array
    {
        
        $image = Image::find($prop['index']);
        
        $detailImage = [
            'all' => $image,
            "UUID" => $image->user->UUID,
            "userId" => $image->user->id,
            "username" => $image->user->name
        ];
        
        if($image->is_reviewed == "rejected"){
            return ($detailImage + ['message' => $image->RejectedInfo->message]);
        } else{
            return $detailImage;
        }

    }

    public function rejectImage($id)
    {
        if($this->currentUrl){
            $this->dispatch("reject-event", index: $id)->to(Pending::class);
        }
    }

    public function approveImage($id)
    {
        if($this->currentUrl){
            $this->dispatch("approve-event", index: $id)->to(Pending::class);
        }
    }

    public function render()
    {
        return view('livewire.superadmin.generic-detail');
    }
}
