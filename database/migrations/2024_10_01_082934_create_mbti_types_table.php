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
        Schema::create('mbti_types', function (Blueprint $table) {
            $table->id();
            $table->string('type'); // MBTIタイプ (例: ISFP, ENTJなど)
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // ユーザーID (外部キー制約)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mbti_types');
    }
};
