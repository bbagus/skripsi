<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\{Auth,DB};
use Illuminate\Http\Request;
use App\Repositories\UserRepository;

class Home extends Controller
{
	private $repository;
	public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }
    public function index(UserRepository $repository){
    	if (Auth::check() != null ) {
        return View('home.home')->with('user', $this->repository->getData());	
        }
         return View('home.home');
	}
}
