<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Siswa;

class SiswaPengajuan extends Controller
{
    private $repository;
    public function __construct(UserRepository $repository)
    {
        $this->middleware('auth');
        $this->repository = $repository;
    }
    public function index(UserRepository $repository){
        $user = $this->repository->getData();
        return View('siswa.pengajuan')
        ->with('user', $user);
    }
}

