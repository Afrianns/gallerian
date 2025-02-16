<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

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

    public function Likes($id)
    {
        // dump($id,$this->hasOne(likes::class)->where('image_id', $id)->where('user_id', Auth::user()->id)->get());
        return $this->hasOne(likes::class)->where('image_id', $id)->where('user_id', Auth::user()->id)->first();
    }

    public function totalLikes($id)
    {
        return $this->hasMany(likes::class)->where('image_id', $id)->where('like', true)->count();
    }
}
