<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Home;
use App\Http\Controllers\Industri;
use App\Http\Controllers\Pedoman;
use App\Http\Controllers\Login;
//admin
use App\Http\Controllers\AdminDashboard;
use App\Http\Controllers\AdminSiswa;
use App\Http\Controllers\AdminGuru;
use App\Http\Controllers\AdminIndustri;
use App\Http\Controllers\AdminInfo;
use App\Http\Controllers\AdminPengajuan;
use App\Http\Controllers\AdminMonitoring;
//siswa
use App\Http\Controllers\SiswaDashboard;
use App\Http\Controllers\SiswaProfil;
use App\Http\Controllers\SiswaPengajuan;
use App\Http\Controllers\SiswaBimbingan;
use App\Http\Controllers\SiswaNilai;
//guru
use App\Http\Controllers\GuruDashboard;
use App\Http\Controllers\GuruProfil;
use App\Http\Controllers\GuruBimbingan;
use App\Http\Controllers\GuruNilai;
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
Route::get('/industri', [Industri::class, 'index']);
Route::get('/pedoman', [Pedoman::class, 'index']);
Route::get('/industri/c', [Industri::class, 'filter']);
Route::get('/industri/{kd_industri}', [Industri::class, 'detailIndustri']);

Route::get('admin', [AdminDashboard::class, 'dashboard'])->middleware('is_admin');
Route::get('siswa', [SiswaDashboard::class, 'dashboard'])->middleware('is_siswa');
Route::get('guru', [GuruDashboard::class, 'dashboard'])->middleware('is_guru');

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
Route::get('admin/kelola-informasi/tambah', [AdminInfo::class, 'tambahInfo'])->middleware('is_admin');
Route::get('admin/kelola-informasi/{kd}', [AdminInfo::class, 'editInfo'])->middleware('is_admin');
Route::get('admin/kelola-informasi/hapus/{kd}', [AdminInfo::class, 'hapusInfo'])->middleware('is_admin');
Route::get('admin/kelola-informasi/hapus-foto/{kd}', [AdminInfo::class, 'hapusFoto'])->middleware('is_admin');

//kelola-pengajuan
Route::get('admin/kelola-pengajuan', [AdminPengajuan::class, 'index'])->middleware('is_admin');
//kelola-penempatan
Route::get('admin/kelola-penempatan', [AdminPengajuan::class, 'penempatan'])->middleware('is_admin');
//monitoring
Route::get('admin/kelola-laporan-mingguan', [AdminMonitoring::class, 'index'])->middleware('is_admin');
Route::get('admin/kelola-laporan-pkl', [AdminMonitoring::class, 'laporanPKL'])->middleware('is_admin');
Route::get('admin/kelola-nilai', [AdminMonitoring::class, 'nilai'])->middleware('is_admin');

//siswa
Route::get('siswa/profil', [SiswaProfil::class, 'index'])->middleware('is_siswa');
Route::get('siswa/profil/edit', [SiswaProfil::class, 'editData'])->middleware('is_siswa');
Route::get('siswa/pengajuan', [SiswaPengajuan::class, 'index'])->middleware('is_siswa');
Route::get('siswa/laporan-mingguan', [SiswaBimbingan::class, 'laporanMingguan'])->middleware('is_siswa');
Route::get('siswa/laporan-pkl', [SiswaBimbingan::class, 'laporanPKL'])->middleware('is_siswa');
Route::get('siswa/nilai', [SiswaNilai::class, 'index'])->middleware('is_siswa');

//guru
Route::get('guru/profil', [GuruProfil::class, 'index'])->middleware('is_guru');
Route::get('guru/profil/edit', [GuruProfil::class, 'editData'])->middleware('is_guru');
Route::get('guru/profil/hapus-foto', [GuruProfil::class, 'hapusFoto'])->middleware('is_guru');
Route::get('guru/siswa-bimbingan', [GuruBimbingan::class, 'siswaBimbingan'])->middleware('is_guru');
Route::get('guru/laporan-mingguan', [GuruBimbingan::class, 'LaporanMingguan'])->middleware('is_guru');
Route::get('guru/laporan-pkl', [GuruBimbingan::class, 'LaporanPKL'])->middleware('is_guru');
Route::get('guru/kelola-nilai', [GuruNilai::class, 'index'])->middleware('is_guru');

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
//post-informasi
Route::post('admin/kelola-informasi/tambah', [AdminInfo::class, 'proses_upload'])->name('upload_info')->middleware('is_admin');
Route::post('admin/kelola-informasi/simpan', [AdminInfo::class, 'proses_simpan'])->name('simpan_info')->middleware('is_admin');
Route::post('admin/kelola-informasi/edit', [AdminInfo::class, 'proses_edit'])->name('edit_info')->middleware('is_admin');
Route::post('admin/kelola-informasi/hapus-informasi', [AdminInfo::class, 'truncate_info'])->name('hapus_info')->middleware('is_admin');

//siswa ganti_password
Route::post('siswa/profil/ubah-password', [SiswaProfil::class, 'ganti_password'])->name('ganti_password')->middleware('is_siswa');
//siswa ubah-akun
Route::post('siswa/profil/edit-akun', [SiswaProfil::class, 'edit_akun'])->middleware('is_siswa');

//guru ganti_password
Route::post('guru/profil/ubah-password', [GuruProfil::class, 'ganti_password'])->name('guru_password')->middleware('is_guru');
//guru ubah-akun
Route::post('guru/profil/edit-akun', [GuruProfil::class, 'edit_akun'])->middleware('is_guru');



Route::fallback(function () {
    abort(404);
});
