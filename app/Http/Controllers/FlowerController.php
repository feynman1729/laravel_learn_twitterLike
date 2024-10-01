<?php

namespace App\Http\Controllers;

use App\Models\Flower;  // Flowerモデルを使うためにインポート
use Illuminate\Http\Request;

class FlowerController extends Controller
{
    // 花の選択画面を表示
    public function showFlowerSelection()
    {
        // データベースから全ての花を取得
        $flowers = Flower::all();

        // flowersをビューに渡す
        return view('flowers.select', compact('flowers'));
    }

     // 花の選択処理
    public function storeFlowerSelection(Request $request)
    {
        // 花を3つ選んだか確認
        $validated = $request->validate([
            'flowers' => 'required|array|size:3',
        ]);

        $selectedFlowers = $request->input('flowers');

        // 選択された花を元にMBTI診断ロジックを適用（前述のMBTI診断処理）
        // ここで選択された3つの花の情報を使ってMBTIを計算
        // $mbti = ...;

        // 結果を表示するか、次のステップへ遷移
        return redirect()->route('mbti.result', ['mbti' => $mbti]);
    }
}
