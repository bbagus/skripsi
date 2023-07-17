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
        $siswa = DB::table('penempatan')
            ->join( 'pengajuan','penempatan.kd_pengajuan','=', 'pengajuan.kd_pengajuan')
            ->join('siswa','pengajuan.nis','=','siswa.nis')
            ->join('kelas','siswa.kd_kelas','=', 'kelas.kd_kelas')
            ->select('kd_penempatan','siswa.nama','kelas.nama as kelas', 'tahun_ajaran')->get();
        $kelas = Db::table('kelas')->get();
		return view('admin.laporanMingguan')
            ->with('siswa', $siswa)
            ->with('kelas', $kelas)
            ->with('user', $this->repository->getData());
	}
    public function loadSiswa($kd_kelas){
        $siswa = DB::table('penempatan')
            ->join( 'pengajuan','penempatan.kd_pengajuan','=', 'pengajuan.kd_pengajuan')
            ->join('siswa','pengajuan.nis','=','siswa.nis')
            ->join('kelas','siswa.kd_kelas','=', 'kelas.kd_kelas')
            ->select('kd_penempatan','siswa.nama', 'siswa.kd_kelas','kelas.nama as kelas', 'tahun_ajaran')
            ->where('siswa.kd_kelas', $kd_kelas)
            ->get();
            return response()->json($siswa);
    }
    public function loadSiswa2($kd_kelas){
        $siswa = DB::table('penempatan')
            ->join( 'pengajuan','penempatan.kd_pengajuan','=', 'pengajuan.kd_pengajuan')
            ->join('siswa','pengajuan.nis','=','siswa.nis')
            ->join('kelas','siswa.kd_kelas','=', 'kelas.kd_kelas')
            ->select('kd_penempatan','siswa.nama', 'siswa.kd_kelas','kelas.nama as kelas', 'tahun_ajaran')
            ->where('siswa.kd_kelas', $kd_kelas)
            ->get();
            return response()->json($siswa);
    }
    public function loadKegiatan($kd_penempatan){
        $kegiatan = Monitoring::where('kd_penempatan', $kd_penempatan)
            ->select('kegiatan as title','mulai as start','selesai as end')->get();
        return response()->json($kegiatan);
    }
   public function laporanPKL(){
         $siswa = DB::table('penempatan')->join( 'pengajuan','penempatan.kd_pengajuan','=', 'pengajuan.kd_pengajuan')->join('siswa','pengajuan.nis','=','siswa.nis')->join('kelas','siswa.kd_kelas','=', 'kelas.kd_kelas')->select('kd_penempatan','siswa.nama','kelas.nama as kelas')->get();
          $kelas = Db::table('kelas')->get();
        return view('admin.laporanPkl')
            ->with('siswa', $siswa)
            ->with('kelas', $kelas)
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
         $kelas = DB::table('kelas')->get();
        return view('admin.nilai')
        ->with('kelas', $kelas)
        ->with('user', $this->repository->getData());
    }
    public function loadNilai(){
        $nilai = DB::table('nilai')
        ->join('penempatan','nilai.kd_penempatan','=','penempatan.kd_penempatan')
        ->join('pengajuan', 'penempatan.kd_pengajuan','=','pengajuan.kd_pengajuan')
        ->join('siswa','pengajuan.nis','=','siswa.nis')
        ->join('kelas','siswa.kd_kelas','=','kelas.kd_kelas')
        ->select('siswa.nis','siswa.nama','kelas.nama as kelas','kelas.jurusan','nilai_sikap','nilai_pengetahuan','nilai_keterampilan','tahun_ajaran')
        ->get();
        return response()->json($nilai);
    }
}