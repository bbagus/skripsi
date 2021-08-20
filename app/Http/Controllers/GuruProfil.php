<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Guru;

class GuruProfil extends Controller
{
    private $repository;
    public function __construct(UserRepository $repository)
    {
        $this->middleware('auth');
        $this->repository = $repository;
    }
    public function index(UserRepository $repository){
        $user = $this->repository->getData();
        return View('guru.profil')
        ->with('user', $user);
    }
    public function ganti_password(Request $request) {
        $this->validate($request, [
            'passlama' => 'required|min:8',
            'password_baru' => 'required|min:8',
            'konfirm_password_baru' => 'required|min:8|same:password_baru',
        ]);
        if (Hash::check($request->passlama, auth()->user()->password)){
            $data = $this->repository->getData();
            $passbaru = Hash::make($request->password_baru);
            $user = User::find($data->username);
            $user->password = $passbaru;
            $user->save();
            return redirect()->back()->with('success','Password berhasil diubah!');
        }
        return redirect()->back()->withErrors('Password lama salah!');
        
    }
    public function editData(UserRepository $repository){
        $user = $this->repository->getData();
        return view('guru.editprofil')
        ->with('user', $user);
    }
    public function edit_akun(Request $request){
        $data = $this->repository->getData();
        $cekuser = User::find($request->username);
        if($cekuser == null || $data->username == $request->username){
            $ceknama = Guru::firstWhere('nama', $request->nama);
            if ($ceknama == null || $data->nama == $request->nama) 
            {
                $guru = Guru::find($data->kd_pembimbing);
                $nama_file = $guru->foto;
                $this->validate($request, [
                    'username' => 'required|max:15',
                    'nama' => 'required',
                    'jurusan' => 'required',
                    'nip' => 'numeric|nullable',
                    'telp' => 'string|max:20|nullable',
                    'email' => 'email',
                ]);
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
             //upload foto
                 $file = $request->file('foto');
                 $extension = $request->foto->getClientOriginalExtension();
                 $nama_file = $unik.'-'.$request->nama.'.'.$extension;
                        // isi dengan nama folder tempat kemana file diupload
                 $tujuan_upload = 'data_file';
                 $file->move($tujuan_upload,$nama_file);
             } else if ($request->hapus == 'hapus'){
            //ngilangi foto 
                $nama_file = 'default.jpg';
                $image_path = public_path().'/data_file/'.$guru->foto;
                File::delete($image_path);
            }
            $user = User::find($data->username);
            $user->username = $request->username;
            $user->email = $request->email;
            $user->save();
            $guru->nama = $request->nama;
            $guru->nip = $request->nip;
            $guru->telp = $request->telp;
            $guru->jurusan = $request->jurusan;
            $guru->wilayah = $request->wilayah;
            $guru->foto = $nama_file;
            $guru->save();
            Auth::login($user);
            return redirect()->back()->with('success', 'Mengubah detail profil berhasil!')
            ->with('guru', $guru);
            return redirect()->back()->withInput();
            } 
        return redirect()->back()->withErrors('Nama yang sama sudah ada!');
        } 
    return redirect()->back()->withErrors('Username yang sama sudah ada!');
    }

    public function hapusFoto(){
       $data = $this->repository->getData();
       $image_path = public_path().'/data_file/'.$data->foto;
       File::delete($image_path);
       $guru = Guru::find($data->kd_pembimbing);
       $guru->foto = 'default.jpg';
       $guru->save();
       return redirect()->back()->with('success', 'Foto berhasil dihapus.');  
    }
}

