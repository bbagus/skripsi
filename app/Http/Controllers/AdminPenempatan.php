<?php

namespace App\Http\Controllers;
use App\Repositories\UserRepository;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB,Validator,File};
use App\Models\{Pengajuan,Penempatan,Industri};

class AdminPenempatan extends Controller
{
	public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }
    public function index(){
         $user = $this->repository->getData();
         $penempatan = DB::table('penempatan')
         ->join('pengajuan', 'penempatan.kd_pengajuan', '=', 'pengajuan.kd_pengajuan')
         ->leftjoin('industri', 'pengajuan.kd_industri', '=', 'industri.kd_industri')
         ->join('siswa', 'pengajuan.nis', '=', 'siswa.nis')
         ->join('kelas', 'siswa.kd_kelas', '=', 'kelas.kd_kelas')
         ->leftjoin('guru_pembimbing', 'penempatan.kd_pembimbing', '=', 'guru_pembimbing.kd_pembimbing')
         ->select('kd_penempatan', 'siswa.nis as nis','siswa.nama as nama', 'kelas.nama as kelas','guru_pembimbing.nama as guru','industri.nama as industri','industri.alamat as alamat', 'tgl_mulai', 'tgl_selesai')
         ->orderBy('industri.nama', 'desc')
         ->get();
		return view('admin.penempatan')
        ->with('user', $user)
        ->with('penempatan', $penempatan);
	}
    public function loadGuru(){
       $penempatan = DB::table('penempatan')
         ->join('pengajuan', 'penempatan.kd_pengajuan', '=', 'pengajuan.kd_pengajuan')
         ->leftjoin('industri', 'pengajuan.kd_industri', '=', 'industri.kd_industri')
         ->join('siswa', 'pengajuan.nis', '=', 'siswa.nis')
         ->join('kelas', 'siswa.kd_kelas', '=', 'kelas.kd_kelas')
         ->rightjoin('guru_pembimbing', 'penempatan.kd_pembimbing', '=', 'guru_pembimbing.kd_pembimbing')
         ->select('kd_penempatan', 'siswa.nis as nis','siswa.nama as nama', 'kelas.nama as kelas','guru_pembimbing.nama as guru','industri.nama as industri','industri.alamat as alamat', 'tgl_mulai', 'tgl_selesai')
         ->orderBy('industri.nama', 'desc')
         ->get();
         return response()->json($penempatan);
    }
}

