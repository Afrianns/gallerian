<?php

namespace App\Livewire\Uploader;

use App\Models\Image;
use Livewire\Attributes\Validate;
use Livewire\Component;



class DetailFile extends Component
{
    public $detailImage = [];

    #[Validate('min:5')] 
    public $title = '';

    #[Validate('min:4')] 
    public $description = '';

    public function getDetail($id)
    {
        $data = Image::find($id);

        if (isset($data)){
            $this->detailImage = [
                'id' => $data->id,
                'name' => $data->name,
                'title' => $data->title,
                'tag' => $data->tag,
                'description' => $data->description,
            ];
            
            $this->dispatch('detail-image-fetched')->self();
        }
    }

    public function updateFileInfo($id)
    {

        $this->validate();
        $image = Image::find($id);

        if(isset($image)){
            if(trim($this->description) == '' && trim($this->title) == ''){
                return;
            }
            
            if(trim($this->description) != ''){
                $image->description = $this->description;
            }

            if(trim($this->title) != ''){
                $image->title = $this->title;

            }

            $result = $image->save();

            if($result){
                $details = ['id' => $id,'title' => $image->title, 'description' => $image->description];
                $this->dispatch('status', success: 'Successfully Updated', detail: $details);
                $this->reset();
                $this->getDetail($id);
            }
        }
    }

    public function render()
    {
        return view('livewire.uploader.detail-file');
    }
}
