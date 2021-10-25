<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\{Auth,DB};
use Illuminate\Http\Request;
use Response;
use App\Repositories\UserRepository;

class Industri extends Controller
{
	private $repository;
	public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }
    public function index(UserRepository $repository){
        $industri = DB::table('industri')->get();

        if (Auth::check() != null ) return View('home.industri')->with('user', $this->repository->getData())->with('industri', $industri);	
        return View('home.industri')->with(compact('industri'));
    }
    public function detailIndustri($kd_industri){
        $industri = DB::table('industri')->where('kd_industri', $kd_industri)->first();
        if (Auth::check() != null ) return View('home.detailIndustri', ['industri' => $industri, 'user' => $this->repository->getData()]);
        return View('home.detailIndustri', ['industri' => $industri]);
    }
    public function filter (Request $request){
        if (isset($request->f) && isset($request->k)){
            $kolom = $request->k;
            $filter = $request->f;
            $katakunci = $request->kk;
            $test = explode(',',$request->test);
            $industri = DB::table('industri')
            ->whereIn($kolom, $test)
            ->where('nama', 'like', '%'.$katakunci.'%')
            ->get();
            $teks = 'Hasil pencarian : ';
            $search = (object)array();
            $search->kolom = $kolom;
            $search->filter = $test;
            $search->test = $request->test;
            $search->katakunci = $katakunci;
            if (Auth::check() != null ) return View('home.industri', ['industri' => $industri, 'user' => $this->repository->getData(), 'teks' => $teks, 'search' => $search]);
            return View('home.industri', ['industri' => $industri, 'teks' => $teks, 'search' => $search]); 
        } elseif(isset($request->kk)){
            $katakunci = $request->kk;
            $industri = DB::table('industri')
            ->where('nama', 'like', '%'.$katakunci.'%')
            ->get();
            $teks = 'Hasil pencarian :';
             $search = (object)array();
             $search->katakunci = $katakunci;
            if (Auth::check() != null ) return View('home.industri', ['industri' => $industri, 'user' => $this->repository->getData(), 'teks' => $teks, 'search' => $search]);
            return View('home.industri', ['industri' => $industri, 'teks' => $teks, 'search' => $search]); 
        }
        return redirect('/industri');
    }
}
