<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\{DB,Validator};
use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\Models\{User,Industri,DetailIndustri,Jadwal};

class SiswaIndustri extends Controller
{
	public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }
    public function index(UserRepository $repository){
        $user = $this->repository->getData();
        $industri = DB::table('pengajuan')->join('industri','pengajuan.kd_industri','=','industri.kd_industri')->where('nis', $user->nis)
            ->where('pengajuan.status', 'Diterima')
            ->select('kd_pengajuan','industri.kd_industri','industri.nama','industri.alamat','status')->first();
        $detail = null;
        $penempatan =null;
        $jadwal = null;
        if(isset($industri)) {
            $detail = DetailIndustri::firstWhere('kd_pengajuan', $industri->kd_pengajuan);
            $penempatan = DB::table('penempatan')->join('pengajuan', 'penempatan.kd_pengajuan', '=', 'pengajuan.kd_pengajuan')
            ->join('guru_pembimbing', 'penempatan.kd_pembimbing', '=', 'guru_pembimbing.kd_pembimbing')
            ->where('penempatan.kd_pengajuan', $industri->kd_pengajuan)
            ->select('guru_pembimbing.nama','nip','telp','foto')->first();
        }
        if(isset($detail)) $jadwal =  Jadwal::firstWhere('kd_detail',$detail->kd_detail);
		return View('siswa.detailIndustri')->with('user', $user)
            ->with('penempatan', $penempatan)
            ->with('jadwal', $jadwal)
            ->with('industri', $industri)
            ->with('detail', $detail);
	}
    public function editDetail(Request $request){
        $this->validate($request, [
            'pimpinan' => 'string|max:50|nullable',
            'pembina' => 'string|max:50|nullable',
        ]);
        $detail = DetailIndustri::updateOrCreate(
            ['kd_detail' => $request->kd_detail],
            [   'kd_pengajuan' => $request->kd_pengajuan,
                'bagian' => $request->bagian,
                'pimpinan' => $request->pimpinan,
                'pembimbing' => $request->pembimbing
            ]);
        $detailid = $detail->kd_detail;
        return response()->json(array('msg'=> 'Berhasil menyimpan detail instansi!','kd_detail'=> $detailid), 200);        
        }
    public function editJadwal(Request $request){
        $this->validate($request, [
            'senin' => 'array|nullable',
            'selasa' => 'array|nullable',
            'rabu' => 'array|nullable',
            'kamis' => 'array|nullable',
            'jumat' => 'array|nullable',
            'sabtu' => 'array|nullable',
            'minggu' => 'array|nullable',
            'kd_detail' => 'required',
        ]);
        $jadwal = Jadwal::updateOrCreate(
            ['kd_jadwal' => $request->kd_jadwal],
            [   'senin' => $request->senin,
                'selasa' => $request->selasa,
                'rabu' => $request->rabu,
                'kamis' => $request->kamis,
                'jumat' => $request->jumat,
                'sabtu' => $request->sabtu,
                'minggu' => $request->minggu,
                'kd_detail' => $request->kd_detail]
        );
        $jadwalkd = $jadwal->kd_jadwal;
        return response()->json(array('msg'=> 'Berhasil menyimpan jadwal PKL!','kd_jadwal'=>$jadwalkd), 200);
    }
}
