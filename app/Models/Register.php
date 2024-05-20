<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Register extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tbl_register';

    protected $fillable = [
        'email_pengguna',
        'nama_ormawa',
        'jenis_ormawa',
        'nama_dosen_pembina',
        'nomor_telepon_PIC',
        'jurusan',
    ];
}
