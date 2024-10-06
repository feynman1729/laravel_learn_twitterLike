<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveUnusedColumnsFromFlowersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('flowers', function (Blueprint $table) {
            $table->dropColumn([
                'name',
                'symbol',
                'personality',
                'mbti_type',
                'sensing_intuition',
                'thinking_feeling',
                'extroversion_introversion',
                'judging_perceiving',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('flowers', function (Blueprint $table) {
            $table->string('name')->nullable();
            $table->string('symbol')->nullable();
            $table->string('personality')->nullable();
            $table->string('mbti_type')->nullable();
            $table->string('sensing_intuition')->nullable();
            $table->string('thinking_feeling')->nullable();
            $table->string('extroversion_introversion')->nullable();
            $table->string('judging_perceiving')->nullable();
        });
    }
}
