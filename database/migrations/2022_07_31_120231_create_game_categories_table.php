<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_categories', function (Blueprint $table) {
            $table->id();
            $table->string('talent_id');
            $table->string('main_game');
            $table->string('game_1');
            $table->string('game_2');
            $table->string('game_3');
            $table->string('game_4');
            $table->string('game_5');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('game_categories');
    }
};
