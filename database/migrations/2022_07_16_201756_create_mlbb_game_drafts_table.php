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
        Schema::create('mlbb_game_drafts', function (Blueprint $table) {
            $table->id();
            $table->string('mlbbgame_id');
            $table->string('gl_b1');
            $table->string('gl_b2');
            $table->string('gl_b3');
            $table->string('gl_b4');
            $table->string('gl_b5');
            $table->string('gl_b6');
            $table->string('gl_b7');
            $table->string('gl_b8');
            $table->string('gl_b9');
            $table->string('gl_b10');
            $table->string('b1');
            $table->string('b2');
            $table->string('b3');
            $table->string('b4');
            $table->string('b5');
            $table->string('b6');
            $table->string('p7');
            $table->string('p8');
            $table->string('p9');
            $table->string('p10');
            $table->string('p11');
            $table->string('p12');
            $table->string('b13');
            $table->string('b14');
            $table->string('b15');
            $table->string('b16');
            $table->string('p17');
            $table->string('p18');
            $table->string('p19');
            $table->string('p20');
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
        Schema::dropIfExists('mlbb_game_drafts');
    }
};
