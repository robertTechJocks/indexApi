<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function () {
    Route::get('players', "PlayerController@index");
    Route::get('players/{id}', "PlayerController@show");

    Route::get('equipment', "EquipmentController@index");
    Route::get('equipment/{id}', "EquipmentController@show");

    Route::get('teams', "TeamController@index");
    Route::get('teams/{id}', "TeamController@show");
});