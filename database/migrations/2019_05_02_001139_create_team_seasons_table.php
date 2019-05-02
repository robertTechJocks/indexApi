<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamSeasonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('team_seasons', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('team_id');
            $table->integer('wins')->nullable();
            $table->integer('losses')->nullable();
            $table->integer('overtime_losses')->nullable();
            $table->string('season_result')->nullable();
            $table->integer('season_id');
            $table->integer('league_id');
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
        Schema::dropIfExists('team_seasons');
    }
}
