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
        Schema::create('team_players', function (Blueprint $table) {
            $table->id();
            $table->string('team_id');
            $table->string('coach_id');
            $table->string('analyst_id');
            $table->string('pos1_id');
            $table->string('pos2_id');
            $table->string('pos3_id');
            $table->string('pos4_id');
            $table->string('pos5_id');
            $table->string('pos6_id');
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
        Schema::dropIfExists('team_players');
    }
};
