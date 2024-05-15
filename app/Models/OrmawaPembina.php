<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrmawaPembina extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tbl_ormawa_pembina';

    protected $fillable = [
        'id_ormawa',
        'id_pembina',
        'id_pengurus_ormawa',
        'tanggal_mulai',
        'tanggal_selesai',
    ];

    public function ormawa()
    {
        return $this->belongsTo(Ormawa::class, 'id_ormawa');
    }

    public function pembina()
    {
        return $this->belongsTo(Pembina::class, 'id_pembina');
    }

    public function pengurusOrmawa()
    {
        return $this->belongsTo(PengurusOrmawa::class, 'id_pengurus_ormawa');
    }

    public function pengajuanLegalitas()
    {
        return $this->hasMany(PengajuanLegalitas::class, 'id_ormawa_pembina');
    }
}
