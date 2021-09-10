<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;
    protected $table = "pengajuan";
    protected $primaryKey = 'kd_pengajuan';
    protected $fillable = ['nis','kd_industri','tgl_pengajuan', 'tgl_diproses' ,'tahun_ajaran','status'];

    public $timestamps = false;

}
