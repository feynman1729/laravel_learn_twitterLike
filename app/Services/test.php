<?php

namespace App\Services;

use App\Models\Flower;

class FlowerMBTIDecider
{
    protected $flowerData = [];

    public function __construct()
    {
        $this->Convert_MBTI();
    }

    protected function Convert_MBTI()
    {
        $csvPath = storage_path('app/MBTI_Flower_Data.csv'); 
        $csv = array_map('str_getcsv', file($csvPath));
        $csv->setHeaderOffset(0); // ヘッダーを設定

        foreach ($csv as $row) {
            $this->flowerData[$row['name']] = $row['mbti_type'];
        }
        
    }
}