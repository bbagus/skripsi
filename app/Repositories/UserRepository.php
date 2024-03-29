<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserRepository
{
    /**
     * Get all of the tasks for a given user.
     *
     * @param  User  $user
     * @return Collection
     */
    public function getData()
    {
    	$role = Auth::user()->role;
    	$username = Auth::user()->username;
    	if ($role == 'siswa') $user = DB::table('siswa')->where('nis',$username)->first();
    	else if ($role == 'guru') $user = DB::table('guru_pembimbing')->where('username',$username)->first();
    	else $user = DB::table('admin')->where('username',$username)->first();
        return $user;
    } 
    public function getKoordinator(){
        $koordinator = (object)array(); 
        $koordinator->nama = 'Bagus Santosa, S.Pd.';
        $koordinator->nip = '1234567891011';
        return $koordinator;
    }
    public function getTahunAjaran(){
        $tahunajar = '2023/2024';
        return $tahunajar;
    }

    public function getTanggalPKL(){
        $tanggal = (object)array(); 
        $tanggal->mulai = '2022-01-01';
        $tanggal->selesai = '2023-12-31';
        return $tanggal;
    }
}