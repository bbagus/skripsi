<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{Home,Industri,Pedoman,Login};
//admin
use App\Http\Controllers\{AdminDashboard,AdminProfil,AdminSiswa,AdminGuru,AdminIndustri,AdminInfo,AdminPengajuan,AdminPenempatan,AdminMonitoring};
//siswa
use App\Http\Controllers\{SiswaDashboard,SiswaProfil,SiswaPengajuan,SiswaIndustri,SiswaBimbingan,SiswaNilai};
//guru
use App\Http\Controllers\{GuruDashboard,GuruProfil,GuruBimbingan,GuruNilai};
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
Route::get('/industri/cari', [Industri::class, 'filter']);
Route::get('/industri/{kd_industri}', [Industri::class, 'detailIndustri']);

//admin
Route::middleware(['auth','is_admin'])->group(function () {
    Route::get('admin',[AdminProfil::class, 'index']);
//profil admin
    Route::get('admin/profil', [AdminProfil::class, 'index']);
    Route::get('admin/profil/edit', [AdminProfil::class, 'editData']);
    Route::get('admin/profil/hapus-foto', [AdminProfil::class, 'hapusFoto']);
    //post profiladmin
    Route::post('admin/profil/ubah-password', [AdminProfil::class, 'ganti_password'])->name('admin_password');
    Route::post('admin/profil/edit-akun', [AdminProfil::class, 'edit_akun']);
//kelola-siswa
    Route::get('admin/kelola-siswa', [AdminSiswa::class, 'index'])->name('kelola_siswa');
    Route::get('admin/get-siswa', [AdminSiswa::class, 'loadSiswa']);
    Route::get('admin/kelola-siswa/tambah', [AdminSiswa::class, 'tambahSiswa']);
    Route::get('admin/kelola-siswa/hapus/{nis}', [AdminSiswa::class, 'hapusSiswa']);
    Route::get('admin/kelola-siswa/{nis}', [AdminSiswa::class, 'editSiswa']);
    Route::get('admin/kelola-siswa/reset-password/{nis}', [AdminSiswa::class, 'resetPassword']);
    //post-kelolasiswa
    Route::post('admin/kelola-siswa/tambah', [AdminSiswa::class, 'proses_upload'])->name('proses_upload');
    Route::post('admin/kelola-siswa/edit', [AdminSiswa::class, 'proses_edit'])->name('proses_edit');
    Route::post('admin/kelola-siswa/hapus-siswa', [AdminSiswa::class, 'truncate_siswa'])->name('hapus_siswa');
//kelola-guru
    Route::get('admin/kelola-guru', [AdminGuru::class, 'index'])->name('kelola_guru');
    Route::get('admin/get-guru', [AdminGuru::class, 'loadGuru']);
    Route::get('admin/kelola-guru/tambah', [AdminGuru::class, 'tambahGuru']);
    Route::get('admin/kelola-guru/hapus/{kd}', [AdminGuru::class, 'hapusGuru']);
    Route::get('admin/kelola-guru/{kd}', [AdminGuru::class, 'editGuru']);
    Route::get('admin/kelola-guru/reset-password/{kd}', [AdminGuru::class, 'resetPassword']);
    //post-kelolaguru
    Route::post('admin/kelola-guru/tambah', [AdminGuru::class, 'proses_upload'])->name('upload_guru');
    Route::post('admin/kelola-guru/edit', [AdminGuru::class, 'proses_edit'])->name('edit_guru');
    Route::post('admin/kelola-guru/hapus-guru', [AdminGuru::class, 'truncate_guru'])->name('hapus_guru');
//kelola-industri
    Route::get('admin/kelola-industri', [AdminIndustri::class, 'index']);
    Route::get('admin/get-industri', [AdminIndustri::class, 'loadIndustri']);
    Route::get('admin/kelola-industri/tambah', [AdminIndustri::class, 'tambahIndustri']);
    Route::get('admin/kelola-industri/{kd}', [AdminIndustri::class, 'editIndustri']);
    Route::get('admin/kelola-industri/hapus/{kd}', [AdminIndustri::class, 'hapusIndustri']);
//post-kelolaindustri
    Route::post('admin/kelola-industri/tambah', [AdminIndustri::class, 'proses_upload'])->name('upload_industri');
    Route::post('admin/kelola-industri/edit', [AdminIndustri::class, 'proses_edit'])->name('edit_industri');
    Route::post('admin/kelola-industri/hapus-industri', [AdminIndustri::class, 'truncate_industri'])->name('hapus_industri');
    //kelola-informasi
    Route::get('admin/kelola-informasi', [AdminInfo::class, 'index']);
    Route::get('admin/get-informasi', [AdminInfo::class, 'loadInfo']);
    Route::get('admin/kelola-informasi/tambah', [AdminInfo::class, 'tambahInfo']);
    Route::get('admin/kelola-informasi/hapus/{kd}', [AdminInfo::class, 'hapusInfo']);
    Route::get('admin/kelola-informasi/{kd}', [AdminInfo::class, 'editInfo']);
//post-kelolainformasi
    Route::post('admin/kelola-informasi/tambah', [AdminInfo::class, 'proses_upload'])->name('upload_info');
    Route::post('admin/kelola-informasi/edit', [AdminInfo::class, 'proses_edit'])->name('edit_info');
    Route::post('admin/kelola-informasi/hapus-informasi', [AdminInfo::class, 'truncate_info'])->name('hapus_info');
    //kelola-pengajuan
    Route::get('admin/kelola-pengajuan', [AdminPengajuan::class, 'index']);
    Route::get('admin/get-pengajuan', [AdminPengajuan::class, 'loadMenunggu']);
    Route::get('admin/kelola-pengajuan/hapus/{kd}', [AdminPengajuan::class, 'hapusPengajuan']);
    Route::get('admin/kelola-pengajuan/otomatis', [AdminPengajuan::class, 'generatePengajuan']);
    Route::get('admin/kelola-pengajuan/{kd}', [AdminPengajuan::class, 'detailPengajuan']);
//post-kelolapengajuan
    Route::post('admin/kelola-pengajuan/terima', [AdminPengajuan::class, 'terima'])->name('terima');
    Route::post('admin/kelola-pengajuan/tolak', [AdminPengajuan::class, 'tolak'])->name('tolak');
    Route::post('admin/kelola-pengajuan/hapus-pengajuan', [AdminPengajuan::class, 'truncate_pengajuan'])->name('hapus_pengajuan');
//kelola-penempatan
    Route::get('admin/kelola-penempatan', [AdminPenempatan::class, 'index']);
    Route::get('admin/kelola-penempatan/guru', function () {
        return redirect('admin/kelola-penempatan/');
     });
    Route::get('admin/kelola-penempatan/instansi', function () {
        return redirect('admin/kelola-penempatan/');
     });
    Route::get('admin/kelola-penempatan/siswa', function () {
        return redirect('admin/kelola-penempatan/');
     });
    //kelola-penempatan/siswa
    Route::get('admin/kelola-penempatan/{kd}', [AdminPenempatan::class, 'detailSiswa']);
    //kelola-penempatan/guru
    Route::get('admin/kelola-penempatan/guru/{nama}', [AdminPenempatan::class, 'detailGuru']);
    Route::get('admin/kelola-penempatan/detail-guru/{kd}', [AdminPenempatan::class, 'loadDetailGuru']);
    Route::get('admin/kelola-penempatan/guru/hapus/{kd}', [AdminPenempatan::class, 'hapusSiswaGuru']);
    //kelola-penempatan/instansi
    Route::get('admin/kelola-penempatan/instansi/{nama}', [AdminPenempatan::class, 'detailIndustri']);
    Route::get('admin/kelola-penempatan/detail-instansi/{kd_industri}', [AdminPenempatan::class, 'loadDetailIndustri']);
    Route::get('admin/kelola-penempatan/instansi/hapus/{kd}', [AdminPenempatan::class, 'hapusSiswaIndustri']);
    //post-penempatan
    Route::post('admin/kelola-penempatan/edit', [AdminPenempatan::class, 'editSiswa']);
    Route::post('admin/kelola-penempatan/guru/edit', [AdminPenempatan::class, 'editGuru']);
    Route::post('admin/kelola-penempatan/guru-hapus', [AdminPenempatan::class, 'truncateGuru'])->name('hapus_bimbingan');
    Route::post('admin/kelola-penempatan/industri-hapus', [AdminPenempatan::class, 'truncateIndustri']);
    Route::post('admin/kelola-penempatan/industri/edit', [AdminPenempatan::class, 'editIndustri']);
//monitoring
    Route::get('admin/kelola-laporan-kegiatan', [AdminMonitoring::class, 'index']);
    Route::get('admin/kelola-laporan-kegiatan/{kd_penempatan}', [AdminMonitoring::class, 'LoadKegiatan']);
    Route::get('admin/kelola-laporan-pkl', [AdminMonitoring::class, 'laporanPKL']);
     Route::get('admin/kelola-laporan-pkl/{kd_penempatan}', [AdminMonitoring::class, 'loadlaporanPKL']);
    Route::get('admin/kelola-nilai', [AdminMonitoring::class, 'nilai']);
    Route::get('admin/get-nilai', [AdminMonitoring::class, 'loadNilai']);
});

