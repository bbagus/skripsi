<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Repositories\UserRepository;

class Pedoman extends Controller
{
	private $repository;
	public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }
    public function index(UserRepository $repository){
    	if (Auth::check() != null ) {
        return View('home.pedoman')->with('user', $this->repository->getData());	
        }
         return View('home.pedoman');
	}
}
