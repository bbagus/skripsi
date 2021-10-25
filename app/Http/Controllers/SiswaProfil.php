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
            $passbaru = Hash::make($request->password_baru);
            $user = User::find($data->nis);
            $user->password = $passbaru;
            $user->save();
            return redirect()->back()->with('success','Password berhasil diubah!');
        }
        return redirect()->back()->withErrors('Password lama salah!');
        
    }
    public function editData(UserRepository $repository){
        $user = $this->repository->getData();
        return view('siswa.editprofil')
        ->with('user', $user);
    }
    public function edit_akun(Request $request){
        $data = $this->repository->getData(); 
        $cekuser = User::find($data->nis);
        if ( User::firstWhere('email',$request->email) == null || $cekuser->email == $request->email)
        {
            $this->validate($request, [
                'tgl_lahir' => 'required',
                'telp' => 'string|max:20|nullable',
                'email' => 'email',
            ]);
            $data = $this->repository->getData();
            $nis = $data->nis;
            $user = User::find($data->nis);
            $user->email = $request->email;
            $user->save();
            $siswa = Siswa::find($data->nis);
            $siswa->tgl_lahir = $request->tgl_lahir;
            $siswa->telp = $request->telp;
            $siswa->alamat = $request->alamat;
            $siswa->save();
            return redirect()->back()->with('success','Mengubah detail profil berhasil!')
            ->with('siswa', $siswa);
            return redirect()->back()->withInput();
        }
        return redirect()->back()->withErrors('Email yang sama sudah ada!');
    }
}

