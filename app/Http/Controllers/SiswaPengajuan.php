<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB,Validator};
use App\Repositories\UserRepository;
use App\Models\{User,Siswa,Pengajuan};

class SiswaPengajuan extends Controller
{
    private $repository;
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }
    public function index(UserRepository $repository){
        $user = $this->repository->getData();
        $tahunajaran = $this->repository->getTahunAjaran();
        $pengajuan = DB::table('pengajuan')
        ->leftjoin('industri', 'pengajuan.kd_industri', '=', 'industri.kd_industri')
        ->join('siswa', 'pengajuan.nis', '=', 'siswa.nis')
        ->select('kd_pengajuan','industri.nama as industri', 'siswa.nama as nama' , 'industri.alamat as alamat' , 'pengajuan.nis as nis', 'tgl_pengajuan', 'tgl_diproses' , 'tahun_ajaran','status')
        ->where('pengajuan.nis', $user->nis)
        ->get();
        return View('siswa.pengajuan')
        ->with('user', $user)
        ->with('tahunajaran', $tahunajaran)
        ->with('pengajuan', $pengajuan);
    }
    public function search(Request $request){
        $industri = [];
        if($request->has('q')){
            $industri = DB::table('industri')->select('kd_industri','nama')->where('nama', 'LIKE', '%'. $request->q .'%')->get();
        }
        return response()->json($industri);
    }
    public function tambahPengajuan(Request $request){
       $user = $this->repository->getData();
       $cekpengajuan = Pengajuan::where('nis', $user->nis)->where('status', 'Diterima')->count();
       if($cekpengajuan < 1){
        $cekmenunggu = Pengajuan::where('nis', $user->nis)->where('status', 'Menunggu')->count();
        if($cekmenunggu < 1){
           $this->validate($request, [
            'livesearch' => 'required',
        ]);
           $date = date('Y-m-d H:i:s');
           $tahun = $this->repository->getTahunAjaran();
           Pengajuan::create([
            'nis' => $user->nis,
            'kd_industri' => $request->livesearch,
            'tgl_pengajuan' => $date,
            'tahun_ajaran' => $tahun,
            'status' => 'Menunggu',
        ]);
           return back()->with('success', 'Menambah pengajuan berhasil!');
           return back();
       } return back()->withErrors('Sudah ada pengajuan yang menunggu proses!');
   } return back()->withErrors('Pengajuan sudah ada yang diterima!');
    }
}

