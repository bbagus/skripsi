<?php

namespace App\Http\Controllers;
use App\Repositories\UserRepository;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB,Validator,File};

class AdminMonitoring extends Controller
{
	public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }
    public function index(){
		return view('admin.laporanMingguan')->with('user', $this->repository->getData());
	}

   public function laporanPKL(){
        return view('admin.laporanPkl')->with('user', $this->repository->getData());
    }
    public function nilai(){
        return view('admin.nilai')->with('user', $this->repository->getData());
    }
}

