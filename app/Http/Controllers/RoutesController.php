<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Routes;
use Auth;
use Session;
class RoutesController extends Controller
{
    public function setRouteIndex(){
		return view('autoroute');
    }
    public function setPickupIndex(){
    	return view('setpickup');
    }
    public function storePickUp(Request $request){
    	//$name= Auth::user()->studentID;
    	$testdb = Routes::where('userID', Auth::user()->studentID)->first();
		//$testdb->userID = Auth::user()->studentID;
		$testdb->pickup= ['lng'=>$request->input('plong'), 'lat'=>$request->input('plat'),'radius'=>$request->input('prad')];
		$testdb->save();
		Session::flash('alert-info',"Pickup Point has been successfully saved!");

		return redirect('home');
    }

    public function storePath(Request $request){
    	//$name= Auth::user()->studentID;
    	$testdb = Routes::where('userID', Auth::user()->studentID)->first();
    	$testdb->path=['lng'=>$request->input('plong'), 'lat'=>$request->input('plat')];
    	$testdb->save();
    	Session::flash('alert-info',"Path has been successfully saved!");

    	return redirect('home');
    }
}
