<?php

namespace App\Livewire\Components;

use App\Models\Image;
use App\Models\likes;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ImagesShowcase extends Component
{
    use WithPagination;

    private $images = null;
    public $currentImage = 0;
    private $id = null;

    private $type;
    private $query;


    public function mount($id=null)
    {
        
        if(explode('/',request()->path())[0] == "profile"){
            if($id == null) {;
                return $this->redirect('/', true);
            }
            $this->id = $id;
        }

        $getUrlType = request()->get("type");
        $getUrlQuery = request()->get("query");

        if($getUrlType){
            $this->type = $getUrlType;
        }
        
        if($getUrlQuery){
            $this->query = $getUrlQuery;
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
        $queryFromDB = Image::where('is_reviewed','approved');

        if($this->query){
            $queryFromDB->where("title", "LIKE", '%'.$this->query.'%');
        } 
        if($this->type){
            $queryFromDB->orderBy("created_at", $this->type);
        }
        // dd($queryFromDB->paginate(1));
        return $queryFromDB->paginate(1);
    }

    public function getUserImages($id)
    {
        $queryFromDB = Image::where('user_id', $id)->where('is_reviewed', "approved");

        if($this->query){
            $queryFromDB->where("title", "LIKE", '%'.$this->query.'%');
        } 
        if($this->type){
            $queryFromDB->orderBy("created_at", $this->type);
        }
        // dd($queryFromDB->paginate(1));
        return $queryFromDB->paginate(1);
    }

    public function render()
    {

        $images = (explode('/',request()->path())[0] == 'profile') ? $this->getUserImages($this->id) : $this->getAllImages();

        // dd($images);

        return view('livewire.components.images-showcase',[
            'images' => $images
        ]);

        // request()->fullUrl()
    }
}
