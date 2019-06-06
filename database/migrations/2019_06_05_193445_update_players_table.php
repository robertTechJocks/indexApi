<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdatePlayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('players', function (Blueprint $table) {
            $table->string("mybb_username");
            $table->integer('total_points_earned')->default(0);
            $table->boolean('rookie_shl')->default(0);
            $table->boolean('rookie_smjhl')->default(0);
            $table->string("country");
            $table->integer("position");
            $table->integer("year");
            $table->integer("month");
            $table->integer("day");
            $table->integer("weight");
            $table->integer("height");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('players', function (Blueprint $table) {
            $table->dropColumn('mybb_username');
            $table->dropColumn('total_points_earned');
            $table->dropColumn('rookie_shl');
            $table->dropColumn('rookie_smjhl');
            $table->dropColumn('country');
            $table->dropColumn('position');
            $table->dropColumn('year');
            $table->dropColumn('month');
            $table->dropColumn('day');
            $table->dropColumn('weight');
            $table->dropColumn('height');
        });
    }
}
