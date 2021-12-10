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
            return response()->json(array('msg'=> 'Berhasil mengubah password!'), 200); 
        }
        return response()->json(array('msg'=> 'Password lama salah!'), 200); 
    }
    public function editData(UserRepository $repository){
        return view('admin.editprofil')
        ->with('user', $this->repository->getData());
    }
    public function edit_akun(Request $request){
        $data = $this->repository->getData();
        $this->validate($request, [
            'username' => 'required|max:15|alpha_dash',
            'nama' => 'required',
            'nip' => 'numeric|nullable',
            'telp' => 'string|max:20|nullable',
            'email' => 'email|nullable',
        ]);       
        $cekuser = User::find($request->username);
        $cekemail = User::firstWhere('email',$request->email);
        if ( $cekemail == null || $request->email == null || $cekuser->email == $request->email)
        {
            if($cekuser == null || $data->username == $request->username){
                $ceknama = Admin::firstWhere('nama', $request->nama);
                if ($ceknama == null || $data->nama == $request->nama) 
                {
                    $admin = Admin::find($data->username);
                    $nama_file = $admin->foto;
                    if ($request->file('foto') != null) {
                        $this->validate($request, [
                            'foto' => 'file|image|mimes:jpeg,png,jpg|max:700',
                        ]);
                        if($admin->foto != 'default.jpg'){
                           $image_path = public_path().'/data_file/'.$admin->foto;
                           File::delete($image_path);
                       } 
                       $file = $request->file('foto');
                       $extension = $request->foto->getClientOriginalExtension();
                       $nama_file = 'Admin'.'-'.$request->nama.'.'.$extension;
                       $tujuan_upload = 'data_file';
                       $file->move($tujuan_upload,$nama_file);
                   } else if ($request->hapus == 'hapus'){
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
                $pindah = null;
                if($request->file('foto') != null) $pindah = 'reload';
                return response()->json(array('msg'=> 'Berhasil mengubah detail profil!', 'pindah'=> $pindah), 200);
            } 
            return response()->json(array('msg'=> 'Nama yang sama sudah ada!'), 200);
        } 
        return response()->json(array('msg'=> 'Username yang sama sudah ada!'), 200);
    }
    return response()->json(array('msg'=> 'Email yang sama sudah ada!'), 200);
    }

    public function hapusFoto(){
     $data = $this->repository->getData();
     $image_path = public_path().'/data_file/'.$data->foto;
     File::delete($image_path);
     $admin = Admin::find($data->username);
     $admin->foto = 'default.jpg';
     $admin->save();
     return response()->json(array('msg'=> 'Berhasil menghapus foto!'), 200); 
    }
}

