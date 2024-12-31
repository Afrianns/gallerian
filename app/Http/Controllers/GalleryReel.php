<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Unsplash\HttpClient;
use Unsplash\Search;

class GalleryReel extends Controller
{
    //

    public function UnsplashAPI()
    {
        HttpClient::init([
            'applicationId'	=> 'OIVQ7fmBoo8wcgG-aRTPz8ZAlomf4gmZhuHnWOB6K-w',
            'secret'	=> '2Cgy9NBYf4E_yTXodxjVlTGNZPNEKqSpsogrbLC_kBM',
            // 'callbackUrl'	=> 'https://your-application.com/oauth/callback',
            'utmSource' => 'gallerian'
        ]);


        $search = 'forest';
        $page = 3;
        $per_page = 15;
        $orientation = 'landscape';

        $photos = Search::photos($search, $page, $per_page, $orientation);

        return view("livewire.home", ['photos' => $photos]);
    }
}
