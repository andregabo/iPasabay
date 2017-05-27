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
  public function __construct()
    {
        $this->middleware('auth');
    }
    public function setRouteIndex(){
      $routes =Routes::where('pickup','exists',true)->project(['_id'=>0])->get(['userID','pickup']);
      $myPath = Routes::where('path','exists',true)->where('userID',Auth::User()->studentID)->project(['_id'=>0])->get(['userID','path']);


		return view('autoroute')->with('routes',$routes)->with('myPath', $myPath);
    }
    public function setPickupIndex(){
      $routes = Routes::where('path','exists',true)->project(['_id'=>0])->get(['userID','path']);
      $myPickup = Routes::where('pickup','exists',true)->where('userID',Auth::User()->studentID)->project(['_id'=>0])->get(['userID','pickup']);
    	return view('setpickup')->with('routes',$routes)->with('myPickup',$myPickup);
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

    public function addBan(Request $request){
      $testdb = Routes::where('userID', Auth::user()->studentID)->push('banList', $request->input('banID'), true);
      //$testdb->banList=[$request->input('banID')];

    }

    public function removeBan(Request $request)
    {
      $testdb = Routes::where('userID', Auth::user()->studentID)->pull('banList', $request->input('banID'));
      //$testdb->banList=[$request->input('banID')];
      
    }
}
