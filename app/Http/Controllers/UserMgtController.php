<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Session;
use App\User;
class UserMgtController extends Controller
{
    public function index(){

    	$users = User::where('isDeleted',0)->get();
    	$tableCounter=1;
    	return view('usermgt')->with('users',$users)->with('tableCounter',$tableCounter);
    }

    public function softDelete($userID){
    	$thisGuy = User::where('studentID',$userID)->first();
    	if($thisGuy->isAdmin){
    	Session::flash('alert-danger',"User number $userID is a Founder. Don't reach young blood!");

    	return redirect('usermanagement');
    	}
    	else{
    	User::where('studentID',$userID)->update([
    		'isDeleted'=>1
    		]);
    	Session::flash('alert-success',"User number $userID has been deleted!");

    	return redirect('usermanagement');
    	}
    }
}
