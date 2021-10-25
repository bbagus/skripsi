<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Repositories\UserRepository;

class GuruBimbingan extends Controller
{
	public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }
    public function SiswaBimbingan(UserRepository $repository){
		return View('guru.siswaBimbingan')->with('user', $this->repository->getData());
	}
    public function LaporanMingguan(UserRepository $repository){
        return View('guru.laporanMingguan')->with('user', $this->repository->getData());
    }
    public function LaporanPKL(UserRepository $repository){
        return View('guru.laporanPkl')->with('user', $this->repository->getData());
    }
}
