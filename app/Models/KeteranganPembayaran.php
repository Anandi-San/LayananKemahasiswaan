<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KeteranganPembayaran extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tbl_keterangan_pembayaran';
    protected $fillable = [
        'id_monitoring_kegiatan',
        'jenis_pembayaran',
        'jumlah_pembayaran',
        'tanggal_pembayaran',
    ];

    /**
     * Hubungan ke model MonitoringKegiatan
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function monitoringKegiatan()
    {
        return $this->belongsTo(MonitoringKegiatan::class, 'id_monitoring_kegiatan');
    }
}
