<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KegiatanOrmawa extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tbl_kegiatan_ormawa';

    protected $fillable = [
        'id_monitoring_kegiatan',
        'jenis_pembayaran',
        'jumlah_pembayaran',
        'tanggal_pembayaran',
    ];

    public function ormawaPembina()
    {
        return $this->belongsTo(OrmawaPembina::class, 'id_ormawa_pembina');
    }

    public function proposalKegiatan()
    {
        return $this->belongsTo(Proposal_Kegiatan::class, 'id_proposal_kegiatan');
    }
    public function monitoringKegiatan()
    {
        return $this->belongsTo(MonitoringKegiatan::class, 'id_monitoring_kegiatan');
    }
}
