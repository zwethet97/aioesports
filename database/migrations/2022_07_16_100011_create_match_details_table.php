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
        Schema::create('match_details', function (Blueprint $table) {
            $table->id();
            $table->string('tourmatch_id');
            $table->string('game');
            $table->string('bo');
            $table->string('team1_id');
            $table->string('team2_id');
            $table->string('g1');
            $table->string('g2');
            $table->string('g3');
            $table->string('g4');
            $table->string('g5');
            $table->string('g6');
            $table->string('g7');
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
        Schema::dropIfExists('match_details');
    }
};
