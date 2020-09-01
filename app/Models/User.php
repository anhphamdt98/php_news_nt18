<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'email', 
        'password', 
        'avatar', 
        'address',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role() 
    {
        return $this->belongsTo(Role::class);
    }

    public function posts() 
    {
        return $this->hasMany(Post::class);
    }

    public function likes() 
    {
        return $this->hasMany(Like::class);
    }

    public function comments() 
    {
        return $this->hasMany(Comment::class);
    }

    public function following()
    {
        return $this->belongsToMany(User::class, 'user_followers', 'follower_id', 'user_id');
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'user_followers', 'user_id', 'follower_id');
    }

    public function isFollowing(User $user)
    {
        return $this->following()->where('user_id', $user->id)->count();
    }

    public function isFollowedBy(User $user)
    {
        return $this->followers()->where('follower_id', $user->id)->count();
    }
}
