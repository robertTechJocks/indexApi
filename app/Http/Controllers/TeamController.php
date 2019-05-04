<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Team;
use App\Season;

class TeamController extends Controller
{
    private $currentSeason;

    public function __construct()
    {
        $this->currentSeason = Season::where("current", 1)->first();
    }

    public function index()
    {
        return response()->json(Team::all());
    }

    public function show($id)
    {
        $team = Team::with(['seasons' => function ($query) {
            $query->where('season_id', $this->currentSeason->id);
        }])
        ->where("id", $id)
        ->first();
        $team->seasons[0]->roster($this->currentSeason->id);

        return response()->json($team);
    }
}
