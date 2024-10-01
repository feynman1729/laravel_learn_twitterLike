<?php

namespace App\Services;

use App\Models\Flower;

class FlowerMBTIDecider
{
    /**
     * 選択された花に基づいてMBTIタイプを決定する
    */
    @param array $selectedFlowers //ユーザーが選んだ花のリスト
    @return string //決定されたMBTIタイプ
 
    public function determineMbti(array $selectedFlowers)
    {
        // 選択された花に関連するMBTIタイプを取得
        $mbtiTypes = Flower::whereIn('name', $selectedFlowers)->pluck('mbti_type');

        // 最も頻度の高いMBTIタイプを返す
        return $mbtiTypes->mode()->first();
    }
}