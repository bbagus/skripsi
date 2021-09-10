<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penempatan extends Model
{
    use HasFactory;
    protected $table = "penempatan";
    protected $primaryKey = 'kd_penempatan';
    protected $fillable = ['kd_pengajuan','kd_pembimbing', 'tgl_mulai' ,'tgl_selesai'];

    public $timestamps = false;


}
