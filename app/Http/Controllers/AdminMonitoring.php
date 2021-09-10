<?php

namespace App\Http\Controllers;
use App\Repositories\UserRepository;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;define('', '');
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File; 


class AdminMonitoring extends Controller
{
	public function __construct(UserRepository $repository)
    {
        $this->middleware('auth');
        $this->repository = $repository;
    }
    public function index(){
        $user = $this->repository->getData();
		return view('admin.laporanMingguan')->with('user', $user);
	}

   public function laporanPKL(){
        $user = $this->repository->getData();
        return view('admin.laporanPkl')->with('user', $user);
    }
    public function nilai(){
        $user = $this->repository->getData();
        return view('admin.nilai')->with('user', $user);
    }
}

