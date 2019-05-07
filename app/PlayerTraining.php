<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlayerTraining extends Model
{
    protected $table = "player_training";

    public function details()
    {
        return $this->hasOne("App\Training", "id");
    }
}
