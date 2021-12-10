<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB,Validator,File};
use App\Models\{Guru,User};
use App\Repositories\UserRepository;

class AdminGuru extends Controller
{
	public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }
	public function index(){
		return view('admin.guru', ['user' => $this->repository->getData()]);
	}
	public function loadGuru(){
		$guru = DB::table('guru_pembimbing')->get();
		return response()->json($guru);
	}
	public function tambahGuru(){
		return view('admin.tambahGuru')->with('user', $this->repository->getData());
	}
	public function editGuru($kd_pembimbing){
		$user = $this->repository->getData();
		$guru = DB::table('guru_pembimbing')
		->join('users', 'guru_pembimbing.username', '=', 'users.username')
		->where('kd_pembimbing',$kd_pembimbing)->first();
		if ($guru != null) return view('admin.editGuru', ['guru' => $guru, 'user' => $user]);
		return redirect()->action([AdminGuru::class, 'index']);
	}
	public function proses_upload(Request $request){
		$this->validate($request, [
				'nama' => 'required',
				'nip' => 'numeric|nullable',
				'jurusan' => 'required',
				'telp' => 'string|max:20|nullable',
			]);
		$cekkd = Guru::firstWhere('nama', $request->nama);
		if ($cekkd == null) {
			$unik = substr(uniqid('', true), -5);
			if ($request->file('foto') != null) {
				$this->validate($request, [
					'foto' => 'file|image|mimes:jpeg,png,jpg|max:700',
				]);
				$file = $request->file('foto');
				$extension = $request->foto->getClientOriginalExtension();
				$nama_file = $unik.'-'.$request->nama.'.'.$extension;
				$tujuan_upload = 'data_file';
				$file->move($tujuan_upload,$nama_file);
			} else $nama_file = 'default.jpg';
			$psw = bcrypt('gurukeren');
			User::create([
				'username' => $unik,
				'password' => $psw,
				'role' => 'guru',
			]);
			Guru::create([
				'nama' => $request->nama,
				'username' => $unik,
				'nip' => $request->nip,
				'telp' => $request->telp,
				'jurusan' => $request->jurusan,
				'wilayah' => $request->wilayah,
				'foto' => $nama_file,
			]);
			return response()->json(array('msg'=> 'Berhasil input data guru!'), 200);
		} return response()->json(array('msg'=> 'Nama yang sama sudah ada!'), 200);
	}
	public function proses_edit (Request $request){
		$this->validate($request, [
				'nama' => 'required',
				'jurusan' => 'required',
				'nip' => 'numeric|nullable',
				'telp' => 'string|max:20|nullable',
			]);
		$kd = $request->kd_pembimbing;
		$cekkd = Guru::find($kd);
		$ceknama = Guru::firstWhere('nama', $request->nama);
		if ($ceknama == null || $cekkd->nama == $request->nama) {
			$guru = Guru::find($kd);
			$nama_file = $guru->foto;
			$unik = $guru->username;
			if ($request->file('foto') != null) {
				$this->validate($request, [
					'foto' => 'file|image|mimes:jpeg,png,jpg|max:700',
				]);
				if($guru->foto != 'default.jpg'){
				//mau ganti foto, 
					$image_path = public_path().'/data_file/'.$guru->foto;
					File::delete($image_path);
				} 
				$file = $request->file('foto');
				$extension = $request->foto->getClientOriginalExtension();
				$nama_file = $unik.'-'.$request->nama.'.'.$extension;
				$tujuan_upload = 'data_file';
				$file->move($tujuan_upload,$nama_file);
			} else if ($request->hapus == 'hapus'){
			//ngilangi foto 
				$nama_file = 'default.jpg';
				$image_path = public_path().'/data_file/'.$guru->foto;
				File::delete($image_path);
			}
			$guru->nama = $request->nama;
			$guru->nip = $request->nip;
			$guru->telp = $request->telp;
			$guru->jurusan = $request->jurusan;
			$guru->wilayah = $request->wilayah;
			$guru->foto = $nama_file;
			$guru->save();
			$pindah = null;
			if($request->file('foto') != null) $pindah = $request->kd_pembimbing;
			return response()->json(array('msg'=> 'Berhasil mengubah data guru!', 'pindah'=> $pindah), 200);
		} return response()->json(array('msg'=> 'Nama yang sama sudah ada!'), 200);
	}
	public function hapusGuru($kd) {
		$guru = Guru::firstWhere('username', $kd);
		if ($guru != null) {
			$image_path = public_path().'/data_file/'.$guru->foto;
			File::delete($image_path);
			$user = User::find($kd);
			$user->delete();
			return response()->json(array('msg'=> 'Berhasil menghapus data guru!'), 200); 
		}
		return response()->json(array('msg'=> 'Data tidak ditemukan.'), 200);
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
			return response()->json(array('msg'=> $count.' Data berhasil dihapus!'), 200);
		} return response()->json(array('msg'=> 'Tidak ada yang ditandai'), 200);
	}
	public function resetPassword ($kd) {
		$user = User::find($kd);
		if ($user != null) {
			$guru = Guru::find($kd);
			$psw = bcrypt("gurukeren");
			$user->password = $psw;
			$user->save();
			return response()->json(array('msg'=> 'Berhasil reset password'), 200);
		} return response()->json(array('msg'=> 'Akun tidak ditemukan.'), 200);
	}
}
