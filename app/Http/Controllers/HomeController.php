<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TestModel;
use App\User;
use App\Routes;
use File;
use App\Matches;
use DB;
use Auth;
use Session;
use Hash;
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
    /**
     * Show the application link to help page.
     *
     * @return \Illuminate\Http\Response
     */
    public function helpIndex(){
      return view('help');
    }
    /**
     * Edit profile page
     *
     * @return \Illuminate\Http\Response
     */
    public function editProfile(Request $request){
      $user = User::where('studentID',$request->input('studentID'))->first();
      $user->studentID = $request->input('studentID');
      $user->firstName= $request->input('firstName');
      $user->lastName = $request->input('lastName');
      $user->save();

      return redirect('profile');
    }
    /**
     * Show the application profile page.
     *
     * @return \Illuminate\Http\Response
     */
    public function details(){
      $id = Auth::User()->studentID;
      $path = NULL;
      $routes = NULL;
    	$usersSql = User::where('studentID',$id)->first();//all info of user in sql
      	$routes =Routes::where('pickup','exists',true)->where('userID',$id)->project(['_id'=>0])->first(['userID','pickup']);
        if($routes != NULL){
        $plong = $routes->pickup["lng"];
      	$plat = $routes->pickup["lat"];
      }else{
        $plong = 'none';
        $plat = 'none';
      }
        $path = Routes::where('path','exists',true)->where('userID',$id)->project(['_id'=>0])->first(['userID','path']);
        if($path != NULL){
        $rlong = $path->path["lng"];
        $rlat = $path->path["lat"];
        }
        else{
          $rlong = 'none';
          $rlat = 'none';
        }
        $route = Routes::where('userID', Auth::user()->studentID)->where('banList','exists',true)->first();
        if($route==null){
          $route=[];
        }else {
          $route = $route->banList;
        }
      //reports
    	return view('profile')->with('user',$usersSql)->with('plong',$plong)->with('plat',$plat)->with('rlong',$rlong)->with('rlat',$rlat)
      ->with('banList',$route);
    }
    /**
     * Redirect after registration
     *
     * @return \Illuminate\Http\Response
     */
    public function afterRegister(){
      auth::logout();
      Session::flash('alert-info',"This account is currently disabled for approval. See OSAS for activation.");

      return redirect('/');
    }
    /**
     * Change password
     *
     * @return \Illuminate\Http\Response
     */
    public function changePassword(Request $request){
      $currentUser = User::where('studentID',Auth::user()->studentID)->first();
        if(Hash::check($request->input('oldPassword'),$currentUser->password)){
            if($request->input('newPassword')!=$request->input('confirmPassword')){
            Session::flash('alert-danger',"Password and Password Confirm does not match");
            return redirect('profile');
            }else{
                $currentUser->password = bcrypt($request->input('newPassword'));
                $currentUser->save();
                Session::flash('alert-success',"Please re-login with your new password");
                Auth::logout();
                return redirect('/');
            }
        }else{
            Session::flash('alert-danger',"That is not your current password");
            return redirect('profile');

        }
    }
}
