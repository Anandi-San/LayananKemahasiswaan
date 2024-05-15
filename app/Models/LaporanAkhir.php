<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LaporanAkhir extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id_monitoring_kegiatan',
        'tanggal_cetak',
    ];

    public function monitoringKegiatan()
    {
        return $this->belongsTo(MonitoringKegiatan::class, 'id_monitoring_kegiatan');
    }
}

