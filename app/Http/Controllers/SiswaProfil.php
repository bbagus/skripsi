<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\{Auth,DB,Validator,Hash};
use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\Models\{User,Siswa};

class SiswaProfil extends Controller
{
    private $repository;
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }
    public function index(UserRepository $repository){
        $user = $this->repository->getData();
        $kelas = DB::table('kelas')->where('kd_kelas', $user->kd_kelas)->first();
        return View('siswa.profil')
        ->with('user', $user)
        ->with('kelas', $kelas);
    }
    public function ganti_password(Request $request) {
        $this->validate($request, [
            'passlama' => 'required',
            'password_baru' => 'required|min:8',
            'konfirm_password_baru' => 'required|min:8|same:password_baru',
        ]);
        if (Hash::check($request->passlama, auth()->user()->password)){
            $data = $this->repository->getData();
            $passbaru = bcrypt($request->password_baru);
            $user = User::find($data->nis);
            $user->password = $passbaru;
            $user->save();
           return response()->json(array('msg'=> 'Berhasil mengubah password!'), 200); 
        } return response()->json(array('msg'=> 'Password lama salah!'), 200); 
    }
    public function editData(UserRepository $repository){
        return view('siswa.editprofil')
        ->with('user', $this->repository->getData());
    }
    public function edit_akun(Request $request){
        $this->validate($request, [
                'tgl_lahir' => 'required',
                'telp' => 'string|max:20|nullable',
                'email' => 'email|nullable',
                'orang_tua' => 'required',
            ]);
        $data = $this->repository->getData(); 
        $cekuser = User::find($data->nis);
        if ( User::firstWhere('email',$request->email) == null || $cekuser->email == $request->email || $request->email == null)
        {
            $data = $this->repository->getData();
            $nis = $data->nis;
            $user = User::find($data->nis);
            $user->email = $request->email;
            $user->save();
            $siswa = Siswa::find($data->nis);
            $siswa->tgl_lahir = $request->tgl_lahir;
            $siswa->telp = $request->telp;
            $siswa->alamat = $request->alamat;
            $siswa->orang_tua = $request->orang_tua;
            $siswa->save();
            return response()->json(array('msg'=> 'Berhasil mengubah detail profil!'), 200);
        } return response()->json(array('msg'=> 'Email yang sama sudah ada!'), 200);
    }
}

