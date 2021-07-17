<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;define('', '');
use Illuminate\Support\Facades\Validator;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Support\Facades\File; 
use Illuminate\Support\Facades\Hash;

class AdminSiswa extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
    	$siswa = DB::table('siswa')
    	->join('kelas','siswa.kd_kelas', '=', 'kelas.kd_kelas')
    	->select('siswa.nis', 'siswa.nama', 'siswa.tgl_lahir', 'siswa.telp','siswa.alamat','kelas.nama as kelas', 'siswa.foto')
    	->get();
		return view('admin.siswa', ['siswa' => $siswa]);
	}
	public function tambahSiswa(){
		$pesan = '';
		$isiclass = 'alert-danger';
		return view('admin.tambahSiswa', ['pesan' => $pesan, 'isiclass' => $isiclass]);
	}
	public function editSiswa($nis){
		$siswa = DB::table('siswa')->where('nis',$nis)->first();
		$pesan = '';
		$isiclass = 'alert-danger';
		return view('admin.editSiswa', ['pesan' => $pesan, 'isiclass' => $isiclass, 'siswa' => $siswa]);

	}
	public function proses_upload(Request $request){
		$ceknis = Siswa::find($request->nis);
		if ($ceknis == null) {
			$this->validate($request, [
					'nis' => 'required',
					'nama' => 'required',
					'tgl_lahir' => 'required',
					'kd_kelas' => 'required',
					'telp' => 'string|max:20|nullable',
				]);
			if ($request->file('foto') != null) {
				$this->validate($request, [
					'foto' => 'file|image|mimes:jpeg,png,jpg|max:700',
				]);
				// menyimpan data file yang diupload ke variabel $file
				$file = $request->file('foto');
				$extension = $request->foto->getClientOriginalExtension();
				$unik = uniqid();
	 			$nama_file = $unik.'-'.$request->nis.'.'.$extension;
	      	        // isi dengan nama folder tempat kemana file diupload
				$tujuan_upload = 'data_file';
				$file->move($tujuan_upload,$nama_file);
			} else {
				$nama_file = 'default.jpg';
			}
			$psw = Hash::make($request->tgl_lahir);
			User::create([
				'username' => $request->nis,
				'password' => $psw,
				'role' => 'siswa',
			]);
			Siswa::create([
				'nis' => $request->nis,
				'nama' => $request->nama,
				'tgl_lahir' => $request->tgl_lahir,
				'telp' => $request->telp,
				'alamat' => $request->alamat,
				'kd_kelas' => $request->kd_kelas,
				'foto' => $nama_file,
			]);
			$isiclass = 'alert-success';
			$pesan = 'Input data siswa berhasil!';
			return view('admin.tambahSiswa', ['isiclass' => $isiclass, 'pesan' => $pesan]);
			return redirect()->back();
		}
		else {
			$isiclass = 'alert-danger';
			$pesan = 'NIS yang sama sudah ada!';
			return view('admin.tambahSiswa', ['isiclass' => $isiclass, 'pesan' => $pesan]);
		}
	}
	public function proses_edit (Request $request) {
		$ceknis = Siswa::find($request->nis);
		$nis = $request->nislama;
		if ($ceknis == null || $nis == $request->nis) {
			$this->validate($request, [
				'nis' => 'required',
				'nama' => 'required',
				'tgl_lahir' => 'required',
				'kd_kelas' => 'required',
				'telp' => 'string|max:20|nullable',
			]);
			$siswa = DB::table('siswa')->where('nis',$nis)->first();
			$nama_file = $siswa->foto;
		if ($request->file('foto') != null) {
			$this->validate($request, [
				'foto' => 'file|image|mimes:jpeg,png,jpg|max:700',
			]);
			
			if($siswa->foto == 'default.jpg'){
				//mau ada foto
				$file = $request->file('foto');
				$extension = $request->foto->getClientOriginalExtension();
				$unik = uniqid();
	 			$nama_file = $unik.'-'.$request->nis.'.'.$extension;
	      	        // isi dengan nama folder tempat kemana file diupload
				$tujuan_upload = 'data_file';
				$file->move($tujuan_upload,$nama_file);
			} 
			else {
				//mau ganti foto, 
				$image_path = public_path().'/data_file/'.$siswa->foto;
				File::delete($image_path);
				$file = $request->file('foto');
		 		$nama_file = $siswa->foto;
		      	        // isi dengan nama folder tempat kemana file diupload
				$tujuan_upload = 'data_file';
				$file->move($tujuan_upload,$nama_file);
			}
		} else if ($request->ganti == 'hapus'){
			//ngilangi foto 
			$nama_file = 'default.jpg';
			$image_path = public_path().'/data_file/'.$siswa->foto;
			File::delete($image_path);
		}
			$user = User::find($nis);
			$user->username = $request->nis;
			$user->save();
			$siswa = Siswa::find($request->nis);
			$siswa->nama = $request->nama;
			$siswa->tgl_lahir = $request->tgl_lahir;
			$siswa->telp = $request->telp;
			$siswa->alamat = $request->alamat;
			$siswa->kd_kelas = $request->kd_kelas;
			$siswa->foto = $nama_file;
			$siswa->save();

			$isiclass = 'alert-success';
			$pesan = 'Mengubah data siswa berhasil!';
			return view('admin.editSiswa', ['isiclass' => $isiclass, 'pesan' => $pesan, 'siswa' => $siswa]);
			return redirect()->back()->withInput();
		}
		else {
		$siswa = DB::table('siswa')->where('nis',$nis)->first();
		$pesan = 'NIS yang sama sudah ada!';
		$isiclass = 'alert-danger';
		return view('admin.editSiswa', ['pesan' => $pesan, 'isiclass' => $isiclass, 'siswa' => $siswa]);  
	}
	}
	public function hapusFoto($nis) {
		$siswa = Siswa::find($nis);
		$siswa->foto = 'default.jpg';
		$pesan = '';
		$isiclass = 'hapus';
		return view('admin.editSiswa', ['pesan' => $pesan, 'isiclass' => $isiclass, 'siswa' => $siswa]);  
	}
	public function hapusSiswa($nis) {
		$siswa = Siswa::find($nis);
		$image_path = public_path().'/data_file/'.$siswa->foto;
		File::delete($image_path);
		DB::table('siswa')->where('nis',$nis)->delete();
		$user = User::find($nis);
		$user->delete();
		//hurung hapus file
		return redirect()->back()->with('success', '1 Data berhasil dihapus.');   
	}
}
