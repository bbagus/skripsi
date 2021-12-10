<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\{DB,Validator};
use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\Models\{User,Siswa,Pengajuan,Penempatan,Monitoring};

class SiswaBimbingan extends Controller
{
    private $repository;
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }
    public function laporanMingguan(UserRepository $repository){
        $user = $this->repository->getData();
        $penempatan = DB::table('penempatan')
            ->join('pengajuan', 'penempatan.kd_pengajuan', '=', 'pengajuan.kd_pengajuan')
            ->where('nis',$user->nis)
            ->where('status','Diterima')
            ->first();
        return View('siswa.laporanMingguan')
        ->with('penempatan', $penempatan)
        ->with('user', $user);
    }
    public function loadKegiatan(){
        $user = $this->repository->getData();
        $penempatan = DB::table('penempatan')->join('pengajuan', 'penempatan.kd_pengajuan', '=', 'pengajuan.kd_pengajuan')
            ->where('nis', $user->nis)->first();
        $kegiatan = Monitoring::where('kd_penempatan', $penempatan->kd_penempatan)
            ->select('kegiatan as title','mulai as start','selesai as end')->get();
        return response()->json($kegiatan);
    }
    public function tambahLaporanKegiatan(Request $request){
        $this->validate($request,[
            'tanggal' => 'required',
            'mulai' => 'required',
            'selesai' => 'required',
            'kegiatan' => 'required'
        ]);
        $mulai = date('Y-m-d H:i:s', strtotime("$request->tanggal $request->mulai"));
        $selesai = date('Y-m-d H:i:s', strtotime("$request->tanggal $request->selesai"));
        $laporan = Monitoring::create([
            'kd_penempatan' => $request->kd_penempatan,
            'mulai' => $mulai,
            'selesai' => $selesai,
            'kegiatan' => $request->kegiatan
        ]);
        return response()->json(array('msg'=> 'Berhasil menambah laporan kegiatan!'), 200);
    }
    public function laporanPKL(UserRepository $repository){
        $user = $this->repository->getData();
        return View('siswa.laporanPkl')
        ->with('user', $user);
    }
}

