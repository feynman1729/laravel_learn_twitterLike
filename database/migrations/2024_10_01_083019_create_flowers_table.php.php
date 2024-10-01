<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('flowers', function (Blueprint $table) {
            $table->id(); // 花のID
            $table->string('name'); // 花の名前
            $table->string('symbol'); // 花の象徴
            $table->string('personality')->nullable(); // 関連する性格
            $table->string('mbti_type'); // MBTIタイプ
            $table->integer('sensing_intuition'); // 感覚 vs 直感
            $table->integer('thinking_feeling'); // 思考 vs 感情
            $table->integer('extroversion_introversion'); // 外向 vs 内向
            $table->integer('judging_perceiving'); // 判断 vs 知覚
            $table->timestamps(); // 作成・更新日時
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flowers');
    }
};
