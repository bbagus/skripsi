<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB,Validator,File}; 
use App\Models\Industri;
use App\Repositories\UserRepository;

class AdminIndustri extends Controller
{
	public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }
	public function index() {
		return view('admin.industri', ['user' => $this->repository->getData()]);
	}
	public function loadIndustri(){
		$industri = DB::table('industri')->get();
		return response()->json($industri);
	}
	public function tambahIndustri(){
		return view('admin.tambahIndustri')->with('user', $this->repository->getData());
	}
	public function editIndustri($kd_industri){
		$industri = DB::table('industri')->where('kd_industri',$kd_industri)->first();
		if($industri != null) return view('admin.editIndustri',['industri' => $industri, 'user' => $this->repository->getData()]);
		return redirect()->action([AdminIndustri::class, 'index']);
	}
	public function proses_upload(Request $request){
		$ceknama = Industri::firstWhere('nama',$request->nama);
		if ($ceknama == null) {
			$this->validate($request, [
				'nama' => 'required',
				'jurusan' => 'required',
				'bidang_kerja' => 'required',
				'alamat' => 'required',
				'wilayah' => 'required',
				'telp' => 'string|max:20|nullable',
			]);
			if ($request->file('foto') != null) {
				$this->validate($request, [
					'foto' => 'file|image|mimes:jpeg,png,jpg|max:700',
				]);
				// menyimpan data file yang diupload ke variabel $file
				$file = $request->file('foto');
				$extension = $request->foto->getClientOriginalExtension();
				$nama_file = 'Industri'.'-'.$request->nama.'.'.$extension;
				$tujuan_upload = 'data_file';
				$file->move($tujuan_upload,$nama_file);
			} 
			else $nama_file = 'default.jpg';
			Industri::create([
				'nama' => $request->nama,
				'jurusan' => $request->jurusan,
				'bidang_kerja' => $request->bidang_kerja,
				'deskripsi' => $request->deskripsi,
				'alamat' => $request->alamat,
				'wilayah' => $request->wilayah,
				'telp' => $request->telp,
				'website' => $request->website,
				'email' => $request->email,
				'kuota' => $request->kuota,
				'foto' => $nama_file,
			]);
			return response()->json(array('msg'=> 'Berhasil input data industri!'), 200);
		} return response()->json(array('msg'=> 'Nama yang sama sudah ada!'), 200);
	}
	public function proses_edit (Request $request) {
		$kd = $request->kd_industri;
		$cekkd = Industri::find($kd);
		$ceknama = Industri::firstWhere('nama', $request->nama);
		if($ceknama == null || $cekkd->nama == $request->nama){
			$industri = Industri::find($kd);
			$nama_file = $industri->foto;
			$this->validate($request, [
				'nama' => 'required',
				'jurusan' => 'required',
				'bidang_kerja' => 'required',
				'alamat' => 'required',
				'wilayah' => 'required',
				'telp' => 'string|max:20|nullable',
			]);
			if ($request->file('foto') != null) {
				$this->validate($request, [
					'foto' => 'file|image|mimes:jpeg,png,jpg|max:700',
				]);
				if($industri->foto != 'default.jpg'){
				//mau ganti foto, 
					$image_path = public_path().'/data_file/'.$industri->foto;
					File::delete($image_path);
				} 
				$file = $request->file('foto');
				$extension = $request->foto->getClientOriginalExtension();
				$nama_file = 'Industri'.'-'.$request->nama.'.'.$extension;
				$tujuan_upload = 'data_file';
				$file->move($tujuan_upload,$nama_file);
			} else if ($request->hapus == 'alert-danger'){
			//ngilangi foto 
				$nama_file = 'default.jpg';
				$image_path = public_path().'/data_file/'.$industri->foto;
				File::delete($image_path);
			}
			$industri->nama = $request->nama;
			$industri->jurusan = $request->jurusan;
			$industri->bidang_kerja = $request->bidang_kerja;
			$industri->deskripsi = $request->deskripsi;
			$industri->alamat = $request->alamat;
			$industri->wilayah = $request->wilayah;
			$industri->telp = $request->telp;
			$industri->website = $request->website;
			$industri->email = $request->email;
			$industri->kuota = $request->kuota;
			$industri->foto = $nama_file;
			$industri->save();
			$pindah = null;
			if($request->file('foto') != null) $pindah = $request->kd_industri;
			return response()->json(array('msg'=> 'Berhasil mengubah data industri!', 'pindah'=> $pindah), 200);
		} return response()->json(array('msg'=> 'Nama yang sama sudah ada!'), 200);
	}
	public function hapusIndustri($kd) {
		$industri = Industri::find($kd);
		if ($industri != null) {
			$image_path = public_path().'/data_file/'.$industri->foto;
			File::delete($image_path);
			$industri->delete();
			return response()->json(array('msg'=> 'Berhasil menghapus data industri!'), 200);   
		} return response()->json(array('msg'=> 'Data tidak ditemukan.'), 200);
	}
	public function truncate_industri(Request $request) {
		$input = $request->hapus;
		$count = 0;
		if ($input != null) {
			foreach ($input as $i) {
				$industri = Industri::find($i);
				$industri->delete();
				$count++;
			} return response()->json(array('msg'=> $count.' Data berhasil dihapus!'), 200);
		} return response()->json(array('msg'=> 'Tidak ada yang ditandai'), 200);
	}
}
