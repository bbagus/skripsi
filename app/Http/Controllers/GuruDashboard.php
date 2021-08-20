<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;define('', '');
use App\Repositories\UserRepository;

class GuruDashboard extends Controller
{
	public function __construct(UserRepository $repository)
    {
        $this->middleware('auth');
        $this->repository = $repository;
    }
    public function dashboard(UserRepository $repository){

		return View('guru.dashboard')->with('user', $this->repository->getData());
	}
}
