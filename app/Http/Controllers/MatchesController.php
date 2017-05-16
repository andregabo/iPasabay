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
                    ['user1',$request->input('driver')],
                    ['user2',$request->input('sabayer')]
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

    public function thumbRating(Request $request){
      $user = User::where('studentID',$request->input('userID'))->first();
      if($request->input('rating') == "UP"){
        $user->thumbs_up = $user->thumbs_up + 1;
      }
      else if($request->input('rating') == "DOWN"){
        $user->thumbs_down = $user->thumbs_down + 1;
      }
      $user->save();
    }

    public function deleteMatch(Request $request){
      $goodbye = Matches::where('id',$request->input('id'))->first();
      $goodbye->delete();
    }
}
