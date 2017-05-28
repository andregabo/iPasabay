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
      $route = Routes::where('userID', Auth::user()->studentID)->where('banList','exists',true)->first();
      $iAmBanned = Routes::where('banList','exists',true)->where('banList', 'all', [Auth::user()->studentID])->get();
      if($route==null){
        $route=[];
      }else {
        $route = $route->banList;
      }

      $studentIDs = [];

      if($iAmBanned == null){
        $studentIDs = [];
      }
      else {
        foreach($iAmBanned as $key => $value)
        {
          $studentIDs[] = $value->userID;
        }
      }


      $myPath = Routes::where('path','exists',true)->where('userID',Auth::User()->studentID)->project(['_id'=>0])->get(['userID','path']);


		return view('autoroute')->with('routes',$routes)->with('myPath', $myPath)->with('banList',$route)->with('bannedList',$studentIDs);
    }
    public function setPickupIndex(){
      $routes = Routes::where('path','exists',true)->project(['_id'=>0])->get(['userID','path']);
      $route = Routes::where('userID', Auth::user()->studentID)->where('banList','exists',true)->first();
      $iAmBanned = Routes::where('banList','exists',true)->where('banList', 'all', [Auth::user()->studentID])->get();
      if($route==null){
        $route=[];
      }else {
        $route = $route->banList;
      }

      $studentIDs = [];

      if($iAmBanned == null){
        $studentIDs = [];
      }
      else {
        foreach($iAmBanned as $key => $value)
        {
          $studentIDs[] = $value->userID;
        }
      }



      $myPickup = Routes::where('pickup','exists',true)->where('userID',Auth::User()->studentID)->project(['_id'=>0])->get(['userID','pickup']);
    	return view('setpickup')->with('routes',$routes)->with('myPickup',$myPickup)->with('banList',$route)->with('bannedList',$studentIDs);
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
      $matches = Matches::where('user1', Auth::user()->studentID)->orWhere('user2', Auth::user()->studentID)->get();
      foreach ($matches as $key => $value) {
        echo $value->user1;
        if( ($value->user1 == Auth::user()->studentID && $value->user2 == $request->input('banID')) || ($value->user2 == Auth::user()->studentID && $value->user1 == $request->input('banID')) ){
          //Bingo found the match
          if($value->user1 == Auth::user()->studentID && $value->user2 == $request->input('banID')){
            //isDeleted = 1
            $value->isDeleted = 1;
          }
          else{
            //usDeleted = 2
            $value->isDeleted = 2;
          }
          $value->save();
        }
      }
      $testdb = Routes::where('userID', Auth::user()->studentID)->push('banList', $request->input('banID'), true);
      // $testdb->banList=[$request->input('banID')];

    }

    public function removeBan(Request $request){
      $matches = Matches::where('user1', Auth::user()->studentID)->orWhere('user2', Auth::user()->studentID)->get();
      foreach ($matches as $key => $value) {
        if( ($value->user1 == Auth::user()->studentID && $value->user2 == $request->input('banID')) || ($value->user2 == Auth::user()->studentID && $value->user1 == $request->input('banID')) ){
          //Bingo found the match
          $value->isDeleted = 0;
          $value->save();
        }
      }
      $testdb = Routes::where('userID', Auth::user()->studentID)->pull('banList', $request->input('banID'));
      //$testdb->banList=[$request->input('banID')];

    }
}
