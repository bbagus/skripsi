<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Home;
use App\Http\Controllers\AdminDashboard;
use App\Http\Controllers\AdminSiswa;
use App\Http\Controllers\Login;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//get
Route::get('/', [Home::class, 'index']);
Route::get('admin', [AdminDashboard::class, 'dashboard'])->middleware('is_admin');
Route::get('admin/kelola-siswa', [AdminSiswa::class, 'index'])->middleware('is_admin');
Route::get('admin/kelola-siswa/tambah', [AdminSiswa::class, 'tambahSiswa'])->middleware('is_admin');
Route::get('admin/kelola-siswa/{nis}', [AdminSiswa::class, 'editSiswa'])->middleware('is_admin');
Route::get('admin/kelola-siswa/hapus/{nis}', [AdminSiswa::class, 'hapusSiswa'])->middleware('is_admin');
Route::get('admin/kelola-siswa/hapus-foto/{nis}', [AdminSiswa::class, 'hapusFoto'])->middleware('is_admin');
Route::get('siswa', function () {
    return view('siswa.dashboard');
});
Route::get('guru', function () {
    return view('guru.dashboard');
});
Route::get('dudi', function () {
    return view('dudi.dashboard');
});

//login
Route::get('login', [Login::class, 'index'])->name('login');
Route::post('custom-login', [Login::class, 'customLogin'])->name('login.custom'); 
Route::get('registrasi', [Login::class, 'registrasi'])->name('register-user');
Route::post('custom-registrasi', [Login::class, 'customRegistrasi'])->name('register.custom'); 
Route::get('signout', [Login::class, 'signOut'])->name('signout');

//post
Route::post('admin/kelola-siswa/tambah', [AdminSiswa::class, 'proses_upload'])->name('proses_upload')->middleware('is_admin');
Route::post('admin/kelola-siswa/edit', [AdminSiswa::class, 'proses_edit'])->name('proses_edit')->middleware('is_admin');



Route::fallback(function () {
    //
});
