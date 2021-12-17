<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Repositories\UserRepository;
use App\Models\{Pengajuan,Jadwal,Monitoring,Penempatan,Bimbingan};

class GuruBimbingan extends Controller
{
	public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }
    public function SiswaBimbingan(UserRepository $repository){

		return View('guru.siswaBimbingan')->with('user', $this->repository->getData());
	}
    public function loadSiswaBimbingan(){
         $guru = $this->repository->getData();
          $penempatan = DB::table('penempatan')
        ->join('pengajuan', 'penempatan.kd_pengajuan', '=', 'pengajuan.kd_pengajuan')
         ->leftjoin('industri', 'pengajuan.kd_industri', '=', 'industri.kd_industri')
         ->join('siswa', 'pengajuan.nis', '=', 'siswa.nis')
         ->join('kelas', 'siswa.kd_kelas', '=', 'kelas.kd_kelas')
         ->select('kd_penempatan','pengajuan.kd_pengajuan','siswa.nis','siswa.nama','kelas.nama as kelas','industri.nama as industri','industri.alamat','tgl_mulai', 'tgl_selesai')
         ->where('kd_pembimbing',$guru->kd_pembimbing)->get();
         return response()->json($penempatan);

    }
    public function DetailsiswaBimbingan($kd_pengajuan){
        $user = $this->repository->getData();
        $pengajuan = Pengajuan::find($kd_pengajuan);
        $siswa = DB::table('siswa')
        ->join('kelas','siswa.kd_kelas','=','kelas.kd_kelas')
        ->select('siswa.*', 'kelas.nama as kelas', 'kelas.jurusan')
        ->where('nis', $pengajuan->nis)->first();
        $industri = DB::table('industri')->where('kd_industri', $pengajuan->kd_industri)->first();
        $count = Pengajuan::where('kd_industri', $pengajuan->kd_industri)->where('status', 'Diterima')->count();
        $detail = DB::table('detail_industri')->where('kd_pengajuan', $pengajuan->kd_pengajuan)->first();
        $penempatan = DB::table('penempatan')->join('pengajuan','penempatan.kd_pengajuan', '=', 'pengajuan.kd_pengajuan')
            ->where('penempatan.kd_pengajuan', $pengajuan->kd_pengajuan)
            ->select('tgl_mulai','tgl_selesai')->first();
        $jadwal = null;
        if($detail!=null) $jadwal = Jadwal::firstWhere('kd_jadwal',$detail->kd_jadwal)->first();
         return view('guru.detailSiswa')
          ->with('jadwal', $jadwal)
          ->with('detail', $detail)
          ->with('count', $count)
          ->with('penempatan', $penempatan)
          ->with('user', $user)
          ->with('siswa', $siswa)
          ->with('industri', $industri)
          ->with('tahunajaran',$this->repository->getTahunAjaran());
    }
    public function LaporanMingguan(UserRepository $repository){
        $user = $this->repository->getData();
          $siswa = DB::table('penempatan')
        ->join('pengajuan', 'penempatan.kd_pengajuan', '=', 'pengajuan.kd_pengajuan')
         ->join('siswa', 'pengajuan.nis', '=', 'siswa.nis')
         ->select('kd_penempatan','siswa.nama')
         ->where('kd_pembimbing',$user->kd_pembimbing)->get();
        return View('guru.laporanMingguan')
            ->with('siswa',$siswa)
            ->with('user', $user);
    }
    public function loadKegiatan($kd_penempatan){
        $kegiatan = Monitoring::where('kd_penempatan', $kd_penempatan)
            ->select('kegiatan as title','mulai as start','selesai as end')->get();
        return response()->json($kegiatan);
    }
    public function LaporanPKL(UserRepository $repository){
         $user = $this->repository->getData();
         $penempatan = DB::table('penempatan')
        ->join('pengajuan', 'penempatan.kd_pengajuan', '=', 'pengajuan.kd_pengajuan')
         ->join('siswa', 'pengajuan.nis', '=', 'siswa.nis')
         ->select('kd_penempatan','siswa.nis','siswa.nama')
         ->where('kd_pembimbing',$user->kd_pembimbing)->get();
        return View('guru.laporanPkl')
            ->with('penempatan', $penempatan)
            ->with('user', $user);
    }
    public function LoadLaporanPKL($kd_penempatan){
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
    public function tambahLaporanPKL(Request $request){
        $user = $this->repository->getData();
        $this->validate($request,[
            'kd_penempatan' => 'required',
            'judul' => 'required',
            'catatan' => 'required',
        ]);
        $date = date('Y-m-d H:i:s');
        $s = strtotime($date);
        $tgl = date('d-m-Y', $s);
        $jam = date('H.i.s', $s);
        if ($request->file('file') != null) {
                $this->validate($request, [
                    'file' => 'file|max:5000',
                ]);
                // menyimpan data file yang diupload ke variabel $file
                $file = $request->file('file');
                $extension = $request->file->getClientOriginalExtension();
                $name = $request->file('file')->getClientOriginalName();
                $nama_file = $name.'_'.$tgl.'_'.$jam.'.'.$extension;
                    // isi dengan nama folder tempat kemana file diupload
                $tujuan_upload = 'data_file';
                $file->move($tujuan_upload,$nama_file);
        } else {
            $nama_file = null;
        }
        $kd = Bimbingan::create([
            'kd_penempatan' => $request->kd_penempatan,
            'pengirim' => $user->nama,
            'judul' => $request->judul,
            'tanggal' => $date,
            'catatan' => $request->catatan,
            'file' => $nama_file
        ]);
        $bimbingan = Bimbingan::find($kd->kd_bimbingan);
        $bimbingan->tgl = date('d M Y', $s);
        $bimbingan->jam = date('H:i:s', $s);
        return response()->json(array('msg'=>'Berhasil menambah bimbingan!','bimbingan' => $bimbingan), 200);
    }
}
