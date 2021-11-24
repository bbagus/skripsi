<?php

namespace App\Http\Controllers;
use App\Repositories\UserRepository;
use Illuminate\Http\{Request, Response};
use Illuminate\Support\Facades\DB;
use App\Models\{Pengajuan,Penempatan,Industri,Siswa};

class AdminPengajuan extends Controller
{
	public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }
    public function index(){
         $user = $this->repository->getData(); 
		return view('admin.pengajuan')->with('user', $user);
	}
    public function loadMenunggu(){
        $pengajuan = DB::table('pengajuan')
          ->join('industri', 'pengajuan.kd_industri', '=', 'industri.kd_industri')
          ->join('siswa', 'pengajuan.nis', '=', 'siswa.nis')
          ->join('kelas', 'siswa.kd_kelas', '=', 'kelas.kd_kelas')
          ->select('kd_pengajuan','industri.nama as industri', 'siswa.nama as nama', 'kelas.nama as kelas' , 'industri.alamat as alamat' , 'pengajuan.nis as nis', 'tgl_pengajuan', 'tahun_ajaran','status')
          ->where('status', 'menunggu')
          ->get();
          return response()->json($pengajuan);
    }
    public function loadDiterima(){
        $pengajuan2 = DB::table('pengajuan')
          ->leftjoin('industri', 'pengajuan.kd_industri', '=', 'industri.kd_industri')
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
        if($request->submit == 1){
            $industri = Industri::find($pengajuan->kd_industri);
            $count = Pengajuan::where('kd_industri', $pengajuan->kd_industri)->where('status', 'Diterima')->count();
            if($count < $industri->kuota){
                $pengajuan->status = 'Diterima';
                $pengajuan->tgl_diproses = date('Y-m-d H:i:s');
                $pengajuan->save();
                $tanggal = $this->repository->getTanggalPKL();
                Penempatan::create([
                    'kd_pengajuan' => $pengajuan->kd_pengajuan,
                    'tgl_mulai' => $tanggal->mulai,
                    'tgl_selesai' => $tanggal->selesai,
                ]);
                 return response()->json(array('msg'=> 'Pengajuan berhasil diterima!'), 200);
            } return response()->json(array('msg'=> 'Pengajuan gagal diterima karena kuota instansi sudah penuh!'), 200);
        } else {
             $pengajuan->status = 'Ditolak';
             $pengajuan->tgl_diproses = date('Y-m-d H:i:s');
             $pengajuan->save();
             return response()->json(array('msg'=> 'Pengajuan berhasil ditolak!'), 200);
             }
        } return response()->json(array('msg'=> 'Pengajuan tidak ditemukan!'), 200);
    }
    public function hapusPengajuan($kd_pengajuan){
        $pengajuan = Pengajuan::find($kd_pengajuan);
        if($pengajuan != null){
            $pengajuan->delete();
            return response()->json(array('msg'=> 'Berhasil menghapus pengajuan!'), 200); 
        } return response()->json(array('msg'=> 'Pengajuan tidak ditemukan!'), 200);
    }
    public function truncate_pengajuan(Request $request) {
        $input = $request->hapus;
        $count = 0;
        if ($input != null) {
            foreach ($input as $i) {
                $pengajuan = Pengajuan::find($i);
                //yg diterima harus delete penempatan dulu
                $pengajuan->delete();
                $count++;
            } return response()->json(array('msg'=> $count.' Pengajuan berhasil dihapus!'), 200);
        } return response()->json(array('msg'=> 'Tidak ada yang ditandai'), 200);
    }
    public function detailPengajuan($kd_pengajuan){
        $user = $this->repository->getData();
        $pengajuan = Pengajuan::find($kd_pengajuan);
        $siswa = DB::table('siswa')
        ->join('kelas','siswa.kd_kelas','=','kelas.kd_kelas')
        ->select('siswa.*', 'kelas.nama as kelas', 'kelas.jurusan')
        ->where('nis', $pengajuan->nis)->first();
        $industri = DB::table('industri')->where('kd_industri', $pengajuan->kd_industri)->first();
        $count = Pengajuan::where('kd_industri', $pengajuan->kd_industri)->where('status', 'Diterima')->count();
          return view('admin.detailPengajuan')
          ->with('count', $count)
          ->with('user', $user)
          ->with('pengajuan', $pengajuan)
          ->with('siswa', $siswa)
          ->with('industri', $industri)
          ->with('tahunajaran',$this->repository->getTahunAjaran());
    }
    public function generatePengajuan(){
        $nis = Siswa::leftjoin('pengajuan', 'siswa.nis','=','pengajuan.nis')
        ->select('siswa.nis')
        ->Where('status', null)
        ->get();
        $nis2 = Pengajuan::where('status','Ditolak')
        ->select('nis')
        ->get();
         $date = date('Y-m-d H:i:s');
         $tahun = $this->repository->getTahunAjaran();
         $tanggal = $this->repository->getTanggalPKL();
         $count = 0;
        foreach($nis as $n){
           $pengajuan = Pengajuan::create([
                'nis' => $n->nis,
                'tgl_pengajuan' => $date,
                'tgl_diproses' => $date,
                'tahun_ajaran' => $tahun,
                'status' => 'Diterima',
            ]);
            Penempatan::create([
                'kd_pengajuan' => $pengajuan->kd_pengajuan,
                'tgl_mulai' => $tanggal->mulai,
                'tgl_selesai' => $tanggal->selesai,
            ]);
            $count++;
        };
        foreach($nis2 as $n2){
            $cek = Pengajuan::Where('nis', $n2->nis)->where('status','!=','Ditolak');
            if(!isset($cek)){
            $pengajuan2 =  Pengajuan::create([
                'nis' => $n2->nis,
                'tgl_pengajuan' => $date,
                'tgl_diproses' => $date,
                'tahun_ajaran' => $tahun,
                'status' => 'Diterima',
            ]);
            Penempatan::create([
                'kd_pengajuan' => $pengajuan2->kd_pengajuan,
                'tgl_mulai' => $tanggal->mulai,
                'tgl_selesai' => $tanggal->selesai,
            ]);
            $count++;
            }
        }  return response()->json(array('msg'=> $count.' Pengajuan berhasil ditambahkan!'), 200);
    }
}

