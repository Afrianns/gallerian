<?php

namespace App\Livewire\Components;

use App\Models\Image;
use App\Models\likes;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;
use Livewire\Attributes\On;

class ImagesShowcase extends Component
{
    use WithPagination;

    private $images = null;
    public $currentImage = 0;
    private $id = null;

    private $type;

    public function mount($id=null)
    {
        
        if(explode('/',request()->path())[0] == "profile"){
            if($id == null) {;
                return $this->redirect('/', true);
            }
            $this->id = $id;
        }
    }

    public function setLike($id)
    {
        if(Auth::check()){
            $like = likes::where('image_id', $id)->where("user_id", Auth::user()->id)->first();
    
            if($like != null){
                

                $like->like = !$like->like;            
                $like->update();

            } else{
                likes::create([
                    "image_id" => $id,
                    "user_id" => Auth::user()->id,
                    "like" => true,
                ]);
            }
            $this->dispatch('image-liked')->to(GalleryImageDetail::class);
            // $this->redirect();
            
        } else{
            session()->flash('status', ['warning', 'You need login/register to like this image.']);
            $this->redirect('/gallery', true);
        }
    }

    // public function 

    public function getAllImages()
    {
        return Image::where('is_reviewed','approved')->paginate(1);
    }

    public function getUserImages($id)
    {
        return Image::where('user_id', $id)->where('is_reviewed', "approved");
    }

    public function sorting($type, $path)
    {

        $this->type = $type;
        // dd($userPath);
        
        // $userPath = Str::of($path)->explode('/');
        
        // if($userPath && $userPath[1]){
        //     $user = User::where('UUID', ($userPath[1]))->first();
        //     $image = $this->getUserImages($user->id)->orderBy("created_at")->paginate(1);
        //     dump($user->id, $image, $type);
        // }
        // $this->images = null;
        // $user = User::where('UUID', ($userPath[1]))->first();
        // $this->images = $this->getUserImages(User::where('UUID', ($userPath[1]))->first()->id)->orderBy('created_at', $type)->get();
        // dd($this->images, User::where('UUID', ($userPath[1]))->first()->id);
        // if($userPath[0] == 'profile'){
        // } elseif ($userPath[0] == 'gallery'){
        //     $this->images = $this->getAllImages()->orderBy('created_at',$type)->get();
        // }
    }

    #[On('sort-type')]
    public function sortingImages($sortType)
    {
        $this->type = $sortType;
        dd($sortType, 'hello');
    }

    public function render()
    {
        $images = (explode('/',request()->path())[0] == 'profile') ? $this->getUserImages($this->id)->paginate(1) : $this->getAllImages();

        return view('livewire.components.images-showcase',[
            'images' => $images,
        ]);
    }
}
