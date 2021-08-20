<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;define('', '');
use App\Repositories\UserRepository;

class GuruNilai extends Controller
{
	public function __construct(UserRepository $repository)
    {
        $this->middleware('auth');
        $this->repository = $repository;
    }
    public function index(UserRepository $repository){
		return View('guru.nilai')->with('user', $this->repository->getData());
	}
}
