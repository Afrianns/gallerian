<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;


class Settings extends Component
{
    use WithFileUploads;
    
    public $avatar = '';

    #[Validate("nullable|min:20|max:255")]
    public $bio = '';
    
    #[Validate("nullable|url:http,https|max:50")]
    public $website = '';

    #[Validate("required|max:100")]
    public $name = '';

    
    #[Validate('nullable|image|max:520')]
    public $newAvatar;


    public function mount($UUID)
    {
        $this->name = Auth::user()->name;
        $this->bio = Auth::user()->bio;
        $this->website = Auth::user()->website;

        $user = User::where("UUID", $UUID)->first();

        if(!isset($user) && Auth::user()->UUID != $UUID){
            session()->flash('status', ['error', 'There is an <strong>error occur.</strong>']);
            return $this->redirect('/');
        }

        $this->avatar = $user->avatar;
    }

    public function save()
    {
        $this->validate();

        // dd($result);

        $UUID = Auth::user()->UUID;

        $user_data = User::where('UUID', $UUID)->first();
        
        // get current user avatar
        $prev_avatar_path = $user_data->avatar;
        
        // check is user, and not admin
        // check if data exist and store it to user data
        if($user_data->type == "user") {

            if(isset($this->bio)){
                $user_data->bio = $this->bio;
            }
            
            if(isset($this->website)){
                $user_data->website = $this->website;
            }
        }

        // if user upload file then do this otherwise skip it
        if(isset($this->newAvatar)){

            // store file avatar to public storage/avatar
            $path = $this->newAvatar->store('avatar');
            $user_data->avatar =  '/storage//' . $path;

            
            // check if it a local url or not 
            if(!Str::contains($prev_avatar_path, ['https://','http://'])){
                    
                // remove file from storage if there is a file 
                $old_path = explode('/', $prev_avatar_path);
                Storage::disk('public')->delete(Arr::join(Arr::except($old_path, [0, 1]), '/'));
            }
        }
        
        $user_data->name = $this->name;        
        $res = $user_data->save();
        
        if($res){
            session()->flash('status', ['success','Profile successfully updated.']);
        } else {
            session()->flash('status', ['error','Profile failed to update.']);   
        }
        return $this->redirect('/profile/'. Auth::user()->UUID, true);
 
    }

    public function render()
    {
        return view('livewire.profile.settings');
    }
}
