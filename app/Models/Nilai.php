<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    use HasFactory;

    protected $table = "nilai";
    protected $primaryKey = 'kd_nilai';
    protected $fillable = ['kd_penempatan','nilai_sikap','nilai_keterampilan','nilai_pengetahuan'];
    public $timestamps = false;

}
