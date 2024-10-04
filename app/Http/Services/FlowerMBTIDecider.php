<?php

namespace App\Http\Services;

class FlowerMBTIDecider
{
    /**
     * 花のIDを基にMBTIを決定するメソッド
     *
     * @param array $flowerIds 選ばれた花のID
     * @param array $flowerData CSVから取得した花のMBTIデータ
     * @return string MBTIのタイプ
     */
    public function decideMBTI(array $flowerIds, array $flowerData): string
    {
        // 各MBTI要素の初期値
        $sensingIntuitionSum = 0; // 感覚-直感
        $thinkingFeelingSum = 0;  // 思考-感情
        $extroversionIntroversionSum = 0;  // 外向-内向
        $judgingPerceivingSum = 0;  // 判断-知覚

        // 選ばれた花のIDを基に各要素を合計する
        foreach ($flowerIds as $id) {
            // データが存在するか確認
            if (!isset($flowerData[$id])) {
                // エラー処理またはスキップ
                throw new \Exception("データが見つかりません: 花ID {$id}");
            }

            $flower = $flowerData[$id]; // IDに基づいてデータを取得

            $sensingIntuitionSum += $flower['感覚-直感'];
            $thinkingFeelingSum += $flower['思考-感情'];
            $extroversionIntroversionSum += $flower['外向-内向'];
            $judgingPerceivingSum += $flower['判断-知覚'];
        }

        // 各要素の合計値に基づいてMBTIタイプを決定
        $sensingIntuition = ($sensingIntuitionSum >= 2) ? 'S' : 'N';
        $thinkingFeeling = ($thinkingFeelingSum >= 2) ? 'T' : 'F';
        $extroversionIntroversion = ($extroversionIntroversionSum >= 2) ? 'E' : 'I';
        $judgingPerceiving = ($judgingPerceivingSum >= 2) ? 'J' : 'P';

        // MBTIのタイプを結合して返す
        return $extroversionIntroversion . $sensingIntuition . $thinkingFeeling . $judgingPerceiving;
    }

}
