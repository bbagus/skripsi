<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailIndustri extends Model
{
    use HasFactory;
    protected $table = "detail_industri";
    protected $primaryKey = 'kd_detail';
    protected $fillable = ['kd_pengajuan','bagian','pimpinan','pembimbing'];
    public $timestamps = false;

}
