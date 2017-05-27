<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
	if(Auth::guest())
    return view('auth.login');
    else
    return redirect()->action('HomeController@index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->middleware('auth');
// Admin Middleware Group

	Route::get('messages', 'MessagesController@index')->middleware('auth');
	Route::get('/setpickup', 'RoutesController@setPickupIndex')->middleware('auth');
	Route::get('/getroute', 'RoutesController@setRouteIndex')->middleware('auth');
//end middleward group

Route::get('/profile', 'HomeController@details')->middleware('auth');

Route::patch('/editprofile','HomeController@editProfile')->name('editprofile')->middleware('auth');

Route::post('/storepoints', 'RoutesController@storePickUp')->middleware('auth');

Route::post('/storepaths','RoutesController@storePath')->middleware('auth');

Route::post('/storematch','MatchesController@store')->middleware('auth');

Route::get('/matches',function(){
	return view('matches');
})->middleware('auth');

Route::post('submitreport', 'MatchesController@submitreport')->middleware('auth');

Route::post('updown', 'MatchesController@thumbRating')->middleware('auth');

Route::put('removematch', 'MatchesController@deleteMatch')->middleware('auth');

Route::put('revivematch', 'MatchesController@reviveMatch')->middleware('auth');

Route::get('unauthorized', function(){
	return view('unauthorized');});

Route::get('afterRegister', 'HomeController@afterRegister');

Route::patch('changepassword','HomeController@changePassword');

Route::get('help','HomeController@helpIndex');

Route::post('banuser', 'RoutesController@addBan');

Route::post('unbanuser', 'RoutesController@removeBan');
