<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'bio',
        'image',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function posts(){
        return $this->hasMany(Post::class)->latest();
    }

    public function comments(){
        return $this->hasMany(Comment::class)->latest();
    }

    public function followings(){
        return $this->belongsToMany(User::class, 'follower_user', 'follower_id', 'user_id')->withTimestamps();
    }

    public function followers(){
        return $this->belongsToMany(User::class,'follower_user','user_id', 'follower_id')->withTimestamps();
    }

    // Boolean to know if a user follows someone
    public function follows(User $user){
        return $this->followings()->where('user_id', $user->id)->exists();
    }

    // public function sentMessages()
    // {
    //     return $this->hasMany(Message::class, 'user_id');
    // }

    // public function receivedMessages()
    // {
    //     return $this->hasMany(Message::class,'recipient_id');
    // }
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function getImageURL(){
        if($this->image){
            return url('storage/'.$this->image);
        }
        return url('storage/default.png');
    }
}
