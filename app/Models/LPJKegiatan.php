<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LPJKegiatan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tbl_lpj_kegiatan';

    protected $fillable = [
        'id_proposal_kegiatan',
        'SPJ_kegiatan',
        'sampul_depan',
        'judul_LPJ',
        'pendahuluan_LPJ',
        'tujuan_LPJ',
        'nama_dan_tema_kegiatan',
        'sasaran_kegiatan',
        'laporan_kegiatan',
        'realisasi_pencapaian',
        'evaluasi_kegiatan',
        'susunan_acara',
        'kepanitiaan',
        'dokumentasi_kegiatan',
        'penangung_jawab_kegiatan',
        'penutup',
        'lampiran1',
        'lampiran2',
        'lampiran3',
        'sampul_belakang',
        'status',
    ];

    public function proposalKegiatan()
    {
        return $this->belongsTo(Proposal_Kegiatan::class, 'id_proposal_kegiatan');
    }
}

