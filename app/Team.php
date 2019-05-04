<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    public function seasons()
    {
        return $this->hasMany('App\TeamSeason');
    }
}