Route::middleware(['auth','is_siswa'])->group(function () {
//siswa
    Route::get('siswa', [SiswaProfil::class, 'index']);
    Route::get('siswa/profil', [SiswaProfil::class, 'index']);
    Route::get('siswa/profil/edit', [SiswaProfil::class, 'editData']);
//pengajuan
    Route::get('siswa/pengajuan', [SiswaPengajuan::class, 'index']);
    Route::get('siswa/get-pengajuan', [SiswaPengajuan::class, 'loadPengajuan']);
    Route::get('siswa/detail-instansi', [SiswaIndustri::class, 'index']);
//bimbingan
    Route::get('siswa/laporan-kegiatan', [SiswaBimbingan::class, 'laporanMingguan']);
    Route::get('siswa/load-kegiatan', [SiswaBimbingan::class, 'loadKegiatan']);
    Route::get('siswa/laporan-pkl', [SiswaBimbingan::class, 'laporanPKL']);
    Route::get('siswa/nilai', [SiswaNilai::class, 'index']);
//siswa-post
//siswa ganti_password
    Route::post('siswa/profil/ubah-password', [SiswaProfil::class, 'ganti_password'])->name('ganti_password');
//siswa ubah-akun
    Route::post('siswa/profil/edit-akun', [SiswaProfil::class, 'edit_akun']);
//siswa-pengajuan
    Route::post('siswa/pengajuan/tambah', [SiswaPengajuan::class, 'tambahPengajuan'])->name('tambah_pengajuan');
//detail-instansi
    Route::post('siswa/detail-instansi/edit', [SiswaIndustri::class, 'editDetail']);
    Route::post('siswa/detail-instansi/jadwal', [SiswaIndustri::class, 'editJadwal']);
//bimbingan
    Route::post('siswa/laporan-kegiatan/tambah', [SiswaBimbingan::class, 'tambahLaporanKegiatan']);
    Route::post('siswa/laporan-pkl/tambah', [SiswaBimbingan::class, 'tambahLaporanPKL']);
 });

