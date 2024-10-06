<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MBTIType extends Model
{
    use HasFactory;

    protected $fillable = ['type'];

    // MBTIタイプは多数のユーザーに属する
    public function user()
    {
        // return $this->belongsTo(User::class);
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    
}
