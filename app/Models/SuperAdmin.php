<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Superadmin extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tbl_superadmin';

    protected $fillable = [
        'nama_superAdmin',
        'id_pengguna',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(Pengguna::class, 'id_pengguna');
    }
}
