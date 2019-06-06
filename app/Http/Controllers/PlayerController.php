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
        $this->currentSeasons = Season::where("current", 1)->get()->pluck("id")->toArray();

        $player = Player::with(['seasons' => function ($query) {
            $query->with("team")->with("league")->whereIn('season_id', $this->currentSeasons);
        }])
        ->with(['equipment' => function ($query) {
            $query->with("details")->whereIn('season_id', $this->currentSeasons);
        }])
        ->with(['training' => function ($query) {
            $query->with("details");
        }])
        ->where("id", $id)
        ->first();
        $player->teams;
        $player->currentCappedTPE;

        return response()->json($player);
    }

    public function purchaseEquipment(Request $request, $id)
    {
        $player = Player::find($id);

        $equipment = Equipment::find($request->input("equipment_id"));

        $currentSeason = $this->getCurrentSeason($equipment->league_id);

        if(PlayerEquipment::with("details")->where("equipment_id", $request->input("equipment_id"))->where("season_id", $currentSeason->id)->where("player_id", $id)->first())
        {
            return response()->json(["error" => "Equipment already purchased this season"]);
        }
        $currentEquipment = PlayerEquipment::with("details")->where("season_id", $currentSeason->id)->where("player_id", $id)->get();
        foreach ($currentEquipment as $key => $currentEquipmentPiece) {
            if($currentEquipmentPiece->details->equipment_type == $equipment->equipment_type)
            {
                $type = $equipment->equipment_type;
                return response()->json(["error" => "Equipment type ($type) purchased this season"]);
            }
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

    public function showEquipment($id)
    {

        $equipmentLog = PlayerEquipment::with("details")->where("player_id", $id)->get();

        return response()->json($equipmentLog);
    }

    public function showTraining($id)
    {

        $trainingLog = PlayerTraining::with("details")->where("player_id", $id)->get();

        return response()->json($trainingLog);
    }

    public function getAllPlayersByUserID($id)
    {
        $players = Player::with(['seasons' => function ($query) {
            $query->with("team")->with("league");
        }])
        ->where("user_id", $id)
        ->get();
        foreach ($players as $key => $player) {
            $player->team;
        }

        return response()->json($players);
    }

    public function getCurrentPlayersByUserID($id)
    {
        $players = Player::where("user_id", $id)->get();
        foreach ($players as $key => $player) {
            $player->team;
            $player->currentCappedTPE;
        }

        return response()->json($players);
    }

    public function updatePlayer(Request $request, $id)
    {
        /*$players = Player::where("user_id", $id)->get();
        foreach ($players as $key => $player) {
            $player->team;
        }

        return response()->json($players);*/
    }

    public function updatePlayerAttributes(Request $request, $id)
    {
        //var_dump($request->all());
        $player = Player::find($id);
        $player->sim_stats = json_encode($request->get("sim_stats"));
        $player->free_tpe = $request->get("free_tpe");
        $player->save();
        return response()->json($player->save());
    }

}
