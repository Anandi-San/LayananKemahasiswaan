<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ormawa extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tbl_ormawa';

    protected $guarded = [
        'nama_ormawa',
        'jenis_ormawa',
        'singkatan',
        'jurusan',
        'logo_ormawa',
    ];

    public function pengguna()
    {
    return $this->belongsTo(Pengguna::class, 'id_pengguna');
    }

    public function pengurusOrmawa()
    {
    return $this->hasMany(PengurusOrmawa::class, 'id_ormawa');
    }

    public function ormawaPembina()
    {
    return $this->hasMany(OrmawaPembina::class, 'id_ormawa');
    }

}
