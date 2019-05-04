<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Player;

class PlayerController extends Controller
{
    //
    public function index()
    {
        return response()->json(Player::all());
    }

    public function show($id)
    {
        return response()->json(Player::find($id));
    }
}
