<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlayerEquipment extends Model
{
    protected $table = "player_equipment";

    public function details()
    {
        return $this->hasOne("App\Equipment", "id", "equipment_id");
    }
}
