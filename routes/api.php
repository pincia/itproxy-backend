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

Route::get('/impianto/{codice_impianto}/', function (Request $request, $codice_impianto) {
      $impianti =\DB::connection('mysql')->select('SELECT * from IMPIANTI WHERE codice_impianto="'.$codice_impianto.'"');
        	

       if ($impianti) return json_encode($impianti[0]);
       else return [];
});
