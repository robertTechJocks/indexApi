<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Player;
use App\Season;
use App\PlayerEquipment;
use App\Equipment;
use App\Training;
use App\PlayerTraining;
use Carbon\Carbon;

class PlayerController extends Controller
{
    public function __construct()
    {
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

    public function purchaseEquipment(Request $request, $id)
    {
        $player = Player::find($id);

        $equipment = Equipment::find($request->input("equipment_id"));

        $currentSeason = $this->getCurrentSeason($equipment->league_id);

        if(PlayerEquipment::where("equipment_id", $request->input("equipment_id"))->where("season_id", $currentSeason->id)->where("player_id", $id)->first())
        {
            return response()->json(["error" => "Equipment already purchased this season"]);
        }

        if(($player->bank_balance - $equipment->price) < 0)
        {
            return response()->json(["error" => "Insufficient funds"]);
        }

        if($player->player_type !== $equipment->player_type)
        {
            return response()->json(["error" => "Incorrect player type for equipment"]);
        }

        $player->bank_balance -= $equipment->price;

        $equipmentLog = new PlayerEquipment;
        $equipmentLog->equipment_id = $request->input("equipment_id");
        $equipmentLog->season_id = $currentSeason->id;
        $equipmentLog->player_id = $id;
        $equipmentLog->save();


        $playerRestrictedTPE = (array) $player->restricted_tpe;

        foreach ($request->input("restricted_tpe") as $stat => $tpe) {
            if(isset($playerRestrictedTPE[$stat]))
                $playerRestrictedTPE[$stat] += $tpe; 
            else
                $playerRestrictedTPE[$stat] = $tpe;
        }

        $player->restricted_tpe = json_encode($playerRestrictedTPE);
        $player->update();

        return response()->json(["success" => "Equipment purchased successfully"]);
    }

    public function purchaseTraining(Request $request, $id)
    {
        $player = Player::find($id);

        $training = Training::find($request->input("training_id"));

        $monday = Carbon::now()->startOfWeek();

        if(PlayerTraining::where("created_at", ">", $monday->toDateTimeString())->where("player_id", $id)->first())
        {
            return response()->json(["error" => "Training already purchased this week"]);
        }

        if(($player->bank_balance - $training->price) < 0)
        {
            return response()->json(["error" => "Insufficient funds"]);
        }

        $player->bank_balance -= $training->price;

        $trainingLog = new PlayerTraining;
        $trainingLog->training_id = $request->input("training_id");
        $trainingLog->player_id = $id;
        $trainingLog->save();

        $player->free_tpe += $training->tpe_gain;

        $player->update();

        return response()->json(["success" => "Training purchased successfully"]);
    }
}
