<?php

namespace App\Livewire\Components;

use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Comments extends Component
{
    public $imageID;

    #[Validate("required|min:5")]
    public $inputComment = '';

    public function mount($id)
    {
        $this->imageID = $id;
    }

    public function save()
    {
        $this->validate();

        $result = Comment::create([
            'user_id' => Auth::user()->id,
            'image_id' => $this->imageID,
            'comment' => $this->inputComment
        ]);

        if($result){
            session()->flash("status", ['success','Successfully post a comment!']);
            return redirect('/image/'. $this->imageID, true);
        }
    }

    public function render()
    {
        return view('livewire.components.comments',[
            'totalComments' => Comment::all()->count()
        ]);
    }
}
