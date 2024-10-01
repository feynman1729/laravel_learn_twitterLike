<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['comment', 'tweet_id', 'user_id'];

    public function tweet()
    {
        return $this->belongsTo(Tweet::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
