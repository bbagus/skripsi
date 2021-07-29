<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;define('', '');
use Illuminate\Support\Facades\Validator;
use App\Models\Guru;
use App\Models\User;
use Illuminate\Support\Facades\File; 
use Illuminate\Support\Facades\Hash;

class AdminGuru extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}
	public function index(){
		$guru = DB::table('guru_pembimbing')->get();

		return view('admin.guru', ['guru' => $guru]);
	}
	public function tambahGuru(){
		$pesan = '';
		$isiclass = 'alert-danger';
		return view('admin.tambahGuru', ['pesan' => $pesan, 'isiclass' => $isiclass]);
	}
	public function editGuru($kd_pembimbing){
		$guru = DB::table('guru_pembimbing')
		->join('users', 'guru_pembimbing.username', '=', 'users.username')
		->where('kd_pembimbing',$kd_pembimbing)->first();
		$pesan = '';
		$isiclass = 'alert-danger';
		return view('admin.editGuru', ['pesan' => $pesan, 'isiclass' => $isiclass, 'guru' => $guru]);
	}
	public function proses_upload(Request $request){
		$cekkd = Guru::find($request->nama);
		if ($cekkd == null) {
			$this->validate($request, [
				'nama' => 'required',
				'jurusan' => 'required',
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
				$nama_file = $unik.'-'.$request->nama.'.'.$extension;
	      	        // isi dengan nama folder tempat kemana file diupload
				$tujuan_upload = 'data_file';
				$file->move($tujuan_upload,$nama_file);
			} else {
				$nama_file = 'default.jpg';
			}
			$rand = $unik;
			$psw = Hash::make('gurukeren');
			User::create([
				'username' => $rand,
				'password' => $psw,
				'role' => 'guru',
			]);
			Guru::create([
				'nama' => $request->nama,
				'username' => $rand,
				'nip' => $request->nip,
				'telp' => $request->telp,
				'jurusan' => $request->jurusan,
				'wilayah' => $request->wilayah,
				'foto' => $nama_file,
			]);
			$isiclass = 'alert-success';
			$pesan = 'Input data guru pembimbing berhasil!';
			return view('admin.tambahGuru', ['isiclass' => $isiclass, 'pesan' => $pesan]);
			return redirect()->back();
		}
		else {
			$isiclass = 'alert-danger';
			$pesan = 'Nama yang sama sudah ada!';
			return view('admin.tambahGuru', ['isiclass' => $isiclass, 'pesan' => $pesan]);
		}
	}
	public function proses_edit (Request $request) {
		$kd = $request->kd_pembimbing;
		$guru = DB::table('guru_pembimbing')->where('kd_pembimbing',$kd)->first();
		$nama_file = $guru->foto;
		$this->validate($request, [
			'nama' => 'required',
			'jurusan' => 'required',
			'telp' => 'string|max:20|nullable',
		]);
		$unik = $guru->username;
		if ($request->file('foto') != null) {
			$this->validate($request, [
				'foto' => 'file|image|mimes:jpeg,png,jpg|max:700',
			]);
			
			if($guru->foto == 'default.jpg'){
				//mau ada foto
				$file = $request->file('foto');
				$extension = $request->foto->getClientOriginalExtension();
				$nama_file = $unik.'-'.$request->nama.'.'.$extension;
	      	        // isi dengan nama folder tempat kemana file diupload
				$tujuan_upload = 'data_file';
				$file->move($tujuan_upload,$nama_file);
			} 
			else {
				//mau ganti foto, 
				$image_path = public_path().'/data_file/'.$guru->foto;
				File::delete($image_path);
				$file = $request->file('foto');
				$extension = $request->foto->getClientOriginalExtension();
				$nama_file = $unik.'-'.$request->nama.'.'.$extension;
		      	        // isi dengan nama folder tempat kemana file diupload
				$tujuan_upload = 'data_file';
				$file->move($tujuan_upload,$nama_file);
			}
		} else if ($request->ganti == 'hapus'){
			//ngilangi foto 
			$nama_file = 'default.jpg';
			$image_path = public_path().'/data_file/'.$guru->foto;
			File::delete($image_path);
		}
		$guru = Guru::find($kd);
		$guru->nama = $request->nama;
		$guru->nip = $request->nip;
		$guru->telp = $request->telp;
		$guru->jurusan = $request->jurusan;
		$guru->wilayah = $request->wilayah;
		$guru->foto = $nama_file;
		$guru->save();
		$isiclass = 'alert-success';
		$pesan = 'Mengubah data guru berhasil!';
		$guru = DB::table('guru_pembimbing')
		->join('users', 'guru_pembimbing.username', '=', 'users.username')
		->where('kd_pembimbing',$kd)->first();
		return view('admin.editGuru', ['isiclass' => $isiclass, 'pesan' => $pesan, 'guru' => $guru]);
		return redirect()->back()->withInput();
	}
	public function hapusFoto($kd) {
		$guru = DB::table('guru_pembimbing')
		->join('users', 'guru_pembimbing.username', '=', 'users.username')
		->where('kd_pembimbing',$kd)->first();
		if ($guru != null) {
			$guru->foto = 'default.jpg';
			$pesan = '';
			$isiclass = 'hapus';
			return view('admin.editGuru', ['pesan' => $pesan, 'isiclass' => $isiclass, 'guru' => $guru]);
		} 
		return redirect()->back(); 
	}
	public function hapusGuru($kd) {
		$guru = Guru::firstWhere('username', $kd);
		if ($guru != null) {
			$image_path = public_path().'/data_file/'.$guru->foto;
			File::delete($image_path);
			$user = User::find($kd);
			$user->delete();
			//hurung hapus file
			return redirect()->back()->with('success', '1 Data berhasil dihapus.');   
		}
		return redirect()->route('kelola_guru');
	}
	public function truncate_guru(Request $request) {
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
	public function resetPassword ($kd) {
		$user = User::find($kd);
		if ($user != null) {
			$guru = Guru::find($kd);
			$psw = "gurukeren";
			$psw = Hash::make($psw);
			$user->password = $psw;
			$user->save();

			return redirect()->back()->with('success', 'Password berhasil direset.'); 
		}
		return redirect()->back();
	}
}
