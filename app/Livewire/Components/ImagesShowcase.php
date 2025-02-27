<?php

namespace App\Livewire\Components;

use App\Models\Image;
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
