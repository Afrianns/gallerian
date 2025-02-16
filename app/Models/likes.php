<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class likes extends Model
{
    protected $fillable = ['image_id', 'user_id', 'like'];

    public function like(): BelongsTo
    {
        return $this->belongsTo(Image::class);
    }
}
