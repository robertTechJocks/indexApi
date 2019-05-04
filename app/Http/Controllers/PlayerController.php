<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Player;
use App\Season;

class PlayerController extends Controller
{

    private $currentSeason;

    public function __construct()
    {
        $this->currentSeason = Season::where("current", 1)->first();
    }

    public function index()
    {
        return response()->json(Player::all());
    }

    public function show($id)
    {
        $player = Player::with(['seasons' => function ($query) {
            $query->with("team")->with("league")->where('season_id', $this->currentSeason->id);
        }])
        ->with(['equipment' => function ($query) {
            $query->with("details")->where('season_id', $this->currentSeason->id);
        }])
        ->where("id", $id)
        ->first();
        $player->teams;

        return response()->json($player);
    }
}
