<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;
    protected $table = "admin";
    protected $primaryKey = 'username';
    protected $fillable = ['nama','username','nip','telp','foto'];

    public $timestamps = false;
    protected $keyType = 'string';
    public $incrementing = false;
}
