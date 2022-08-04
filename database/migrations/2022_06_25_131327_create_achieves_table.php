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
        Schema::create('achieves', function (Blueprint $table) {
            $table->id();
            $table->string('player_id');
            $table->string('team_id');
            $table->string('team_logo');
            $table->string('team_name');
            $table->string('tour_name');
            $table->string('tier');
            $table->string('place');
            $table->string('as');
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
        Schema::dropIfExists('achieves');
    }
};
