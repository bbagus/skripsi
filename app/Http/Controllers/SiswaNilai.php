<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\{DB,Validator};
use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\Models\{Nilai,Penempatan};

class SiswaNilai extends Controller
{
	public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }
    public function index(UserRepository $repository){
        $user = $this->repository->getData();
        $penempatan = Penempatan::join('pengajuan', 'penempatan.kd_pengajuan','=','pengajuan.kd_pengajuan')
            ->where('pengajuan.nis', $user->nis)
            ->first();
        $nilai = null;
        if($penempatan!=null){
            $nilai = Nilai::where('kd_penempatan', $penempatan->kd_penempatan)->first();
        }
		return View('siswa.nilai')
            ->with('penempatan', $penempatan)
            ->with('nilai', $nilai)
            ->with('user', $user);
	}
}
