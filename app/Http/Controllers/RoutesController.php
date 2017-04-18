<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class RoutesController extends Controller
{
    public function setRouteIndex(){
		return view('autoroute');
    }
    public function setPickupIndex(){
    	return view('setpickup');
    }
}
