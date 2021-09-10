<?php

namespace App\Http\Controllers;
use App\Repositories\UserRepository;

class AdminDashboard extends Controller
{
	public function __construct(UserRepository $repository)
    {
        $this->middleware('auth');
        $this->repository = $repository;
    }
    public function dashboard(){
        $user = $this->repository->getData();
		return view('admin.dashboard')->with('user', $user);
	}
}
