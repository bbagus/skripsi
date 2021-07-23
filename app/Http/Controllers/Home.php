<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class Home extends Controller
{
    public function index(){
    	if (Auth::check()) {
    		$login = true;
    		return view('home.home', ['login' => $login]);
		}
			$login = false;
    		return view('home.home', ['login' => $login]);
	}
}
