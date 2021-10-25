<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;

class SiswaDashboard extends Controller
{
	public function __construct(UserRepository $repository)
    {

        $this->repository = $repository;
    }
    public function dashboard(UserRepository $repository){

		return View('siswa.dashboard')->with('user', $this->repository->getData());
	}
}
