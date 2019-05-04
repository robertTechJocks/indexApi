<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatsToTeamSeasons extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('team_seasons', function (Blueprint $table) {
            $table->integer("goals_for")->default(0);
            $table->integer("goals_against")->default(0);
            $table->float("power_play_percentage")->default(0);
            $table->float("penalty_kill_percentage")->default(0);
            $table->integer("shots_for")->default(0);
            $table->integer("shots_against")->default(0);
            $table->integer("pims_per_game")->default(0);
            $table->integer("hits_per_game")->default(0);
            $table->float("faceoff_percentage")->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('team_seasons', function (Blueprint $table) {
            $table->dropColumn("goals_for");
            $table->dropColumn("goals_against");
            $table->dropColumn("power_play_percentage");
            $table->dropColumn("penalty_kill_percentage");
            $table->dropColumn("shots_for");
            $table->dropColumn("shots_against");
            $table->dropColumn("pims_per_game");
            $table->dropColumn("hits_per_game");
            $table->dropColumn("faceoff_percentage");
        });
    }
}
