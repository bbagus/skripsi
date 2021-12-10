<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;
    protected $table = "siswa";
    protected $primaryKey = 'nis';
    protected $fillable = ['nis','nama','tgl_lahir','telp','alamat','kd_kelas','orang_tua','foto'];

    public $timestamps = false;
    protected $keyType = 'string';
    public $incrementing = false;
}
