<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    use HasFactory;

    protected $fillable = ['tweet'];

    public function user()
    {
    return $this->belongsTo(User::class);
    }

    public function liked()
  {
      return $this->belongsToMany(User::class)->withTimestamps();
  }

  public function comments()
  {
    return $this->hasMany(Comment::class)->orderBy('created_at', 'desc');
  }
}
