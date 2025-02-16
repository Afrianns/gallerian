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
    public $bio = '';
    public $website = '';

    
    #[Validate('image|max:520')]
    public $newAvatar = '';


    public function mount($UUID)
    {

        $user = User::where("UUID", $UUID)->first();

        if(!isset($user) && Auth::user()->UUID != $UUID){
            session()->flash('status', ['error', 'There is an <strong>error occur.</strong>']);
            return $this->redirect('/');
        }

        $this->avatar = $user->avatar;
    }

    public function upload(Request $request)
    {

        $file = $request->file('avatar');

        $request->validate([
            'name' => "required|max:100",
            'bio'  => "nullable|min:20|max:255",
            'website'  => "nullable|url:http,https|max:50",
        ]);

        $UUID = Auth::user()->UUID;

        $user_data = User::where('UUID', $UUID)->first();

        // get current user avatar
        $prev_avatar_path = $user_data->avatar;

        // check if data exist and store it to user data

        if(isset($request->bio)){
            $user_data->bio = $request->bio;
        }

        if(isset($request->website)){
            $user_data->website = $request->website;
        }

        // if user upload file then do this otherwise skip it
        if(isset($file)){

            // store file avatar to public storage/avatar
            $path = $file->store('avatar');
            $user_data->avatar =  '/storage//' . $path;

            
            // check if it a local url or not 
            if(!Str::contains($prev_avatar_path, ['https://','http://'])){
                    
                // remove file from storage if there is a file 
                $old_path = explode('/', $prev_avatar_path);
                Storage::disk('public')->delete(Arr::join(Arr::except($old_path, [0, 1]), '/'));
            }
        }
        
        $user_data->name = $request->name;        
        $res = $user_data->save();
        
        if($res){
            $this->redirectMethod();
        }
        // dd($res, $user_data,'/profile/'. $UUID);
 
    }

    private function redirectMethod()
    {
        session()->flash('status', ['success','Post successfully updated.']);
        return $this->redirect("/", true);
    }

    public function render()
    {
        return view('livewire.profile.settings');
    }
}
