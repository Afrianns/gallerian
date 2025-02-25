<?php

namespace App\Livewire\Uploader;

use Livewire\Component;
use Livewire\Attributes\Validate;
use Livewire\WithFileUploads;
use App\Models\Image;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Upload extends Component
{
    use WithFileUploads;

    #[Validate(['photos.*' => 'image|max:4096'])]
    public $photos = [];

    public $check = [];
    public $images = [];
    public $name = 'Alex';
    public $imageID = null;
    private $photosModel = [];

    public function mount()
    {

        $images = User::where('UUID', Auth::user()->UUID)->first();
        // dd($images);
        foreach ($images->image as $image) {
            if($image->is_reviewed =='not-yet'){
                array_push($this->images, [
                    "id" => $image->id,
                    "name" => $image->name,
                    'title' => $image->title,
                    'description' => $image->description,
                ]);
            }
        }
    }

    // saving photos data to DB by checking the wire:model=image to frontend temporary image
    public function save($res, $idx)
    {
        foreach ($this->photos as $key => $photo) {
            if(isset($photo)){
                if($photo->getFilename() == $res){
                    // dump($photo, $key, $res);
                    $this->storeData($idx);
                }
            }
        }
    }
    
    // store individual photo data to DB
    private function storeData($id)
    {
        $images = new Image;

        $hashName = $this->photos[$id]->hashName();

        $this->photos[$id]->storeAs('photos', $hashName, "public");
        
        $images->name = $hashName;
        $images->user_id = Auth::user()->id;
        $result = $images->save();

        // send event to front end to update temporary so it sync with uploaded image data
        if($result){
            $imageStore = ['id' => $images->id, 'name' => $hashName];
            $this->dispatch('image-saved', success: true, tempIndex: $id, imageData: $imageStore)->self();
        } else{
            $this->dispatch('image-saved', success: false, tempIndex: $id)->self();
        }
    }

    public function detailFile($id)
    {
        $this->dispatch('show-detail-data', $id); 
    }
    
    public function deleteFile($id)
    {
        $image = Image::find($id);
        Storage::disk('public')->delete('photos/'. $image->name);
        $image->forceDelete();
    }

    public function deletePhoto($id)
    {
        $this->photos[$id] = null;
    }

    public function show()
    {
        dd($this->images, $this->photos);
    }

    public function reviewImages($id)
    {
        if(count($id) <= 0){
            $this->callSessionStatus();
        }

        DB::table('images')
            ->whereIn('id', $id)
            ->update(['is_reviewed' => "pending"]);

        $this->dispatch('to-reviewing',  id: $id)->self();
         

    }

    public function callSessionStatus()
    {
        session()->flash('status','There is no images selected');
        return $this->redirect('/upload', navigate: true);
    }

    public function render()
    {
        return view('livewire.uploader.upload');
    }
}
