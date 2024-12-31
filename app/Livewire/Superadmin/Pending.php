<?php

namespace App\Livewire\Superadmin;

use App\Models\Image;
use App\Models\RejectedInfo;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Layout('components.layouts.admin')] 
class Pending extends Component
{
    public $reviewableImage;

    #[Validate('required|min:5')]
    public $message;

    public function mount()
    {
        $this->getPendingImage();
    }

    private function getPendingImage()
    {
        $this->reviewableImage = Image::where('is_reviewed', 'pending')->get();
    }
    
    #[On('reject-event')]
    public function rejectImage($index)
    {
        dump('rejected', $index);
    }
    
    #[On('approve-event')]
    public function approveImage($index)
    {
        // $message = new RejectedInfo;
        dump('approved', $index);
    }

    public function setRejectMessage($imageId)
    {

        $this->validate();
        
        if(isset($imageId)){
            
            $message = RejectedInfo::create([
                "image_id" => $imageId,
                "message" => $this->message
            ]);

            $message = Image::find($imageId);

            $message->is_reviewed = "rejected";

            $result = $message->update();
        
            if($result){
                $this->redirectInfos('success',"Successfully rejected");
                $this->redirect('/su-admin', true);
            } else{
                $this->redirectInfos("error","Rejected failed");
            }
        } else{
            $this->redirectInfos("error","Rejected failed");
        }
        
    }
    
    private function redirectInfos($key, $value): void
    {
        $this->dispatch('status-sending', status: [$key, $value])->self();
    }

    public function render()
    {
        return view('livewire.superadmin.pending');
    }
}
