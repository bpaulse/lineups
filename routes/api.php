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

Route::get('/lineups/{station}/{lineupdate}', 'LineUpController@lineup');
Route::get('/djslots/{period}/{name_surnane_str}', 'LineUpController@getDJSlots');
// Route::get('/lineups/{station}/', 'LineUpController@index');
// Route::get('/lineups/{station}/', 'LineUpController@index');