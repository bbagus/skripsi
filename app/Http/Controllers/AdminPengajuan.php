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
use Response;


class AdminPengajuan extends Controller
{
	public function __construct(UserRepository $repository)
    {
        $this->middleware('auth');
        $this->repository = $repository;
    }
    public function index(){
         $user = $this->repository->getData();
          $pengajuan = DB::table('pengajuan')
          ->join('industri', 'pengajuan.kd_industri', '=', 'industri.kd_industri')
          ->join('siswa', 'pengajuan.nis', '=', 'siswa.nis')
          ->join('kelas', 'siswa.kd_kelas', '=', 'kelas.kd_kelas')
          ->select('kd_pengajuan','industri.nama as industri', 'siswa.nama as nama', 'kelas.nama as kelas' , 'industri.alamat as alamat' , 'pengajuan.nis as nis', 'tgl_pengajuan', 'tahun_ajaran','status')
          ->where('status', 'menunggu')
          ->get();
          $pengajuan2 = DB::table('pengajuan')
          ->join('industri', 'pengajuan.kd_industri', '=', 'industri.kd_industri')
          ->join('siswa', 'pengajuan.nis', '=', 'siswa.nis')
          ->join('kelas', 'siswa.kd_kelas', '=', 'kelas.kd_kelas')
          ->select('kd_pengajuan','pengajuan.nis as nis','siswa.nama as nama','kelas.nama as kelas' ,'industri.nama as industri',  'industri.alamat as alamat' , 'tgl_diproses', 'tahun_ajaran','status')
          ->where('status', 'diterima')
          ->orWhere('status', 'ditolak')
          ->get();
		return view('admin.pengajuan')
        ->with('user', $user)
        ->with('pengajuan2', $pengajuan2)
        ->with('pengajuan', $pengajuan);
	}
    public function loadDiterima(){
        $pengajuan2 = DB::table('pengajuan')
          ->join('industri', 'pengajuan.kd_industri', '=', 'industri.kd_industri')
          ->join('siswa', 'pengajuan.nis', '=', 'siswa.nis')
          ->join('kelas', 'siswa.kd_kelas', '=', 'kelas.kd_kelas')
          ->select('kd_pengajuan','pengajuan.nis as nis','siswa.nama as nama','kelas.nama as kelas' ,'industri.nama as industri',  'industri.alamat as alamat' , 'tgl_diproses', 'tahun_ajaran','status')
          ->where('status', 'diterima')
          ->orWhere('status', 'ditolak')
          ->get();
          return response()->json($pengajuan2);
    }
    public function terima(Request $request){
        $pengajuan = Pengajuan::find($request->kd);
        if(isset($pengajuan)){
            $industri = Industri::find($pengajuan->kd_industri);
            $count = Pengajuan::where('kd_industri', $pengajuan->kd_industri)->where('status', 'Diterima')->count();
            if($count < $industri->kuota){
                $pengajuan->status = 'Diterima';
                 $pengajuan->tgl_diproses = date('Y-m-d H:i:s');
                 $pengajuan->save();
                $tanggal = $this->repository->getTanggalPKL();
                Penempatan::create([
                    'kd_pengajuan' => $pengajuan->kd_pengajuan,
                    'wilayah' => $industri->wilayah,
                    'tgl_mulai' => $tanggal->mulai,
                    'tgl_selesai' => $tanggal->selesai,
                ]);
                 return redirect('admin/kelola-pengajuan')->with('success', 'Pengajuan berhasil diterima.');
            }
            return redirect()->back()->withErrors('Pengajuan gagal diterima karena kuota Instansi sudah penuh!');
        }
       return redirect()->back()->withErrors('Pengajuan gagal diterima!');
    }
    public function tolak(Request $request){
        $pengajuan = Pengajuan::find($request->kd);
        if(isset($pengajuan)){
             $pengajuan->status = 'Ditolak';
             $pengajuan->tgl_diproses = date('Y-m-d H:i:s');
             $pengajuan->save();
        return redirect('admin/kelola-pengajuan')->with('success', 'Pengajuan berhasil ditolak.');
        }
       return redirect()->back()->withErrors('Pengajuan gagal ditolak!');
    }
    public function hapusPengajuan($kd_pengajuan){
        $pengajuan = Pengajuan::find($kd_pengajuan);
        if($pengajuan != null){
           if($pengajuan->status == 'Diterima'){
            $penempatan = Penempatan::firstWhere('kd_pengajuan', $kd_pengajuan);
            $penempatan->delete();
            }
            $pengajuan->delete();
            return redirect()->back()->with('success', 'Pengajuan berhasil dihapus.');   
        }
        return redirect()->back()->withErrors('Pengajuan tidak ditemukan!');
    }
    public function truncate_pengajuan(Request $request) {
        $input = $request->hapus;
        $count = 0;
        if ($input != null) {
            foreach ($input as $i) {
                $pengajuan = Pengajuan::find($i);
                //yg diterima harus delete penempatan dulu
                if($pengajuan->status == 'Diterima'){
                    $penempatan = Penempatan::firstWhere('kd_pengajuan', $i);
                    $penempatan->delete();
                }
                $pengajuan->delete();
                $count++;
            }
            return redirect()->back()->with('success', $count.' Data berhasil dihapus.'); 
        }
        return redirect()->back()->withErrors('Tidak ada yang ditandai.');
    }

    public function detailPengajuan($kd_pengajuan){
        $user = $this->repository->getData();
        $pengajuan = Pengajuan::find($kd_pengajuan);
        $siswa = DB::table('siswa')
        ->join('kelas','siswa.kd_kelas','=','kelas.kd_kelas')
        ->select('siswa.*', 'kelas.nama as kelas', 'kelas.jurusan')
        ->where('nis', $pengajuan->nis)->first();
        $industri = DB::table('industri')->where('kd_industri', $pengajuan->kd_industri)->first();
          return view('admin.detailPengajuan')
          ->with('user', $user)
          ->with('pengajuan', $pengajuan)
          ->with('siswa', $siswa)
          ->with('industri', $industri)
          ->with('tahunajaran',$this->repository->getTahunAjaran());
    }
}

