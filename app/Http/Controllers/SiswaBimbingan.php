<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\{DB,Validator};
use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\Models\{User,Siswa};

class SiswaBimbingan extends Controller
{
    private $repository;
    public function __construct(UserRepository $repository)
    {
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

