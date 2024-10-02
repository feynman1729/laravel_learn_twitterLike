<?php

namespace App\Http\Controllers;

use App\Models\Flower;
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

        // ユーザーが選んだ花のIDを取得
        $flowerIds = $request->input('flowers');
        
        // ユーザーと花の関連付けを保存
        $user = auth()->user();
        $user->flowers()->sync($flowerIds);  // 選択した花をユーザーに紐づける

        // 成功メッセージや次のステップにリダイレクト
        return redirect()->route('profile.show', $user)->with('success', '花の選択が完了しました。');
    }
}
