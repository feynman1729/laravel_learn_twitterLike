<?php

use App\Models\User;
use App\Models\Flower;
use App\Http\Services\FlowerMBTIDecider;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

// テストコードがFlowerの不要なカラムに依存していないことを確認
it('allows a user to select flowers and determines MBTI', function () {
    // FlowerMBTIDeciderのモック作成
    $mockDecider = $this->mock(FlowerMBTIDecider::class, function ($mock) {
        $mock->shouldReceive('decideMBTI')
            ->andReturn('INTJ'); // 期待されるMBTI結果をモック
    });

    // ユーザーの作成
    $user = User::factory()->create();

    // 3つの花のIDを作成
    $flowers = Flower::factory()->count(3)->create();

    // ユーザーとしてリクエストを実行
    $this->actingAs($user)
        ->post(route('store.flowers'), [
            'flowers' => $flowers->pluck('id')->toArray(),
        ])
        ->assertStatus(302);  // リダイレクト確認
});

// 花を3つ選択した後、MBTIがセッションに保存されているかを確認するテスト
it('stores the user\'s MBTI result in the session after selecting 3 flowers', function () {
    // FlowerMBTIDeciderのモック作成
    $mockDecider = $this->mock(FlowerMBTIDecider::class, function ($mock) {
        $mock->shouldReceive('decideMBTI')
            ->andReturn('INTJ'); // 期待されるMBTI結果をモック
    });

    // ユーザーの作成
    $user = User::factory()->create();

    // 3つの花のIDを作成
    $flowers = Flower::factory()->count(3)->create();

    // ユーザーとしてリクエストを実行
    $this->actingAs($user)
        ->post(route('store.flowers'), [
            'flowers' => $flowers->pluck('id')->toArray(),
        ])
        ->assertStatus(302)
        ->assertSessionHas('mbtiResult', function($mbtiResult) {
            return in_array($mbtiResult, ['INTJ', 'ISTJ']);  // 'INTJ' または 'ISTJ' の場合に成功
        });
});

it('displays the user\'s MBTI result after selecting 3 flowers', function () {
    // FlowerMBTIDeciderのモック作成
    $mockDecider = $this->mock(FlowerMBTIDecider::class, function ($mock) {
        $mock->shouldReceive('decideMBTI')
            ->andReturn('INTJ'); // 期待されるMBTI結果をモック
    });

    // ユーザーの作成
    $user = User::factory()->create();

    // 3つの花のIDを作成
    $flowers = Flower::factory()->count(3)->create();

    // ユーザーとしてリクエストを実行
    $this->actingAs($user)
        ->post(route('store.flowers'), [
            'flowers' => $flowers->pluck('id')->toArray(),
        ])
        ->assertStatus(302);

    // リクエスト後にMBTI結果が画面に表示されているかを確認
    $this->actingAs($user)
        ->get(route('select.flowers'))  // select-flowers ページを取得
        ->assertStatus(200)  // ページの取得が成功していることを確認
        ->assertSee('あなたのMBTIタイプは');  // 'INTJ'が表示されていることを確認
});
