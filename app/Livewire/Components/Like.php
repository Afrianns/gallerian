<?php

namespace App\Livewire\Components;

use App\Models\likes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Livewire\Attributes\On;
use Livewire\Component;

class Like extends Component
{

    public $like = false;
    public $id;
    public $isFillColorWhite = false;

    public $url;

    public function mount($id, $fillColorWhite = false, $redirect = "/gallery")
    {
        $this->id = $id;
        $this->isFillColorWhite = $fillColorWhite;


        $this->url = $redirect;

        if($this->getLikes()){
            $this->like = $this->getLikes()->like;
        }
    }

    public function setLike()
    {
        if(Auth::check()){

            $like = $this->getLikes();
    
            if($like != null){
                
                $like->like = !$like->like;            
                $like->update();

            } else{
                likes::create([
                    "image_id" => $this->id,
                    "user_id" => Auth::user()->id,
                    "like" => true,
                ]);
            }
            // dispatch value like, so it match every components 
            $this->dispatch('image-liked',['like' => $like->like]);
            
        } else{
            session()->flash('status', ['warning', 'You need login/register to like this image.']);
            $this->redirect($this->url, true);
        }
    }

    // set like to current one
    #[On("image-liked")]
    public function isLiked($like)
    {
        $this->like = $like['like'];
    }

    #[On("show-path")]
    public function check()
    {
        dd(request()->getPathInfo());
    }

    // call model likes
    public function getLikes() 
    {
        if(Auth::check()){
            return likes::where('image_id', $this->id)->where("user_id", Auth::user()->id)->first();
        }
    }
    
    public function render()
    {
        return view('livewire.components.like');
    }
}
