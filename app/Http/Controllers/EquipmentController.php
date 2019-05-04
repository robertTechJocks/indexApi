<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Equipment;

class EquipmentController extends Controller
{
    //
    public function index()
    {
        return response()->json(Equipment::all());
    }

    public function show($id)
    {
        return response()->json(Equipment::find($id));
    }
}
