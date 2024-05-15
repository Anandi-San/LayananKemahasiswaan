<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SKlegalitas extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'tbl_SK_legalitas';

    protected $fillable = [
        'id_pengajuan_legalitas',
        'nomor_SK',
        'tanggal_terbit',
        'tanggal_berlaku_mulai',
        'tanggal_berlaku_selesai',
        'file_SK',
        'status',
    ];

    public function pengajuanLegalitas() {
        return $this->belongsTo(PengajuanLegalitas::class, 'id_pengajuan_legalitas');
    }
    public function proposalKegiatan() {
    return $this->hasMany(Proposal_Kegiatan::class, 'id_SK_legalitas');
    }

}
