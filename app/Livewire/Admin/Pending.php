<?php

namespace App\Livewire\Admin;

use App\Models\Image;
use App\Models\RejectedInfo;
use App\Notifications\AcceptanceStatus;
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

    public $prevIndex = null; 

    public function mount()
    {
        $this->getPendingImage();
    }

    private function getPendingImage()
    {
        $this->reviewableImage = Image::where('is_reviewed', 'pending')->get();
    }

    #[On('approve-event')]
    public function approveImage($index)
    {

        if(!isset($index)) return;
        
        $image = Image::find($index);
        
        if(isset($image)){
            $image->is_reviewed = "approved";
            $result = $image->update();
            
            if($result){
                $image->user->notify(new AcceptanceStatus('Accepted', $image->name));

                $this->redirectInfos('success',"Successfully approved");
                $this->redirect('/su-admin', true);
            } else{
                $this->redirectInfos('error',"Approve Failed");
            }
        }
    }

    public function setRejectMessage($imageId)
    {

        $this->validate();
        
        if(isset($imageId)){
        
            
            $image = Image::find($imageId);
            
            $image->is_reviewed = "rejected";
            $result = $image->update();

            
            if($result){
                RejectedInfo::create([
                    "image_id" => $imageId,
                    "message" => $this->message
                ]);

                $image->user->notify(new AcceptanceStatus('Rejected', $image->name));

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
        return view('livewire.admin.pending');
    }
}