Route::middleware(['auth','is_guru'])->group(function () {
//guru
    Route::get('guru', [GuruProfil::class, 'index']);
//guruprofil
    Route::get('guru/profil', [GuruProfil::class, 'index']);
    Route::get('guru/profil/edit', [GuruProfil::class, 'editData']);
    Route::get('guru/profil/hapus-foto', [GuruProfil::class, 'hapusFoto']);
//gurubimbingan
    Route::get('guru/siswa-bimbingan', [GuruBimbingan::class, 'siswaBimbingan']);
    Route::get('guru/get-siswa', [GuruBimbingan::class, 'LoadsiswaBimbingan']);
    Route::get('guru/siswa-bimbingan/{kd}', [GuruBimbingan::class, 'DetailsiswaBimbingan']);
    Route::get('guru/laporan-kegiatan', [GuruBimbingan::class, 'LaporanMingguan']);
    Route::get('guru/laporan-kegiatan/{kd_penempatan}', [GuruBimbingan::class, 'LoadKegiatan']);
    Route::get('guru/laporan-pkl', [GuruBimbingan::class, 'LaporanPKL']);
    Route::get('guru/laporan-pkl/{kd_penempatan}', [GuruBimbingan::class, 'LoadLaporanPKL']);
//guru nilai
    Route::get('guru/kelola-nilai', [GuruNilai::class, 'index']);
    Route::get('guru/kelola-nilai/{kd_penempatan}', [GuruNilai::class, 'LoadNilai']);
//guru post
//guru ganti_password
    Route::post('guru/profil/ubah-password', [GuruProfil::class, 'ganti_password'])->name('guru_password');
//guru ubah-akun
    Route::post('guru/profil/edit-akun', [GuruProfil::class, 'edit_akun']);
//guru laporan-pkl
    Route::post('guru/laporan-pkl/tambah', [GuruBimbingan::class, 'tambahLaporanPKL']);
//guru kelola-nilai
    Route::post('guru/kelola-nilai/tambah', [GuruNilai::class, 'tambahNilai']);
 });
