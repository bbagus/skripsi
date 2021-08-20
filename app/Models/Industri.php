<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Industri extends Model
{
    use HasFactory;
    protected $table = "industri";
    protected $primaryKey = 'kd_industri';
    protected $fillable = ['nama','jurusan','bidang_kerja','deskripsi','alamat','wilayah','telp','website','email','kuota','foto'];

    public $timestamps = false;

}
