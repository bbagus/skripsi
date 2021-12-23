<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $table = "jadwal";
    protected $primaryKey = 'kd_jadwal';
    protected $casts = [
         'senin' => 'array',
         'selasa' => 'array',
         'rabu' => 'array',
         'kamis' => 'array',
         'jumat' => 'array',
         'sabtu' => 'array',
         'minggu' => 'array'
    ];
    protected $fillable = ['senin','selasa','rabu','kamis','jumat','sabtu','minggu','kd_detail'];
    public $timestamps = false;

}
