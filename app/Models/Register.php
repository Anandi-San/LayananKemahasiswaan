<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Register extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'email_pengguna',
        'nama_ormawa',
        'jenis_ormawa',
        'nama_dosen_pembina',
        'nomor_telopen_PIC',
        'jurusan',
    ];
}
