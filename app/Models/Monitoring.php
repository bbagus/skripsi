<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Monitoring extends Model
{
    use HasFactory;

    protected $table = "monitoring";
    protected $primaryKey = 'kd_monitoring';
    protected $fillable = ['kd_penempatan','mulai','selesai','kegiatan','approve'];
    public $timestamps = false;

}
