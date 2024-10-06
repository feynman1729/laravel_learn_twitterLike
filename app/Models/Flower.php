<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flower extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'symbol', 
        'personality', 
        'mbti_type',
        'sensing_intuition',
        'thinking_feeling',
        'extroversion_introversion',
        'judging_perceiving',
    ];

    // Flowerは複数のユーザーに属する (多対多リレーション)
    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    // 選択された3つの花を取得するメソッド
    public static function getSelectedFlowers($flowerIds)
    {
        return self::whereIn('id', $flowerIds)->get();
    }
}