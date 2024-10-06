<?php

namespace App\Http\Services;

class FlowerMBTIDecider
{
    protected $flowerData;

    // コンストラクタでCSVデータを読み込む
    public function __construct()
    {
        $this->flowerData = $this->getFlowerDataFromCSV();
    }

    /**
     * 花のIDを基にMBTIを決定するメソッド
     *
     * @param array $flowerIds 選ばれた花のID
     * @return string MBTIのタイプ
     */
    public function decideMBTI(array $flowerIds): string
    {
        // 各MBTI要素の初期値
        $sensingIntuitionSum = 0; // 感覚-直感
        $thinkingFeelingSum = 0;  // 思考-感情
        $extroversionIntroversionSum = 0;  // 外向-内向
        $judgingPerceivingSum = 0;  // 判断-知覚

        // 選ばれた花のIDを基に各要素を合計する
        foreach ($flowerIds as $id) {
            // 花IDは1から開始するので、インデックスとしては-1する
            $flower = $this->flowerData[$id - 1]; 

            // flowerDataの対応する値を合計する
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

    protected function getFlowerDataFromCSV(): array
    {
        $filePath = storage_path('app/data/MBTI_Flower_Data.csv');
        $flowerData = [];

        // CSVファイルを開いてデータを読み込む
        if (($handle = fopen($filePath, 'r')) !== false) {
            // 一行目も含めてすべての行を処理する
            while (($data = fgetcsv($handle)) !== false) {
                // flowerData配列にID順にデータを追加
                $flowerData[] = [
                    '感覚-直感' => (int) $data[4],
                    '思考-感情' => (int) $data[5],
                    '外向-内向' => (int) $data[6],
                    '判断-知覚' => (int) $data[7],
                ];
            }

            fclose($handle);
        }

        return $flowerData;
    }
}
