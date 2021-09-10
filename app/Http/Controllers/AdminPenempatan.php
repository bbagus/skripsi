<?php

namespace App\Http\Controllers;
use App\Repositories\UserRepository;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;define('', '');
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File; 
use App\Models\Pengajuan;
use App\Models\Penempatan;
use App\Models\Industri;


class AdminPenempatan extends Controller
{
	public function __construct(UserRepository $repository)
    {
        $this->middleware('auth');
        $this->repository = $repository;
    }
    public function index(){
         $user = $this->repository->getData();
         $penempatan = DB::table('penempatan')
         ->join('pengajuan', 'penempatan.kd_pengajuan', '=', 'pengajuan.kd_pengajuan')
         ->join('industri', 'pengajuan.kd_industri', '=', 'industri.kd_industri')
         ->join('siswa', 'pengajuan.nis', '=', 'siswa.nis')
         ->leftjoin('guru_pembimbing', 'penempatan.kd_pembimbing', '=', 'guru_pembimbing.kd_pembimbing')
         ->select('kd_penempatan', 'siswa.nis as nis','siswa.nama as nama','guru_pembimbing.nama as guru','industri.nama as industri', 'tgl_mulai', 'tgl_selesai')
         ->get();
		return view('admin.penempatan')
        ->with('user', $user)
        ->with('penempatan', $penempatan);
	}
    

}

