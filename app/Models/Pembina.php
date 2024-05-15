<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pembina extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tbl_pembina';

    protected $fillable = [
        'id_pengguna',
        'nama_pembina',
        'photo_pembina',
    ];

    public function user()
    {
        return $this->belongsTo(Pengguna::class, 'id_pengguna');
    }
    // Di model Pembina
    public function ormawaPembina()
    {
        return $this->hasMany(OrmawaPembina::class, 'id_pembina');
    }

    // Di model OrmawaPembina
    public function pengajuanLegalitas()
    {
        return $this->hasMany(PengajuanLegalitas::class, 'id_ormawa_pembina');
    }

    // Di model PengajuanLegalitas
    public function skLegalitas()
    {
        return $this->hasOne(SKlegalitas::class, 'id_pengajuan_legalitas');
    }

    // Di model SKlegalitas
    public function proposalKegiatan()
    {
        return $this->hasMany(Proposal_Kegiatan::class, 'id_SK_legalitas');
    }
}
