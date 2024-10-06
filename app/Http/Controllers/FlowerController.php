<?php

namespace App\Http\Controllers;

use App\Models\Flower; // Flowerモデルをインポート
use App\Http\Services\FlowerMBTIDecider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FlowerController extends Controller
{
    // 花の選択画面を表示
    public function showFlowerSelection()
    {
        // ログイン中のユーザーを取得
        $user = Auth::user();

        // ユーザーが選択した花を取得
        $selectedFlowers = $user->flowers;

        // 花が3つ以上選択されている場合は選択済みとみなす
        if ($selectedFlowers->count() >= 3) {
            return view('flowers.select', ['selected' => true]);
        }

        // ユーザーがまだ花を選んでいない場合、全ての花を取得して表示
        $flowers = Flower::all();

        return view('flowers.select', [
            'flowers' => $flowers,
            'selected' => false,
        ]);
    }

    public function store(Request $request)
    {
        // バリデーション: 3つの花が選ばれているか確認
        $validated = $request->validate([
            'flowers' => 'required|array|size:3',
        ]);

        // FlowerMBTIDeciderのインスタンスを作成し、MBTIを決定
        $mbtiDecider = new FlowerMBTIDecider();
        
        // FlowerDeciderを使ってCSVデータを取得し、選んだ花IDを基にMBTIタイプを決定
        $flowerIds = $request->input('flowers');
        $mbtiResult = $mbtiDecider->decideMBTI($flowerIds); // getFlowerDataFromCSVは内部で呼び出されます

        // セッションにMBTI結果を保存し、同じページにリダイレクト
        return redirect()->back()->with('mbtiResult', $mbtiResult);
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
