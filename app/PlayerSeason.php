<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlayerSeason extends Model
{
    public function team()
    {
        return $this->belongsTo("App\Team");
    }

    public function league()
    {
        return $this->belongsTo("App\League");
    }

    public function player()
    {
        return $this->belongsTo("App\Player");
    }
}
