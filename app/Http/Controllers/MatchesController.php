<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Matches;
use App\User;
use File;
use DB;
use App\Reports;
use Auth;
use Session;
class MatchesController extends Controller
{
  public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Create new match
     *
     */
    public function store(Request $request){
        // select id from matches where user1 = 'me' and user2 = 'you' or user1 = 'you' and user2 = 'me'
        // if count > 0
        // no insert
        // else
        // insert
        if($request->input('driver')!=$request->input('sabayer'))
        {
          $matchCheck = Matches::where([
                  ['user1',$request->input('driver')],
                  ['user2',$request->input('sabayer')]
                ])->orWhere([
                  ['user1',$request->input('sabayer')],
                  ['user2',$request->input('driver')]
                ])->count();

                if($matchCheck==0){
                  $newMatch = new Matches;
                  $newMatch->user1 = $request->input('driver');
                  $newMatch->user2 = $request->input('sabayer');
                  $newMatch->save();
                  // $latestMatch = Matches::find(DB::table('matches')->max('id'));
                  $latestMatch = Matches::where([
                    ['user1',$request->input('driver')],//user1=driver
                    ['user2',$request->input('sabayer')]//user2=sabayer
                    ])->first();
                  File::put('scripts/chatrooms/'.$latestMatch->id.'.txt','');
                }
                else
                {
                  $existingMatch = Matches::where([
                  ['user1',$request->input('driver')],
                  ['user2',$request->input('sabayer')]
                  ])->orWhere([
                    ['user1',$request->input('sabayer')],
                    ['user2',$request->input('driver')]
                  ])->first();

                  $existingMatch->matched_again = 1;
                  $existingMatch->save();
                }
          }
    }
    /**
     * Submit report
     *
     */
    public function submitreport(Request $request){
        $newReport =  new Reports;
        $newReport->submittedByName = Auth::user()->firstName." ".Auth::user()->lastName;
        $newReport->submittedByID = Auth::user()->studentID;
        $newReport->content = $request->input('reportContent');
        $newReport->category = $request->input('reportCategory');
        $newReport->violatorID = $request->input('userID');
        $newReport->violatorName=$request->input('userName');
        $newReport->save();
        //Session::flash('alert-success',"Report successfully submitted. Thank you for helping the community be a better place!");
    }
/**
     * Rate User
     *
     */
    public function thumbRating(Request $request){
      $user = User::where('studentID',$request->input('userID'))->first();
      $matchCheck = Matches::where([
                  ['user1',$request->input('userID')],
                  ['user2',Auth::user()->studentID]
                ])->orWhere([
                  ['user1',Auth::user()->studentID],
                  ['user2',$request->input('userID')]
                ])->first();
      $driver=0;
      $passenger=0;
      if($matchCheck->user1 == Auth::user()->studentID){
        $passenger=1;
      }else{
        $driver=1;
      }

      if($request->input('rating') == "UP"){
        $user->thumbs_up = $user->thumbs_up + 1;
        if ($driver ==1) {
          $matchCheck->isRatedUser1 = 1;
        }
        else if ($passenger==1) {
          $matchCheck->isRatedUser2 =1;
        }
      }
      else if($request->input('rating') == "DOWN"){
        $user->thumbs_down = $user->thumbs_down + 1;
        if ($driver ==1) {
          $matchCheck->isRatedUser1 = 1;
        }
        else if ($passenger==1) {
          $matchCheck->isRatedUser2 =1;
        }
      }
      $user->save();
      $matchCheck->save();

    }
    /**
     * Delete match
     *
     */
    public function deleteMatch(Request $request){
      $goodbye = Matches::where('id',$request->input('id'))->first();
      if($goodbye->user1 == Auth::User()->studentID){
        $goodbye->isDeleted=1;
      }
      else if($goodbye->user2 == Auth::User()->studentID){
        $goodbye->isDeleted=2;
      }
      $goodbye->save();
    }
    /**
     * Restor match
     *
     */
    public function reviveMatch(Request $request){
      $longTimeNoSee = Matches::where('id', $request->input('id'))->first();
      $longTimeNoSee->isDeleted=0;
      $longTimeNoSee->save();
    }
}
