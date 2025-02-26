<?php

namespace App\Livewire\Components;

use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ChildComments extends Component
{
    public $comments;
    public $commentID;

    public $marginLeft = 0;

    #[Validate(["inputComment.*" => "required|min:5"])]
    public $inputComment = [];
    
    #[Validate("required")]
    public $imageID;

    public function mount($id, $gap, $commentID = null)
    {
        $this->marginLeft = $gap;
        $this->imageID = $id;
        if($id && $commentID){
            $this->comments = Comment::where('image_id', $id)->where('comment_id', $commentID)->get();
        } else{

            $this->comments = Comment::where('image_id', $id)->where('comment_id', null)->get();
        }
    }

    public function save($id)
    {
        $data = [
            'user_id' => Auth::user()->id,
            'image_id' => $this->imageID,
            'comment' => $this->inputComment[$id]
        ];

        if(isset($id)){
            $data += ['comment_id' => $id];
        }

        // dd($id, $data);

        $this->validate();


        $result = Comment::create($data);

        if($result){    
            session()->flash("status", ['success','Successfully post your comment!']);
            return $this->redirect('/image/'. $this->imageID, true);
        }
    }

    public function deleteComment($commentID)
    {
        $result = Comment::find($commentID)->delete();

        if($result){    
            session()->flash("status", ['success','Successfully delete your comment!']);
            return $this->redirect('/image/'. $this->imageID, true);
        }
    }

    public function render()
    {
        return view('livewire.components.child-comments');
    }
}
