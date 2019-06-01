<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    public function getSimStatsAttribute($value)
    {
        return json_decode($value);
    }

    public function getRestrictedTpeAttribute($value)
    {
        return json_decode($value);
    }

    public function seasons()
    {
        return $this->hasMany('App\PlayerSeason');
    }

    public function equipment()
    {
        return $this->hasMany('App\PlayerEquipment');
    }

    public function training()
    {
        return $this->hasMany('App\PlayerTraining');
    }

    public function checkTPE()
    {
        
    }

}
