<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Informasi extends Model
{
    use HasFactory;
    protected $table = "informasi";
    protected $primaryKey = 'kd_info';
    protected $fillable = ['tanggal','judul','deskripsi','kd_label','slug','penulis','foto', 'status'];

    public $timestamps = false;

}
