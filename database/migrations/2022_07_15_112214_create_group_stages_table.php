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
        Schema::create('group_stages', function (Blueprint $table) {
            $table->id();
            $table->string('tour_id');
            $table->string('team_id');
            $table->string('team_m');
            $table->string('team_w');
            $table->string('team_t');
            $table->string('team_l');
            $table->string('team_pos');
            $table->string('team_pts');
            $table->string('group');
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
        Schema::dropIfExists('group_stages');
    }
};
