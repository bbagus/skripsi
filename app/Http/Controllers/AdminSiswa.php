<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB,Validator,File};
use App\Models\{Siswa,User};
use App\Repositories\UserRepository;

class AdminSiswa extends Controller
{
	public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }
	public function index(){
		return view('admin.siswa', ['user' => $this->repository->getData()]);
	}
	public function loadSiswa(){
		$siswa = DB::table('siswa')
		->join('kelas','siswa.kd_kelas', '=', 'kelas.kd_kelas')
		->select('siswa.nis', 'siswa.nama', 'siswa.tgl_lahir', 'kelas.nama as kelas','kelas.jurusan', 'siswa.telp','siswa.alamat','siswa.orang_tua', 'siswa.foto')
		->get();
		return response()->json($siswa);
	}
	public function tambahSiswa(){
		$user = $this->repository->getData();
		return view('admin.tambahSiswa')->with('user', $user);
	}
	public function editSiswa($nis){
		$siswa = DB::table('siswa')
		->join('users', 'siswa.nis', '=', 'users.username')
		->where('nis',$nis)->first();
		if ($siswa != null)	return view('admin.editSiswa', ['siswa' => $siswa,'user' => $this->repository->getData()]);
		return redirect()->action([AdminSiswa::class, 'index']);
	}
	public function proses_upload(Request $request){
		$this->validate($request, [
				'nis' => 'required',
				'nama' => 'required',
				'tgl_lahir' => 'required',
				'kd_kelas' => 'required',
				'telp' => 'string|max:20|nullable',
				'orang_tua' => 'required',
			]);
		$ceknis = Siswa::find($request->nis);
		if ($ceknis == null) {
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
			$psw = bcrypt(date('dmY',$ambil));
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
				'orang_tua' => $request->orang_tua,
				'foto' => $nama_file,
			]);
			return response()->json(array('msg'=> 'Berhasil input data siswa!'), 200);
		} return response()->json(array('msg'=> 'NIS yang sama sudah ada!'), 200);
	}
	public function proses_edit (Request $request) {
		$this->validate($request, [
				'nis' => 'required',
				'nama' => 'required',
				'tgl_lahir' => 'required',
				'kd_kelas' => 'required',
				'telp' => 'string|max:20|nullable',
				'orang_tua' => 'required',
			]);
		$ceknis = Siswa::find($request->nis);
		$nis = $request->nislama;
		if ($ceknis == null || $nis == $request->nis) {
			$siswa = DB::table('siswa')->where('nis',$nis)->first();
			$nama_file = $siswa->foto;
			$unik = substr(uniqid('', true), -5);
			if ($request->file('foto') != null) {
				$this->validate($request, [
					'foto' => 'file|image|mimes:jpeg,png,jpg|max:700',
				]);
				if($siswa->foto != 'default.jpg'){
				//hapus foto sebelumnya
					$image_path = public_path().'/data_file/'.$siswa->foto;
					File::delete($image_path);
				} 
					$file = $request->file('foto');
					$extension = $request->foto->getClientOriginalExtension();
					$nama_file = $unik.'-'.$request->nis.'.'.$extension;
		      	        // isi dengan nama folder tempat kemana file diupload
					$tujuan_upload = 'data_file';
					$file->move($tujuan_upload,$nama_file);
			} else if ($request->hapus == 'hapus'){
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
			$siswa->orang_tua = $request->orang_tua;
			$siswa->save();
			$pindah = null;
			if($request->nis != $nis || $request->file('foto') != null) $pindah = $request->nis;
			return response()->json(array('msg'=> 'Berhasil mengubah data siswa!', 'pindah'=> $pindah), 200);
		} return response()->json(array('msg'=> 'NIS yang sama sudah ada!'), 200);
	}
	public function hapusSiswa($nis) {
		$siswa = Siswa::find($nis);
		if ($siswa != null) {
			$user = User::find($nis);
			$image_path = public_path().'/data_file/'.$siswa->foto;
			File::delete($image_path);
			$user->delete();
			return response()->json(array('msg'=> 'Berhasil menghapus data siswa!'), 200);
		} return response()->json(array('msg'=> 'Data tidak ditemukan.'), 200);
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
			return response()->json(array('msg'=> $count.' Data berhasil dihapus!'), 200);
		} return response()->json(array('msg'=> 'Tidak ada yang ditandai'), 200);
	}
	public function resetPassword ($nis) {
		$user = User::find($nis);
		if ($user != null) {
			$siswa = Siswa::find($nis);
			$ambil = strtotime($siswa->tgl_lahir);
			$psw = bcrypt(date('dmY',$ambil));
			$user->password = $psw;
			$user->save();
			return response()->json(array('msg'=> 'Berhasil reset password'), 200);
		} return response()->json(array('msg'=> 'Akun tidak ditemukan.'), 200);
	}
}
