<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'mbti_type',
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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function tweets()
    {
        return $this->hasMany(Tweet::class);
    }    

    public function likes()
    {
        return $this->belongsToMany(Tweet::class)->withTimestamps();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->orderBy('created_at', 'desc');
    }

    public function follows()
    {
        return $this->belongsToMany(User::class, 'follows', 'follow_id', 'follower_id');
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'follower_id', 'follow_id');
    }

    // ユーザーは1つのMBTIタイプを持つ
    public function mbtiType()
    {
        return $this->hasOne(MBTIType::class);
    }

    // ユーザーは複数の花を選ぶ (多対多リレーション)
    public function flowers()
    {
        return $this->belongsToMany(Flower::class)->withTimestamps();
    }
}
