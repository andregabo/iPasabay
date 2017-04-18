<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\TestModel;

class MessagesController extends Controller
{
    public function index(){
    	$testdb = new TestModel;
		$testdb->name = 'Andre';
		$testdb->save();
    	return view('messages');
    }
}
