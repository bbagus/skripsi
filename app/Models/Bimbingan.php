<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bimbingan extends Model
{
    use HasFactory;

    protected $table = "bimbingan";
    protected $primaryKey = 'kd_bimbingan';
    protected $fillable = ['kd_penempatan','pengirim','judul','tanggal','catatan','file'];
    public $timestamps = false;

}
