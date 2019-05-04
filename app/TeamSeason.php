<?php

namespace App;
use App\Player;
use App\PlayerSeason;

use Illuminate\Database\Eloquent\Model;

class TeamSeason extends Model
{
    public function roster($seasonID)
    {
        $roster = PlayerSeason::with(['player' => function ($query) {
            $query->select('id','name');
        }])->where("team_id", $this->team_id)->where("season_id", $seasonID)->get()->pluck("player");


        $this->roster = $roster;
    }
}
