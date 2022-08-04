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
        Schema::create('dota_game_drafts', function (Blueprint $table) {
            $table->id();
            $table->string('dotagame_id');
            $table->string('radiant');
            $table->string('dire');
            $table->string('b1');
            $table->string('b2');
            $table->string('b3');
            $table->string('b4');
            $table->string('p5');
            $table->string('p6');
            $table->string('p7');
            $table->string('p8');
            $table->string('b9');
            $table->string('b10');
            $table->string('b11');
            $table->string('b12');
            $table->string('b13');
            $table->string('b14');
            $table->string('p16');
            $table->string('p17');
            $table->string('p18');
            $table->string('b19');
            $table->string('b20');
            $table->string('b21');
            $table->string('b22');
            $table->string('p23');
            $table->string('p24');
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
        Schema::dropIfExists('dota_game_drafts');
    }
};
