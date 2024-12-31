<?php

namespace App;

use Livewire\Wireable;

class UnsplashObj implements Wireable
{
    protected $photos;

    public function __construct($photos)
    {
        $this->photos = $photos;
    }

    public function toLivewire()
    {
        return [
            'photos' => $this->photos,
        ];
    }
 
    public static function fromLivewire($value)
    {
        $photos = $value['photos'];
 
        return new static($photos);
    }
}
