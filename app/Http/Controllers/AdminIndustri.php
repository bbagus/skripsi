<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;define('', '');
use Illuminate\Support\Facades\Validator;
use App\Models\Industri;
use Illuminate\Support\Facades\File; 

class AdminIndustri extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}
	public function index() {
		$industri = DB::table('industri')->get();

		return view('admin.industri', ['industri' => $industri]);
	}
	public function tambahIndustri(){
		$pesan = '';
		$isiclass = 'alert-danger';
		return view('admin.tambahIndustri', ['pesan' => $pesan, 'isiclass' => $isiclass]);
	}
	public function editIndustri($kd_industri){
		$industri = DB::table('industri')->where('kd_industri',$kd_industri)->first();
		$pesan = '';
		$isiclass = 'alert-danger';
		return view('admin.editIndustri', ['pesan' => $pesan, 'isiclass' => $isiclass, 'industri' => $industri]);
	}
	public function proses_upload(Request $request){
		$ceknama = Industri::find($request->nama);
		if ($ceknama == null) {
			$this->validate($request, [
				'nama' => 'required',
				'bidang_kerja' => 'required',
				'deskripsi' => 'required',
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
	      	        // isi dengan nama folder tempat kemana file diupload
				$tujuan_upload = 'data_file';
				$file->move($tujuan_upload,$nama_file);
			} else {
				$nama_file = 'default.jpg';
			}
			Industri::create([
				'nama' => $request->nama,
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
			$isiclass = 'alert-success';
			$pesan = 'Input data Industri berhasil!';
			return view('admin.tambahIndustri', ['isiclass' => $isiclass, 'pesan' => $pesan]);
			return redirect()->back();
		}
		else {
			$isiclass = 'alert-danger';
			$pesan = 'Nama yang sama sudah ada!';
			return view('admin.tambahIndustri', ['isiclass' => $isiclass, 'pesan' => $pesan]);
		}
	}
	public function proses_edit (Request $request) {
		$kd = $request->kd_industri;
		$industri = DB::table('industri')->where('kd_industri',$kd)->first();
		$nama_file = $industri->foto;
		$this->validate($request, [
			'nama' => 'required',
			'bidang_kerja' => 'required',
			'deskripsi' => 'required',
			'alamat' => 'required',
			'wilayah' => 'required',
			'telp' => 'string|max:20|nullable',
		]);
		if ($request->file('foto') != null) {
			$this->validate($request, [
				'foto' => 'file|image|mimes:jpeg,png,jpg|max:700',
			]);
			
			if($industri->foto == 'default.jpg'){
				//mau ada foto
				$file = $request->file('foto');
				$extension = $request->foto->getClientOriginalExtension();
				$nama_file = 'Industri'.'-'.$request->nama.'.'.$extension;
	      	        // isi dengan nama folder tempat kemana file diupload
				$tujuan_upload = 'data_file';
				$file->move($tujuan_upload,$nama_file);
			} 
			else {
				//mau ganti foto, 
				$image_path = public_path().'/data_file/'.$industri->foto;
				File::delete($image_path);
				$file = $request->file('foto');
				$extension = $request->foto->getClientOriginalExtension();
				$nama_file = 'Industri'.'-'.$request->nama.'.'.$extension;
				$tujuan_upload = 'data_file';
				$file->move($tujuan_upload,$nama_file);
			}
		} else if ($request->ganti == 'hapus'){
			//ngilangi foto 
			$nama_file = 'default.jpg';
			$image_path = public_path().'/data_file/'.$industri->foto;
			File::delete($image_path);
		}
		$industri = Industri::find($kd);
		$industri->nama = $request->nama;
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
		$isiclass = 'alert-success';
		$pesan = 'Mengubah data industri berhasil!';
		return view('admin.editIndustri', ['isiclass' => $isiclass, 'pesan' => $pesan, 'industri' => $industri]);
		return redirect()->back()->withInput();
	}
	public function hapusFoto($kd) {
		$industri = Industri::find($kd);
		$industri->foto = 'default.jpg';
		$pesan = '';
		$isiclass = 'hapus';
		return view('admin.editIndustri', ['pesan' => $pesan, 'isiclass' => $isiclass, 'industri' => $industri]);  
	}
	public function hapusIndustri($kd) {
		$industri = Industri::find($kd);
		$image_path = public_path().'/data_file/'.$industri->foto;
		File::delete($image_path);
		DB::table('industri')->where('kd_industri',$kd)->delete();
		//hurung hapus file
		return redirect()->back()->with('success', '1 Data berhasil dihapus.');   
	}
}
