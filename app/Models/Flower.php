<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flower extends Model
{
    use HasFactory;

    // フィールドがIDのみで管理されるため、$fillableは空の配列または省略可能です。
    protected $fillable = [];

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
