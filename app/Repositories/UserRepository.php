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
    	if ($role == 'siswa'){
        $user = DB::table('siswa')->where('nis',$username)->first();
    	} else if ($role == 'guru'){
    	$user = DB::table('guru_pembimbing')->where('username',$username)->first();
    	} else {
            $user = Auth::user();
        }
        return $user;
    } 
}