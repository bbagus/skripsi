<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Home;
use App\Http\Controllers\AdminDashboard;
use App\Http\Controllers\AdminSiswa;
use App\Http\Controllers\Login;
use App\Http\Controllers\AdminGuru;
use App\Http\Controllers\AdminIndustri;
use App\Http\Controllers\AdminInfo;
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
//kelola-siswa
Route::get('admin/kelola-siswa', [AdminSiswa::class, 'index'])->name('kelola_siswa')->middleware('is_admin');
Route::get('admin/kelola-siswa/tambah', [AdminSiswa::class, 'tambahSiswa'])->middleware('is_admin');
Route::get('admin/kelola-siswa/{nis}', [AdminSiswa::class, 'editSiswa'])->middleware('is_admin');
Route::get('admin/kelola-siswa/hapus/{nis}', [AdminSiswa::class, 'hapusSiswa'])->middleware('is_admin');
Route::get('admin/kelola-siswa/hapus-foto/{nis}', [AdminSiswa::class, 'hapusFoto'])->middleware('is_admin');
Route::get('admin/kelola-siswa/reset-password/{nis}', [AdminSiswa::class, 'resetPassword'])->middleware('is_admin');
//kelola-guru
Route::get('admin/kelola-guru', [AdminGuru::class, 'index'])->name('kelola_guru')->middleware('is_admin');
Route::get('admin/kelola-guru/tambah', [AdminGuru::class, 'tambahGuru'])->middleware('is_admin');
Route::get('admin/kelola-guru/{kd}', [AdminGuru::class, 'editGuru'])->middleware('is_admin');
Route::get('admin/kelola-guru/hapus/{kd}', [AdminGuru::class, 'hapusGuru'])->middleware('is_admin');
Route::get('admin/kelola-guru/hapus-foto/{kd}', [AdminGuru::class, 'hapusFoto'])->middleware('is_admin');
Route::get('admin/kelola-guru/reset-password/{kd}', [AdminGuru::class, 'resetPassword'])->middleware('is_admin');
//kelola-industri
Route::get('admin/kelola-industri', [AdminIndustri::class, 'index'])->middleware('is_admin');
Route::get('admin/kelola-industri/tambah', [AdminIndustri::class, 'tambahIndustri'])->middleware('is_admin');
Route::get('admin/kelola-industri/{kd}', [AdminIndustri::class, 'editIndustri'])->middleware('is_admin');
Route::get('admin/kelola-industri/hapus/{kd}', [AdminIndustri::class, 'hapusIndustri'])->middleware('is_admin');
Route::get('admin/kelola-industri/hapus-foto/{kd}', [AdminIndustri::class, 'hapusFoto'])->middleware('is_admin');

//kelola-informasi
Route::get('admin/kelola-informasi', [AdminInfo::class, 'index'])->middleware('is_admin');

Route::get('siswa', function () {
    return view('siswa.doble');
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

//post-siswa
Route::post('admin/kelola-siswa/tambah', [AdminSiswa::class, 'proses_upload'])->name('proses_upload')->middleware('is_admin');
Route::post('admin/kelola-siswa/edit', [AdminSiswa::class, 'proses_edit'])->name('proses_edit')->middleware('is_admin');
Route::post('admin/kelola-siswa/hapus-siswa', [AdminSiswa::class, 'truncate_siswa'])->name('hapus_siswa')->middleware('is_admin');
//post-guru
Route::post('admin/kelola-guru/tambah', [AdminGuru::class, 'proses_upload'])->name('upload_guru')->middleware('is_admin');
Route::post('admin/kelola-guru/edit', [AdminGuru::class, 'proses_edit'])->name('edit_guru')->middleware('is_admin');
Route::post('admin/kelola-guru/hapus-guru', [AdminGuru::class, 'truncate_guru'])->name('hapus_guru')->middleware('is_admin');
//post-industri
Route::post('admin/kelola-industri/tambah', [AdminIndustri::class, 'proses_upload'])->name('upload_industri')->middleware('is_admin');
Route::post('admin/kelola-industri/edit', [AdminIndustri::class, 'proses_edit'])->name('edit_industri')->middleware('is_admin');
Route::post('admin/kelola-industri/hapus-industri', [AdminIndustri::class, 'truncate_industri'])->name('hapus_industri')->middleware('is_admin');

Route::fallback(function () {
    //
});
