<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class RejectedInfo extends Model
{
    //

    protected $fillable = ['image_id', 'message'];


    public function Image(): BelongsTo
    {
        return $this->belongsTo(Image::class);
    }
}
