<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\TestModel;

class MessagesController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
    	$testdb = new TestModel;
		$testdb->name = 'Andre';
		$testdb->pickup= ['longitude'=>212, 'latitude'=>0101,'radius'=>100];
		$testdb->route = ['longitude'=>1212, 'latitude'=>121];
		$testdb->save();
    	return view('messages');
    }
}
