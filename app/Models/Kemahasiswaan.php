<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kemahasiswaan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tbl_kemahasiswaan';

    protected $fillable = [
        'id_pengguna',
        'id_superadmin',
        'ketua_kemahasiswaan',
        'jabatan_mulai',
        'jabatan_selesai',
        'status',
        'logo_kemahasiswaan',
    ];

    public function user()
    {
        return $this->belongsTo(Pengguna::class, 'id_pengguna');
    }

    public function superadmin()
    {
        return $this->belongsTo(Superadmin::class, 'id_superadmin');
    }
}

