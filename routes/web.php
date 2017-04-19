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

Route::get('/home', 'HomeController@index');
// Admin Middleware Group
Route::group(['middleware' => 'App\Http\Middleware\AdminMiddleware'], function() {

	Route::get('messages', 'MessagesController@index');
	Route::get('/setpickup', 'RoutesController@setPickupIndex');
	Route::get('/getroute', 'RoutesController@setRouteIndex');
});
//end middleward group

Route::get('/profile', 'HomeController@ProfileIndex');

Route::patch('/editprofile','HomeController@editProfile')->name('editprofile');

Route::post('/storepoints', 'RoutesController@storePickUp');

Route::get('unauthorized', function(){
	return view('unauthorized');});
