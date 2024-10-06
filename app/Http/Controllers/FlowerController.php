<?php

namespace App\Http\Controllers;

use App\Models\Flower; // Flowerモデルをインポート
use App\Http\Services\FlowerMBTIDecider;
use Illuminate\Http\Request;

class FlowerController extends Controller
{
    // 花の選択画面を表示
    public function showFlowerSelection()
    {
        // データベースから全ての花を取得 (例: Flowerモデルから取得)
        $flowers = Flower::all();

        // flowersをビューに渡す
        return view('flowers.select', compact('flowers'));
    }

    // 花の選択結果を保存するメソッド (storeメソッドとして追加)
    public function store(Request $request)
    {
        // 花を3つ選んだか確認
        $validated = $request->validate([
            'flowers' => 'required|array|size:3',
        ]);

        // ユーザーが選んだ花のIDを取得
        $flowerIds = $request->input('flowers');

        // CSVファイルから花のMBTIデータを取得する
        $flowerData = $this->getFlowerDataFromCSV();

        // データが読み込めなかった場合の処理
        if (empty($flowerData)) {
            return redirect()->back()->with('error', 'MBTIデータの読み込みに失敗しました');
        }

        // FlowerMBTIDeciderにデータを渡す
        $mbtiDecider = new FlowerMBTIDecider();
        $mbtiResult = $mbtiDecider->decideMBTI($flowerIds, $flowerData);

        // MBTI結果をセッションに保存して診断結果ページにリダイレクト
        return redirect()->route('flower.result')->with('mbtiResult', $mbtiResult);
    }

    // 診断結果を表示するメソッド
    public function showFlowerResult(Request $request)
    {
        // MBTI結果をセッションから取得
        $mbtiResult = session('mbtiResult');

        // 診断結果がセッションにない場合のエラーハンドリング
        if (!$mbtiResult) {
            return redirect()->route('select.flowers')->with('error', 'MBTI結果が見つかりません。もう一度お試しください。');
        }

        // 診断結果をビューに渡して表示
        return view('flowers.result', compact('mbtiResult'));
    }
}
