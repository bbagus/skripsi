<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\{Auth,File,DB,Validator,Hash};
use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\Models\{User,Admin};

class AdminProfil extends Controller
{
    private $repository;
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }
    public function index(UserRepository $repository){
        return View('admin.profil')
        ->with('user', $this->repository->getData());
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
            $user = User::find($data->username);
            $user->password = $passbaru;
            $user->save();
            return back()->with('success','Password berhasil diubah!');
        }
        return back()->withErrors('Password lama salah!');
        
    }
    public function editData(UserRepository $repository){
        return view('admin.editprofil')
        ->with('user', $this->repository->getData());
    }
    public function edit_akun(Request $request){
        $data = $this->repository->getData();        
        $cekuser = User::find($request->username);
        if ( User::firstWhere('email',$request->email) == null || $cekuser->email == $request->email)
        {
            if($cekuser == null || $data->username == $request->username){
                $ceknama = Admin::firstWhere('nama', $request->nama);
                if ($ceknama == null || $data->nama == $request->nama) 
                {
                    $admin = Admin::find($data->username);
                    $nama_file = $admin->foto;
                    $this->validate($request, [
                        'username' => 'required|max:15',
                        'nama' => 'required',
                        'nip' => 'numeric|nullable',
                        'telp' => 'string|max:20|nullable',
                        'email' => 'email|nullable',
                    ]);
                    if ($request->file('foto') != null) {
                        $this->validate($request, [
                            'foto' => 'file|image|mimes:jpeg,png,jpg|max:700',
                        ]);
                        if($admin->foto != 'default.jpg'){
                  //mau ganti foto, 
                           $image_path = public_path().'/data_file/'.$admin->foto;
                           File::delete($image_path);
                       } 
             //upload foto
                       $file = $request->file('foto');
                       $extension = $request->foto->getClientOriginalExtension();
                       $nama_file = 'Admin'.'-'.$request->nama.'.'.$extension;
                        // isi dengan nama folder tempat kemana file diupload
                       $tujuan_upload = 'data_file';
                       $file->move($tujuan_upload,$nama_file);
                   } else if ($request->hapus == 'hapus'){
            //ngilangi foto 
                    $nama_file = 'default.jpg';
                    $image_path = public_path().'/data_file/'.$admin->foto;
                    File::delete($image_path);
                }
                $user = User::find($data->username);
                $user->username = $request->username;
                $user->email = $request->email;
                $user->save();
                $admin->nama = $request->nama;
                $admin->nip = $request->nip;
                $admin->telp = $request->telp;
                $admin->foto = $nama_file;
                $admin->save();
                Auth::login($user);
                return back()->with('success', 'Mengubah detail profil berhasil!');
                return back()->withInput();
            } 
            return back()->withErrors('Nama yang sama sudah ada!');
        } 
        return back()->withErrors('Username yang sama sudah ada!');
    }
    return back()->withErrors('Email yang sama sudah ada!');
}

public function hapusFoto(){
 $data = $this->repository->getData();
 $image_path = public_path().'/data_file/'.$data->foto;
 File::delete($image_path);
 $admin = Admin::find($data->username);
 $admin->foto = 'default.jpg';
 $admin->save();
 return back()->with('success', 'Foto berhasil dihapus.');  
}
}

