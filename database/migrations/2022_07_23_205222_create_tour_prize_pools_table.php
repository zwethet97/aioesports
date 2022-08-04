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
        Schema::create('tour_prize_pools', function (Blueprint $table) {
            $table->id();
            $table->string('tour_id');
            $table->string('unit');
            $table->string('1_team_name');
            $table->string('2_team_name');
            $table->string('3_team_name');
            $table->string('4_team_name');
            $table->string('5_team_name');
            $table->string('6_team_name');
            $table->string('7_team_name');
            $table->string('8_team_name');
            $table->string('9_team_name');
            $table->string('10_team_name');
            $table->string('1_team_logo');
            $table->string('2_team_logo');
            $table->string('3_team_logo');
            $table->string('4_team_logo');
            $table->string('5_team_logo');
            $table->string('6_team_logo');
            $table->string('7_team_logo');
            $table->string('8_team_logo');
            $table->string('9_team_logo');
            $table->string('10_team_logo');
            $table->string('1_team_unit');
            $table->string('2_team_unit');
            $table->string('3_team_unit');
            $table->string('4_team_unit');
            $table->string('5_team_unit');
            $table->string('6_team_unit');
            $table->string('7_team_unit');
            $table->string('8_team_unit');
            $table->string('9_team_unit');
            $table->string('10_team_unit');
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
        Schema::dropIfExists('tour_prize_pools');
    }
};
