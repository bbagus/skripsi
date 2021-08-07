<?php

namespace App\Http\Controllers;

class AdminDashboard extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
    public function dashboard(){
		return view('admin.dashboard');
	}
}
