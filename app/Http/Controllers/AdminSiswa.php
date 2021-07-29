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
    	->select('siswa.nis', 'siswa.nama', 'siswa.tgl_lahir', 'kelas.nama as kelas', 'siswa.telp','siswa.alamat', 'siswa.foto')
    	->get();
		return view('admin.siswa', ['siswa' => $siswa]);
	}
	public function tambahSiswa(){
		$pesan = '';
		$isiclass = 'alert-danger';
		return view('admin.tambahSiswa', ['pesan' => $pesan, 'isiclass' => $isiclass]);
	}
	public function editSiswa($nis){
		$siswa = DB::table('siswa')
		->join('users', 'siswa.nis', '=', 'users.username')
		->where('nis',$nis)->first();
		if ($siswa != null){
			$pesan = '';
			$isiclass = 'alert-danger';
			return view('admin.editSiswa', ['pesan' => $pesan, 'isiclass' => $isiclass, 'siswa' => $siswa]);
		}
		return redirect()->action([AdminSiswa::class, 'index']);
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
			$unik = substr(uniqid('', true), -5);
			if ($request->file('foto') != null) {
				$this->validate($request, [
					'foto' => 'file|image|mimes:jpeg,png,jpg|max:700',
				]);
				// menyimpan data file yang diupload ke variabel $file
				$file = $request->file('foto');
				$extension = $request->foto->getClientOriginalExtension();
	 			$nama_file = $unik.'-'.$request->nis.'.'.$extension;
	      	        // isi dengan nama folder tempat kemana file diupload
				$tujuan_upload = 'data_file';
				$file->move($tujuan_upload,$nama_file);
			} else {
				$nama_file = 'default.jpg';
			}
			$ambil = strtotime($request->tgl_lahir);
			$psw = date('dmY',$ambil);
			$psw = Hash::make($psw);
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
			$unik = substr(uniqid('', true), -5);
		if ($request->file('foto') != null) {
			$this->validate($request, [
				'foto' => 'file|image|mimes:jpeg,png,jpg|max:700',
			]);
			
			if($siswa->foto == 'default.jpg'){
				//mau ada foto
				$file = $request->file('foto');
				$extension = $request->foto->getClientOriginalExtension();
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
		 		$extension = $request->foto->getClientOriginalExtension();
	 			$nama_file = $unik.'-'.$request->nis.'.'.$extension;
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

			$siswa = DB::table('siswa')
			->join('users', 'siswa.nis', '=', 'users.username')
			->where('nis',$request->nis)->first();
			$isiclass = 'alert-success';
			$pesan = 'Mengubah data siswa berhasil!';
			return view('admin.editSiswa', ['isiclass' => $isiclass, 'pesan' => $pesan, 'siswa' => $siswa]);
			return redirect()->back();
		}
		else {
		$siswa = DB::table('siswa')
			->join('users', 'siswa.nis', '=', 'users.username')
			->where('nis',$nis)->first();
		$pesan = 'NIS yang sama sudah ada!';
		$isiclass = 'alert-danger';
		return view('admin.editSiswa', ['pesan' => $pesan, 'isiclass' => $isiclass, 'siswa' => $siswa]);  
	}
	}
	public function hapusFoto($nis) {
		$siswa = DB::table('siswa')
			->join('users', 'siswa.nis', '=', 'users.username')
			->where('nis',$nis)->first();
		if ($siswa != null){
			$siswa->foto = 'default.jpg';
			$pesan = '';
			$isiclass = 'hapus';
			return view('admin.editSiswa', ['pesan' => $pesan, 'isiclass' => $isiclass, 'siswa' => $siswa]);
		}  
		return redirect()->back();
	}
	public function hapusSiswa($nis) {
		$siswa = Siswa::find($nis);
		if ($siswa != null) {
			$image_path = public_path().'/data_file/'.$siswa->foto;
			File::delete($image_path);
			$user = User::find($nis);
			$user->delete();
			return redirect()->back()->with('success', '1 Data berhasil dihapus.');   
		}
		return redirect()->route('kelola_siswa');
	}
	public function truncate_siswa(Request $request) {
		$input = $request->hapus;
		$count = 0;
		if ($input != null) {
		foreach ($input as $i) {
			$user = User::find($i);
			$user->delete();
			$count++;
		}
		return redirect()->back()->with('success', $count.' Data berhasil dihapus.'); 
	}
		return redirect()->back();
	}
	public function resetPassword ($nis) {
		$user = User::find($nis);
		if ($user != null) {
			$siswa = Siswa::find($nis);
			$ambil = strtotime($siswa->tgl_lahir);
			$psw = date('dmY',$ambil);
			$psw = Hash::make($psw);
			$user->password = $psw;
			$user->save();

			return redirect()->back()->with('success', 'Password berhasil direset.'); 
		}
		return redirect()->back();
	}
}
