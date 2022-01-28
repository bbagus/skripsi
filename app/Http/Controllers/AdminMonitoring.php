<?php

namespace App\Http\Controllers;
use App\Repositories\UserRepository;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB,Validator,File};
use App\Models\{Monitoring,Bimbingan,Nilai};

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
         $siswa = DB::table('penempatan')->join( 'pengajuan','penempatan.kd_pengajuan','=', 'pengajuan.kd_pengajuan')->join('siswa','pengajuan.nis','=','siswa.nis')->join('kelas','siswa.kd_kelas','=', 'kelas.kd_kelas')->select('kd_penempatan','siswa.nama','kelas.nama as kelas')->get();
        return view('admin.laporanPkl')
            ->with('siswa', $siswa)
            ->with('user', $this->repository->getData());
    }
    public function loadLaporanPkl($kd_penempatan){
        $bimbingan = Bimbingan::where('kd_penempatan', $kd_penempatan)->orderBy('tanggal')->get();
        $tgl = null; 
        foreach($bimbingan as $b){
            $s = strtotime($b->tanggal);
            $tgl[] = date('d M Y', $s);
            $b->tgl = date('d M Y', $s);
            $b->jam = date('H:i:s', $s);
        }
        $tgl[] = date('d M Y');
        $tgl = array_unique($tgl);
         return response()->json(['tgl'=>$tgl,'bimbingan'=>$bimbingan]);
    }
    public function nilai(){
         $siswa = DB::table('penempatan')->join( 'pengajuan','penempatan.kd_pengajuan','=', 'pengajuan.kd_pengajuan')->join('siswa','pengajuan.nis','=','siswa.nis')->join('kelas','siswa.kd_kelas','=', 'kelas.kd_kelas')->select('kd_penempatan','siswa.nama','kelas.nama as kelas')->get();
        return view('admin.nilai')
        ->with('siswa', $siswa)
        ->with('user', $this->repository->getData());
    }
    public function loadNilai($kd_penempatan){
        $nilai = Nilai::where('kd_penempatan', $kd_penempatan)->first();
        return response()->json($nilai);
    }
}