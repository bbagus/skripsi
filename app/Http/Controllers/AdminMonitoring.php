<?php

namespace App\Http\Controllers;
use App\Repositories\UserRepository;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB,Validator,File};
use App\Models\{Monitoring};

class AdminMonitoring extends Controller
{
	public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }
    public function index(){
        $siswa = DB::table('penempatan')->join( 'pengajuan','penempatan.kd_pengajuan','=', 'pengajuan.kd_pengajuan')->join('siswa','pengajuan.nis','=','siswa.nis')->join('kelas','siswa.kd_kelas','=', 'kelas.kd_kelas')->select('kd_penempatan','siswa.nama','kelas.nama as kelas')->get();
		return view('admin.laporanMingguan')
            ->with('siswa', $siswa)
            ->with('user', $this->repository->getData());
	}
    public function loadKegiatan($kd_penempatan){
        $kegiatan = Monitoring::where('kd_penempatan', $kd_penempatan)
            ->select('kegiatan as title','mulai as start','selesai as end')->get();
        return response()->json($kegiatan);
    }
   public function laporanPKL(){
        return view('admin.laporanPkl')->with('user', $this->repository->getData());
    }
    public function nilai(){
        return view('admin.nilai')->with('user', $this->repository->getData());
    }
}

