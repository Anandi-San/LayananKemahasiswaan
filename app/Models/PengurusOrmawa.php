<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PengurusOrmawa extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tbl_pengurus_ormawa';

    protected $fillable = [
        'id_ormawa',
        'nama_kabinet',
        'ketua_ormawa',
        'visi',
        'misi',
        'kabinet_masa_mulai',
        'kabinet_masa_selesai',
        'logo_kabinet',
    ];

    public function ormawa()
    {
        return $this->belongsTo(Ormawa::class, 'id_ormawa');
    }
}
