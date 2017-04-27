<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Matches;
use File;
use DB;
class MatchesController extends Controller
{
    public function store(Request $request){
        // select id from matches where user1 = 'me' and user2 = 'you' or user1 = 'you' and user2 = 'me'
        // if count > 0
        // no insert
        // else
        // insert

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

    }
}
