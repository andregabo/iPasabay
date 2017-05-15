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

Route::get('/profile', 'HomeController@ProfileIndex')->middleware('auth');

Route::patch('/editprofile','HomeController@editProfile')->name('editprofile')->middleware('auth');

Route::post('/storepoints', 'RoutesController@storePickUp')->middleware('auth');

Route::post('/storepaths','RoutesController@storePath')->middleware('auth');

Route::post('/storematch','MatchesController@store')->middleware('auth');

Route::get('/matches',function(){
	return view('matches');
})->middleware('auth');

Route::post('submitreport', 'MatchesController@submitreport');

Route::post('updown', 'MatchesController@thumbRating');

Route::get('unauthorized', function(){
	return view('unauthorized');});
