<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TestModel;
use App\User;
use File;
use App\Matches;
use DB;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
    public function ProfileIndex()
    {
      return view('profile');
    }
    public function editProfile(Request $request){
      $user = User::where('studentID',$request->input('studentID'))->first();
      $user->studentID = $request->input('studentID');
      $user->firstName= $request->input('firstName');
      $user->lastName = $request->input('lastName');
      $user->save();

      return redirect('profile'); 
    }
}
