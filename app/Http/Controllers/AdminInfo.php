<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;define('', '');


class AdminInfo extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
		return view('admin.informasi');
	}
}