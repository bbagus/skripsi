<?php

namespace App\Http\Controllers;
use App\Repositories\UserRepository;
use Illuminate\Http\{Request, Reponse};
use Illuminate\Support\Facades\{DB,Validator,File};
use App\Models\{Pengajuan,Penempatan,Industri};

class AdminPenempatan extends Controller
{
	public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }
    public function index(){  
        $kelas = DB::table('kelas')->get();
		return view('admin.penempatan')
        ->with('kelas', $kelas)
        ->with('user', $this->repository->getData());
	}
    public function loadSiswa(){
        $penempatan = DB::table('penempatan')
         ->join('pengajuan', 'penempatan.kd_pengajuan', '=', 'pengajuan.kd_pengajuan')
         ->leftjoin('industri', 'pengajuan.kd_industri', '=', 'industri.kd_industri')
         ->join('siswa', 'pengajuan.nis', '=', 'siswa.nis')
         ->join('kelas', 'siswa.kd_kelas', '=', 'kelas.kd_kelas')
         ->leftjoin('guru_pembimbing', 'penempatan.kd_pembimbing', '=', 'guru_pembimbing.kd_pembimbing')
         ->select('kd_penempatan', 'siswa.nis as nis','siswa.nama as nama', 'kelas.nama as kelas','guru_pembimbing.nama as guru','industri.nama as industri','industri.alamat as alamat', 'tgl_mulai', 'tgl_selesai', 'pengajuan.tahun_ajaran')
         ->orderBy('industri.nama', 'desc')
         ->get();
         return response()->json($penempatan);
    }
    public function loadGuru(){
       $penempatan = DB::table('penempatan')
         ->join('pengajuan', 'penempatan.kd_pengajuan', '=', 'pengajuan.kd_pengajuan')
         ->leftjoin('industri', 'pengajuan.kd_industri', '=', 'industri.kd_industri')
         ->join('siswa', 'pengajuan.nis', '=', 'siswa.nis')
         ->join('kelas', 'siswa.kd_kelas', '=', 'kelas.kd_kelas')
         ->rightjoin('guru_pembimbing', 'penempatan.kd_pembimbing', '=', 'guru_pembimbing.kd_pembimbing')
         ->select('kd_penempatan', 'siswa.nis as nis','siswa.nama as nama', 'kelas.nama as kelas','guru_pembimbing.nama as guru','industri.nama as industri','industri.alamat as alamat', 'tgl_mulai', 'tgl_selesai', 'pengajuan.tahun_ajaran')
         ->orderBy('guru_pembimbing.nama', 'asc')
         ->get();
         return response()->json($penempatan);
    }
    public function loadIndustri(){
       $penempatan = DB::table('penempatan')
        ->join('pengajuan', 'penempatan.kd_pengajuan', '=', 'pengajuan.kd_pengajuan')
        ->rightjoin('industri', 'pengajuan.kd_industri', '=', 'industri.kd_industri')
        ->leftjoin('siswa', 'pengajuan.nis', '=', 'siswa.nis')
        ->leftjoin('kelas', 'siswa.kd_kelas', '=', 'kelas.kd_kelas')
        ->leftjoin('guru_pembimbing', 'penempatan.kd_pembimbing', '=', 'guru_pembimbing.kd_pembimbing')
         ->select('kd_penempatan', 'siswa.nis as nis','siswa.nama as nama', 'kelas.nama as kelas','guru_pembimbing.nama as guru','industri.nama as industri','industri.alamat as alamat', 'tgl_mulai', 'tgl_selesai', 'pengajuan.tahun_ajaran')
         ->get();
         return response()->json($penempatan);
    }
    public function detailSiswa($kd_penempatan){
        $user = $this->repository->getData();
        $penempatan = DB::table('penempatan')
         ->join('pengajuan', 'penempatan.kd_pengajuan', '=', 'pengajuan.kd_pengajuan')
         ->leftjoin('industri', 'pengajuan.kd_industri', '=', 'industri.kd_industri')
         ->join('siswa', 'pengajuan.nis', '=', 'siswa.nis')
         ->join('kelas', 'siswa.kd_kelas', '=', 'kelas.kd_kelas')
         ->leftjoin('guru_pembimbing', 'penempatan.kd_pembimbing', '=', 'guru_pembimbing.kd_pembimbing')
         ->select('kd_penempatan','penempatan.kd_pengajuan', 'siswa.nis as nis','siswa.nama as nama', 'kelas.nama as kelas','penempatan.kd_pembimbing','guru_pembimbing.nama as guru','industri.kd_industri','industri.nama as industri','industri.alamat as alamat', 'tgl_mulai', 'tgl_selesai')
         ->where('kd_penempatan', $kd_penempatan)
         ->first(); 
         return view('admin.editpenempatan-siswa')
            ->with('penempatan', $penempatan)
            ->with('user', $user);
    }
    public function editSiswa(Request $request){
        $this->validate($request, [
                'guru' => 'nullable',
                'industri' => 'nullable',
                'tgl_mulai' => 'date',
                'tgl_selesai' => 'date',
            ]);
        $pengajuan = Pengajuan::find($request->kd_pengajuan);
        if($request->industri != null && $pengajuan->kd_industri != $request->industri){
            $industri = Industri::find($request->industri);
            $kuota = $industri->kuota;
            $count = Pengajuan::where('kd_industri', $request->industri)->where('status', 'Diterima')->count();
            if($count < $kuota){
            $pengajuan->kd_industri = $request->industri;
            $pengajuan->save();
            } else {
            return response()->json(array('msg'=> 'Kuota instansi sudah penuh!'), 200);
            }
        }
        $penempatan = Penempatan::find($request->kd_penempatan);
        $penempatan->kd_pembimbing = $request->guru;
        $penempatan->tgl_mulai = $request->tgl_mulai;
        $penempatan->tgl_selesai = $request->tgl_selesai;
        $penempatan->save();
        return response()->json(array('msg'=> 'Berhasil mengubah penempatan!'), 200); 
        
    }
    public function detailGuru($nama){
        $str = explode('-',$nama);
        //kondisi jeneng 1 kata
        if (count($str) < 2) { 
            $guru = DB::table('guru_pembimbing')->where('nama', '=', $str)->first();
        } else {
        //kondisi jeneng 2 kata
        $guru = DB::table('guru_pembimbing')->where('nama','like',$str[0].'%')->where('nama','like','%'.$str[1].'%')->first();
        }
        //string gelar
         $gelar = end($str);
         if(strlen($gelar) == 2) $gelar = $gelar[0].'.'.$gelar[1].'.';
         elseif(strlen($gelar) == 3)  {
            $gelar = $gelar[0].'.'.$gelar[1].$gelar[2].'.';
         } else  $gelar = $gelar[0].'.'.$gelar[1].$gelar[2].'.'.$gelar[3].'.';
        //kondisi jeneng 1 kata tapi + gelar
        if($guru == null) $guru = DB::table('guru_pembimbing')->where('nama',$str[0].', '.$gelar)->first();
        //kondisi jeneng podo
        $str2 = explode(' ',$guru->nama);
        if(count($str) != count($str2)){
            $coun = count($str);
            $coun -= 1;
            $namabaru = $str[0];
             for ($x = 1; $x < $coun; $x++){
                $namabaru .= ' '.$str[$x]; 
             }
             $namabaru .= ', '.$gelar;
             $guru = DB::table('guru_pembimbing')->where('nama',$namabaru)->first();
        }
        $kelas = DB::table('kelas')->get();
        return view('admin.editpenempatan-guru')
            ->with('kelas', $kelas)
            ->with('guru', $guru)
            ->with('user', $this->repository->getData());
    }
    public function loadDetailGuru($kd_pembimbing){
        $penempatan = DB::table('penempatan')
        ->join('pengajuan', 'penempatan.kd_pengajuan', '=', 'pengajuan.kd_pengajuan')
         ->leftjoin('industri', 'pengajuan.kd_industri', '=', 'industri.kd_industri')
         ->join('siswa', 'pengajuan.nis', '=', 'siswa.nis')
         ->join('kelas', 'siswa.kd_kelas', '=', 'kelas.kd_kelas')
         ->select('kd_penempatan','siswa.nis','siswa.nama','kelas.nama as kelas','industri.nama as industri','tgl_mulai', 'tgl_selesai')
         ->where('kd_pembimbing',$kd_pembimbing)->get();
         return response()->json($penempatan);
    }
    public function editGuru(Request $request){
        if(isset($request->siswa) || isset($request->siswa2)){
            $siswa = explode(',',$request->siswa);
            $siswa2 = explode(',',$request->siswa2);
            $siswa = array_merge($siswa,$siswa2);
            $kd = DB::table('penempatan')->join('pengajuan', 'penempatan.kd_pengajuan', '=', 'pengajuan.kd_pengajuan')
            ->whereIn('pengajuan.nis',$siswa)
            ->select('penempatan.kd_penempatan')->get();
            foreach($kd as $p){
                $penempatan = Penempatan::find($p->kd_penempatan);
                $penempatan->kd_pembimbing = $request->guru;
                $penempatan->save();
            }
            return response()->json(array('msg'=> 'Berhasil menambahkan siswa!'), 200);
        }   return response()->json(array('msg'=> 'Tidak ada siswa yang ditambahkan.'), 200);
    }
    public function hapusSiswaGuru($kd_penempatan){
        $penempatan = Penempatan::find($kd_penempatan);
        $penempatan->kd_pembimbing = null;
        $penempatan->Save();
        return response()->json(array('msg'=> 'Berhasil menghapus siswa bimbingan!'), 200);
    }
    public function truncateGuru(Request $request){
        $input = $request->hapus;
        $count = 0;
        if ($input != null){
        foreach ($input as $i) {
                $penempatan = Penempatan::find($i);
                $penempatan->kd_pembimbing = null;
                $penempatan->Save();
                $count++;
            }
            return response()->json(array('msg'=> $count.' Siswa berhasil dihapus dari bimbingan!'), 200);
        } return response()->json(array('msg'=> 'Tidak ada yang ditandai'), 200);
    }
    public function detailIndustri($nama){
        $str = explode('-',$nama);
         if (count($str) < 2) { 
            $industri = DB::table('industri')->where('nama', $str)->first();
        } else {
        $industri = DB::table('industri')->where('nama','like', $str[0].'%')->where('nama','like', '%'.$str[1].'%')->first();
        }
        $str2 = explode(' ',$industri->nama);
        if(count($str) != count($str2)){
            $industri = DB::table('industri')->where('nama','like', $str[0].'%')->where('nama','like', '%'.$str[1].'%')->where('nama','like', '%'.$str[2].'%')->first();
        }
        $kelas = DB::table('kelas')->get();
        return view('admin.editpenempatan-industri')->with('industri', $industri)
            ->with('kelas', $kelas)
            ->with('user', $this->repository->getData());
    }
    public function LoadDetailIndustri($kd_industri){
        $penempatan = DB::table('penempatan')
        ->join('pengajuan', 'penempatan.kd_pengajuan', '=', 'pengajuan.kd_pengajuan')
         ->leftjoin('guru_pembimbing', 'penempatan.kd_pembimbing', '=', 'guru_pembimbing.kd_pembimbing')
         ->join('siswa', 'pengajuan.nis', '=', 'siswa.nis')
         ->join('kelas', 'siswa.kd_kelas', '=', 'kelas.kd_kelas')
         ->select('kd_penempatan','siswa.nis','siswa.nama','kelas.nama as kelas','guru_pembimbing.nama as guru','tgl_mulai', 'tgl_selesai','pengajuan.kd_pengajuan')
         ->where('pengajuan.kd_industri',$kd_industri)->get();
         return response()->json($penempatan);
    }
    public function editIndustri(Request $request){
        if(isset($request->siswa) || isset($request->siswa2)){
            $siswa = explode(',',$request->siswa);
            $siswa2 = explode(',',$request->siswa2);
            $siswa = array_merge($siswa,$siswa2);
            $kd = DB::table('pengajuan')
            ->whereIn('nis',$siswa)
            ->select('kd_pengajuan')->get();
            foreach($kd as $p){
                $pengajuan = Pengajuan::find($p->kd_pengajuan);
                $pengajuan->kd_industri = $request->industri;
                $pengajuan->save();
            }
            return response()->json(array('msg'=> 'Berhasil menambahkan siswa!'), 200);
        }   return response()->json(array('msg'=> 'Tidak ada siswa yang ditambahkan.'), 200);
    }
    public function truncateIndustri(Request $request){
        $input = $request->hapus;
        $count = 0;
        if ($input != null){
        foreach ($input as $i) {
                $pengajuan = Pengajuan::find($i);
                $pengajuan->kd_industri = null;
                $pengajuan->Save();
                $count++;
            }
            return response()->json(array('msg'=> $count.' Siswa berhasil dihapus dari daftar!'), 200);
        } return response()->json(array('msg'=> 'Tidak ada yang ditandai'), 200);
    }
    public function hapusSiswaIndustri($kd_pengajuan){
        $pengajuan = Pengajuan::find($kd_pengajuan);
        $pengajuan->kd_industri = null;
        $pengajuan->save();
        return response()->json(array('msg'=> 'Berhasil menghapus siswa dari daftar!'), 200);
    }
    public function searchIndustri(Request $request){
        $industri = [];
            $industri = DB::table('industri')->select('kd_industri','nama')->where('nama', 'LIKE', '%'. $request->q .'%')->get();
          return response()->json($industri);
    }
    public function searchGuru(Request $request){
        $guru = [];
            $guru = DB::table('guru_pembimbing')->select('kd_pembimbing','nama')->where('nama', 'LIKE', '%'. $request->q .'%')->get();
         return response()->json($guru);
    }
    public function searchSiswa(Request $request){
        $siswa = [];
            if($request->has('q') and ($request->q) != null){
              $siswa = DB::table('siswa')
              ->join('pengajuan','siswa.nis','=', 'pengajuan.nis')
              ->join('kelas','siswa.kd_kelas', '=', 'kelas.kd_kelas')
              ->join('penempatan','pengajuan.kd_pengajuan', '=', 'penempatan.kd_pengajuan')
              ->select('siswa.nis','siswa.nama','kelas.nama as kelas')
              ->where('penempatan.kd_pembimbing', null)
              ->Where('siswa.nama', 'LIKE', '%'. $request->q .'%')
              ->orWhere('siswa.nis', 'LIKE', '%'. $request->q .'%')->get();
          }
       return response()->json($siswa);
    }
    public function searchSiswa2(Request $request){
        $siswa = [];
              $siswa = DB::table('siswa')
              ->join('pengajuan','siswa.nis','=', 'pengajuan.nis')
              ->join('kelas','siswa.kd_kelas', '=', 'kelas.kd_kelas')
              ->join('penempatan','pengajuan.kd_pengajuan', '=', 'penempatan.kd_pengajuan')
              ->select('siswa.nis','siswa.nama','kelas.nama as kelas')
              ->where('penempatan.kd_pembimbing', null)
              ->where('siswa.nama', 'LIKE', '%'. $request->q1 .'%')
              ->where('kelas.kd_kelas', '=', $request->q2)->get();
       return response()->json($siswa);
    }
    public function searchSiswa3(Request $request){
        $siswa = [];
        if($request->has('q') and ($request->q) != null){
              $siswa = DB::table('siswa')
              ->join('pengajuan','siswa.nis','=', 'pengajuan.nis')
              ->join('kelas','siswa.kd_kelas', '=', 'kelas.kd_kelas')
              ->join('penempatan','pengajuan.kd_pengajuan', '=', 'penempatan.kd_pengajuan')
              ->select('siswa.nis','siswa.nama','kelas.nama as kelas')
              ->where('pengajuan.kd_industri', null)
              ->where('siswa.nama', 'LIKE', '%'. $request->q .'%')
              ->orWhere('siswa.nis', 'LIKE', '%'. $request->q .'%')->get();
          }
       return response()->json($siswa);
    }
    public function searchSiswa4(Request $request){
        $siswa = [];
              $siswa = DB::table('siswa')
              ->join('pengajuan','siswa.nis','=', 'pengajuan.nis')
              ->join('kelas','siswa.kd_kelas', '=', 'kelas.kd_kelas')
              ->join('penempatan','pengajuan.kd_pengajuan', '=', 'penempatan.kd_pengajuan')
              ->select('siswa.nis','siswa.nama','kelas.nama as kelas')
              ->where('pengajuan.kd_industri', null)
              ->where('siswa.nama', 'LIKE', '%'. $request->q1 .'%')
              ->where('kelas.kd_kelas', '=', $request->q2)->get();
          
       return response()->json($siswa);
    }
}

