<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;
    protected $table = "guru_pembimbing";
    protected $primaryKey = 'kd_pembimbing';
    protected $fillable = ['nama','username','nip','telp','jurusan','wilayah','foto'];

    public $timestamps = false;

}
