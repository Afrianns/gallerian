<?php

namespace App\Livewire;

use App\Models\User;
use App\Notifications\AcceptanceStatus;
use App\Photos;
use Illuminate\Pagination\Paginator;
use Livewire\Component;
use Livewire\WithPagination;
use Unsplash\HttpClient;
use Unsplash\Search;
use App\UnsplashObj;
use Illuminate\Support\Facades\Auth;

class Home extends Component
{
    public $photosOne = [];
    public $photosTwo = [];
    public $photosThree = [];
    // public UnsplashObj $photos;

    public $position = [];

    // public function mount()e
    // {
        
    // }

    public function mount()
    {

    //     $this->photos = new Photos();
        HttpClient::init([
            'applicationId'	=> 'OIVQ7fmBoo8wcgG-aRTPz8ZAlomf4gmZhuHnWOB6K-w',
            'secret'	=> '2Cgy9NBYf4E_yTXodxjVlTGNZPNEKqSpsogrbLC_kBM',
            // 'callbackUrl'	=> 'https://your-application.com/oauth/callback',
            'utmSource' => 'gallerian'
        ]);

        $search = 'forest';
        $page = 1;
        $per_page = 30;
        $orientation = 'portrait';
        
        $data = Search::photos($search, $page, $per_page, $orientation);

        //    dd($data->getResults());
        $this->position = $data->getHeaders();
        $this->photosOne = $data->getResults();
    }

    public function checkEmail()
    {
        $user = User::find(Auth::user()->id);
        $hello = "this is miss herry";
        $user->notify(new AcceptanceStatus($hello));
    }

    public function render()
    {
        return view('livewire.home');
    }
}
