<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;define('', '');
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File; 


class AdminPengajuan extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){

		return view('admin.pengajuan');
	}
   
}

