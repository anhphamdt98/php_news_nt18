<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'user_id',
        'hashtag_id',
        'caption',
    ];

    public function user() 
    {
        return $this->belongsTo(User::class);
    }

    public function hashtag() 
    {
        return $this->belongsTo(Hashtag::class);
    }

    public function likes() 
    {
        return $this->hasMany(Like::class);
    }

    public function comments() 
    {
        return $this->hasMany(Comment::class)->whereNull('parent_id');
    }

    public function media() 
    {
        return $this->hasMany(Media::class);
    }
}
