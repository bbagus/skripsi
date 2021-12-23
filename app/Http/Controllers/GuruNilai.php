<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Repositories\UserRepository;
use App\Models\{Nilai};

class GuruNilai extends Controller
{
	public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }
    public function index(UserRepository $repository){
        $user = $this->repository->getData();
         $siswa = DB::table('penempatan')
        ->join('pengajuan', 'penempatan.kd_pengajuan', '=', 'pengajuan.kd_pengajuan')
         ->join('siswa', 'pengajuan.nis', '=', 'siswa.nis')
         ->select('kd_penempatan','siswa.nama')
         ->where('kd_pembimbing',$user->kd_pembimbing)->get();
		return View('guru.nilai')
        ->with('siswa',$siswa)
        ->with('user', $user );
	}
    public function loadNilai($kd_penempatan){
        $nilai = Nilai::where('kd_penempatan', $kd_penempatan)->first();
        return response()->json($nilai);
    }
    public function tambahNilai(Request $request){
        $this->validate($request, [
            'kd_penempatan' => 'required',
            'nilai_sikap' => 'nullable',
            'nilai_pengetahuan' => 'nullable',
            'nilai_keterampilan' => 'nullable'
        ]);
        $nilai = Nilai::updateOrCreate(
            ['kd_penempatan' => $request->kd_penempatan],
            ['nilai_sikap' => $request->nilai_sikap,
            'nilai_keterampilan' => $request->nilai_keterampilan,
            'nilai_pengetahuan' => $request->nilai_pengetahuan,
            'kd_penempatan' => $request->kd_penempatan]
        );
        $kd_nilai = $nilai->kd_nilai;
         return response()->json(array('msg'=>'Berhasil input nilai!','kd_nilai' => $kd_nilai), 200);
    }
}
