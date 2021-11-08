<?php

namespace App\Http\Controllers;
use App\Repositories\UserRepository;

class AdminDashboard extends Controller
{
	public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }
    public function dashboard(){
		return view('admin.dashboard')->with('user', $this->repository->getData());
	}
}
