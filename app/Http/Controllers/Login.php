<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Hash,Auth};
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Session;
use App\Models\User;

class Login extends Controller
{
    use AuthenticatesUsers;
    public function index()
    {  
        return view('auth.login');
    }
    public function customLogin(Request $request){
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        $credentials = $request->only('username', 'password');
        $remember_me = $request->has('remember') ? true : false; 
        if (Auth::attempt($credentials, $remember_me)) {
            $role = auth()->user()->role;
           if ($role == 'admin') {
                 $request->session()->regenerate();//tambahan
                 return redirect('admin');
             }else if ($role == 'siswa'){
                $request->session()->regenerate();//tambahan
                return redirect('siswa');
             }else if ($role == 'guru'){
                $request->session()->regenerate();//tambahan
                return redirect('guru');
             }
         } return redirect("login")->withSuccess('Username atau Password salah!');
    }
    public function signOut(Request $request) {
        Session::flush();
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return Redirect('login')->withSuccess('Berhasil log-out');
    }
}
