<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Siswa;

class SiswaBimbingan extends Controller
{
    private $repository;
    public function __construct(UserRepository $repository)
    {
        $this->middleware('auth');
        $this->repository = $repository;
    }
    public function laporanMingguan(UserRepository $repository){
        $user = $this->repository->getData();
        return View('siswa.laporanMingguan')
        ->with('user', $user);
    }
    public function laporanPKL(UserRepository $repository){
        $user = $this->repository->getData();
        return View('siswa.laporanPkl')
        ->with('user', $user);
    }
}

