<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'name',
        'user_id',
        'title',
        'subtitle',
        'tag',
        'description',
        'is_reviewed'
    ];

    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function RejectedInfo(): HasOne
    {
        return $this->hasOne(RejectedInfo::class);
    }
}
