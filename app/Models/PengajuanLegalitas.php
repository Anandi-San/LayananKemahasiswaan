<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class PengajuanLegalitas extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tbl_pengajuan_legalitas';

    protected $fillable = [
        'id_ormawa_pembina',
        'id_kemahasiswaan',
        'proposal_legalitas',
        'AD_ART',
        'surat_permohonan',
        'daftar_nama_kepengurusan',
        'biodata_pembina',
        'struktur_organisasi',
        'daftar_sarana_prasarana',
        'GBHK',
        'LPJ_kepengurusan',
        'status',
    ];
    public function ormawaPembina()
    {
        return $this->belongsTo(OrmawaPembina::class, 'id_ormawa_pembina');
    }
    public function kemahasiswaan()
    {
        return $this->hasMany(Kemahasiswaan::class, 'id_kemahasiswaan');
    }
    public function pengajuanLegalitas()
    {
        return $this->belongsTo(PengajuanLegalitas::class, 'id_ormawa_pembina');
    }

    // ini saya ubah ke hasone
    public function skLegalitas()
    {
    return $this->hasOne(SKlegalitas::class, 'id_pengajuan_legalitas');
    }


}
