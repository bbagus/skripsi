<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\{DB,Validator,File};
use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\Models\{User,Siswa,Pengajuan,Penempatan,Monitoring,Bimbingan};

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
        $penempatan = DB::table('penempatan')
            ->join('pengajuan', 'penempatan.kd_pengajuan', '=', 'pengajuan.kd_pengajuan')
            ->where('nis',$user->nis)
            ->first();
        $bimbingan= null;
        $tgl = null;
        if($penempatan!= null){
             $bimbingan = Bimbingan::where('kd_penempatan', $penempatan->kd_penempatan)->orderBy('tanggal')->get(); 
        foreach($bimbingan as $b){
            $s = strtotime($b->tanggal);
            $tgl[] = date('d M Y', $s);
            $b->tgl = date('d M Y', $s);
            $b->jam = date('H:i:s', $s);
        }
        $tgl[] = date('d M Y');
        if($tgl!=null) $tgl = array_unique($tgl);
        }
        return View('siswa.laporanPkl')
        ->with('tgl', $tgl)
        ->with('penempatan', $penempatan)
        ->with('bimbingan', $bimbingan)
        ->with('user', $user);
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

