<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Carbon\Carbon;


class Comment extends Model
{
    protected $fillable = ['comment', 'user_id','image_id', 'comment_id'];  

    public function Image(): BelongsTo
    {
        return $this->belongsTo(Image::class);
    }

    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function Replies(): HasMany
    {
        return $this->hasMany(Comment::class, 'comment_id');
    }

    public function Comment(): BelongsTo
    {
        return $this->BelongsTo(Comment::class, 'comment_id');
    }


}
