<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\TestModel;
use App\Routes;
use Auth;

class MessagesController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * View messages page
     *
     */
    public function index(){
			return view('messages');


    }
}
