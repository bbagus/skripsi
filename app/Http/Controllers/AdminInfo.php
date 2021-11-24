<?php

namespace App\Http\Controllers;

use Illuminate\Http\{Request, Response};
use Illuminate\Support\Facades\{DB,Validator,File};
use Illuminate\Support\Str;
use App\Models\Informasi;
use App\Repositories\UserRepository; 

class AdminInfo extends Controller
{
	public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }
    public function index(){
        return view('admin.informasi',['user' => $this->repository->getData()]);
    }
    public function loadInfo(){
        $info = DB::table('informasi')
        ->leftjoin('wadah_label', 'informasi.kd_label', '=', 'wadah_label.kd_label')
        ->select('kd_info','judul', 'penulis', 'tanggal', 'status', 'nama')->get();
        return response()->json($info);
    }
    public function tambahInfo(){
        return view('admin.tambahInformasi')->with('user', $this->repository->getData());
    }
    public function editInfo($kd_info){
        $user = $this->repository->getData();
        $info = DB::table('informasi')->where('kd_info',$kd_info)->first();
        if ($info != null) return view('admin.editInformasi', ['info' => $info, 'user' => $user]);
        return redirect()->action([AdminInfo::class, 'index']);
    }
    public function proses_upload(Request $request){
        $this->validate($request, [
            'judul' => 'required',
            'isi' => 'required',
        ]);
        if ($request->file('foto') != null) {
            $this->validate($request, [
                'foto' => 'file|image|mimes:jpeg,png,jpg|max:700',
            ]);
            $file = $request->file('foto');
            $extension = $request->foto->getClientOriginalExtension();
            $nama_file = 'Info'.'-'.$request->judul.'.'.$extension;
            $tujuan_upload = 'data_file';
            $file->move($tujuan_upload,$nama_file);
        }
        else $nama_file = 'default.jpg';
        $date = date('Y-m-d H:i:s');
        $slug = Str::slug($request->judul, '-');
        $status = null;
        $msg = null;
        if($request->submit == '1') {
            $status = 'Diumumkan';
            $msg = 'Berhasil menambah pengumuman!';
        }
        else {
            $status = 'Draf';
            $msg = 'Berhasil menyimpan ke draf!';
        }
        Informasi::create([
            'judul' => $request->judul,
            'deskripsi' => $request->isi,
            'kd_label' => $request->kd_label,
            'penulis' => $request->penulis,
            'foto' => $nama_file,
            'tanggal' => $date,
            'slug' => $slug,
            'status' => $status
        ]);
        return response()->json(array('msg'=> $msg), 200);
    }
    public function proses_edit (Request $request) {
        $kd = $request->kd_info;
        $info = DB::table('informasi')->where('kd_info',$kd)->first();
        $nama_file = $info->foto;
        $this->validate($request, [
            'judul' => 'required',
            'status' => 'required',
            'isi' => 'required',
        ]);
        if ($request->file('foto') != null) {
            $this->validate($request, [
                'foto' => 'file|image|mimes:jpeg,png,jpg|max:700',
            ]);
            
            if($info->foto != 'default.jpg'){
                $image_path = public_path().'/data_file/'.$info->foto;
                File::delete($image_path);
            } 
                $file = $request->file('foto');
                $extension = $request->foto->getClientOriginalExtension();
                $nama_file = 'Info'.'-'.$request->judul.'.'.$extension;
                $tujuan_upload = 'data_file';
                $file->move($tujuan_upload,$nama_file);
        } else if ($request->hapus == 'hapus'){
            //ngilangi foto 
            $nama_file = 'default.jpg';
            $image_path = public_path().'/data_file/'.$info->foto;
            File::delete($image_path);
        }
        $date = date('Y-m-d H:i:s');
        $slug = Str::slug($request->judul, '-');
        $info = Informasi::find($kd);
        $info->judul = $request->judul;
        $info->kd_label = $request->kd_label;
        $info->deskripsi = $request->isi;
        $info->penulis = $request->penulis;
        $info->foto = $nama_file;
        $info->tanggal = $date;
        $info->slug = $slug;
        $info->status = $request->status;
        $info->save();
        $pindah = null;
        if($request->file('foto') != null) $pindah = $kd;
        return response()->json(array('msg'=> 'Berhasil mengubah pengumuman!', 'pindah'=> $pindah), 200);
    }
     public function hapusInfo($kd) {
        $info = Informasi::find($kd);
        if ($info != null) {
            $image_path = public_path().'/data_file/'.$info->foto;
            File::delete($image_path);
            $info->delete();
            return response()->json(array('msg'=> 'Berhasil menghapus pengumuman!'), 200);
        } 
        return response()->json(array('msg'=> 'Data tidak ditemukan.'), 200);
    }
    public function truncate_info(Request $request) {
        $input = $request->hapus;
        $count = 0;
        if ($input != null) {
            foreach ($input as $i) {
                $info = Informasi::find($i);
                $info->delete();
                $count++;
            } return response()->json(array('msg'=> $count.' Pengumuman berhasil dihapus!'), 200);
        }  return response()->json(array('msg'=> 'Tidak ada yang ditandai'), 200);
    }
}

