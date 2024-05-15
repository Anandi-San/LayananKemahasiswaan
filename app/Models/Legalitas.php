<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Legalitas extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id_register',
        'proposal_legalitas',
        'AD_ART',
        'surat_permohonan_pengajuan_legalitas',
        'biodata_pembina',
        'struktur_organisasi',
        'daftar_sarana_prasarana',
        'GBHK',
        'bukti_pelaksanaan_musyawarah',
    ];
    
    public function register()
    {
        return $this->belongsTo(Register::class, 'id_register');
    }
}

