<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class Profile extends Component
{

    use WithFileUploads;

    public $images;
    public $profile;

    #[Validate('image|max:1024')]
    public $banner;

    public function mount($UUID)
    {
        
        $user = User::where('UUID', $UUID)->first();

        if(!$user){
            $this->redirect('/', true); 
        } else{
            $this->profile = $user;
            $this->images = $user->Image;
        }
    }

    public function uploadBanner()
    {
        
        $message = ['status' => "No Image Provided"];

        // check if user upload image banner otherwise skip it
        if(isset($this->banner)){

            // get current data of authenticated user
            $user = User::find(Auth::user()->id);

            // store current banner if exist
            $prev_banner = $user->banner;

            // store uploaded banner to public storage/banner
            $path = $this->banner->store('banner');
            
            // update user data that match with banner path name
            $result = $user->update(['banner' => "/storage/" . $path]);
            
            // if successfully updated otherwise skip it
            if($result && isset($path)){

                // if current banner exist then do
                if(isset($prev_banner)){

                    // remove from public storage/banner
                    $old_path = explode('/',$prev_banner);
                    Storage::disk('public')->delete(Arr::join(Arr::except($old_path, [0, 1]), '/'));
                }

                $message = ['status' => "Successfully <strong>Updated Banner</strong>"];
            } else{

                $message = ['status' => "Failed <strong>Updating Banner</strong>"];
            }
        }

        return redirect('/profile')->with($message);
    }

    public function cleanModel()
    {
        $this->reset("banner");
    }

    public function render()
    {
        return view('livewire.profile.profile');
    }
}
