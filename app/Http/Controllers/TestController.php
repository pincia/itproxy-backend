<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    function test(){
    	$codice = \App\impianto::where('codice_impianto', 'WOLLS19;')->first()->codice_registrazione;

    	echo $codice;
}
}
