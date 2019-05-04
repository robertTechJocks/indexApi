<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTypeAndSkaterTypeToEquipment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('equipment', function (Blueprint $table) {
            $table->enum("equipment_type", ["stick", "gloves", "skates", "shoulder_pads", "goalie_skates", "goalie_gloves", "goalie_pads"]);
            $table->enum("player_type", ["skater", "goalie"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('equipment', function (Blueprint $table) {
            $table->dropColumn("equipment_type");
            $table->dropColumn("player_type");
        });
    }
}
