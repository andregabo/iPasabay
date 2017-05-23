<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Routes;
use Auth;
use Session;
use App\Matches;
class RoutesController extends Controller
{
    public function setRouteIndex(){
      $routes =Routes::where('pickup','exists',true)->project(['_id'=>0])->get(['userID','pickup']);



		return view('autoroute')->with('routes',$routes);
    }
    public function setPickupIndex(){
      $routes =Routes::where('path','exists',true)->project(['_id'=>0])->get(['userID','path']);

    	return view('setpickup')->with('routes',$routes);
    }
    public function storePickUp(Request $request){
      Matches::where('user2', Auth::user()->studentID)->delete();
    	//$name= Auth::user()->studentID;
    	$testdb = Routes::where('userID', Auth::user()->studentID)->first();
		//$testdb->userID = Auth::user()->studentID;
		$testdb->pickup= ['lng'=>$request->input('plong'), 'lat'=>$request->input('plat'),'radius'=>$request->input('prad')];
		$testdb->save();
		//Session::flash('alert-info',"Pickup Point has been successfully saved!");

		// return redirect('home');
    }

    public function storePath(Request $request){
      Matches::where('user1', Auth::user()->studentID)->delete();
    	//$name= Auth::user()->studentID;
    	$testdb = Routes::where('userID', Auth::user()->studentID)->first();
    	$testdb->path=['lng'=>$request->input('plong'), 'lat'=>$request->input('plat')];
    	$testdb->save();
    	//Session::flash('alert-info',"Path has been successfully saved!");

    	// return redirect('home');
    }
}
