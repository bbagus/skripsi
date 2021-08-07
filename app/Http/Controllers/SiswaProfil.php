<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class SiswaProfil extends Controller
{
    private $repository;
	public function __construct(UserRepository $repository)
    {
        $this->middleware('auth');
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
                'passlama' => 'required|min:8',
                'password_baru' => 'required|min:8',
                'konfirm_password_baru' => 'required|min:8|same:password_baru',
            ]);
        if (Hash::check($request->passlama, auth()->user()->password)){
            $passbaru = Hash::make($request->password_baru);
            $user = User::find($request->nis);
            $user->password = $passbaru;
            $user->save();
            return redirect()->back()->with('success','Password berhasil diubah!');
        }
        return redirect()->back()->withErrors('Password lama salah!');
        
    }
}