//login
Route::get('login', [Login::class, 'index'])->name('login');
Route::post('custom-login', [Login::class, 'customLogin'])->name('login.custom'); 
Route::get('registrasi', [Login::class, 'registrasi'])->name('register-user'); 
Route::post('custom-registrasi', [Login::class, 'customRegistrasi'])->name('register.custom'); 
Route::get('signout', [Login::class, 'signOut'])->name('signout');

//AJAX
Route::get('siswa/pengajuan/cari', [SiswaPengajuan::class, 'search'])->middleware('is_siswa');
Route::middleware(['auth','is_admin'])->group(function () {
    Route::get('admin/kelola-pengajuan-diproses', [AdminPengajuan::class, 'loadDiterima']);
     Route::get('admin/kelola-penempatan-siswa', [AdminPenempatan::class, 'loadSiswa']);
    Route::get('admin/kelola-penempatan-guru', [AdminPenempatan::class, 'loadGuru']);
    Route::get('admin/kelola-penempatan-industri', [AdminPenempatan::class, 'loadIndustri']);
    Route::get('admin/kelola-penempatan-cariguru', [AdminPenempatan::class, 'searchGuru']);
    Route::get('admin/kelola-penempatan-cariindustri', [AdminPenempatan::class, 'searchIndustri']);
    Route::get('admin/kelola-penempatan-carisiswa', [AdminPenempatan::class, 'searchSiswa']);
    Route::get('admin/kelola-penempatan-carisiswa2', [AdminPenempatan::class, 'searchSiswa2']);
    Route::get('admin/kelola-penempatan-carisiswa3', [AdminPenempatan::class, 'searchSiswa3']);
    Route::get('admin/kelola-penempatan-carisiswa4', [AdminPenempatan::class, 'searchSiswa4']);
    Route::get('admin/kelola-laporan-kegiatan/loadsiswa/{kd_kelas}', [AdminMonitoring::class, 'loadSiswa']);
    Route::get('admin/kelola-laporan-kegiatan/loadsiswa2/{kd_kelas}', [AdminMonitoring::class, 'loadSiswa2']);
    });


Route::fallback(function () {
    abort(404);
});
