<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;

class Pengguna extends Model implements Authenticatable
{
    use HasFactory, SoftDeletes, AuthenticatableTrait;

    protected $table = 'tbl_pengguna';

    protected $fillable = [
        'email',
        'password',
        'role',
    ];

    public function ormawa()
    {
        return $this->hasMany(Ormawa::class, 'id_pengguna');
    }

    public function pembina()
    {
        return $this->hasMany(Pembina::class, 'id_pengguna');
    }

    public function kemahasiswaan()
    {
        return $this->hasMany(Kemahasiswaan::class, 'id_pengguna');
    }

    public function superadmin()
    {
        return $this->hasMany(SuperAdmin::class, 'id_pengguna');
    }

    public function ormawaPembina()
    {
        return $this->hasMany(OrmawaPembina::class, 'id_pembina');
    }

    public function pengurusOrmawa()
    {
    return $this->hasMany(PengurusOrmawa::class, 'id_ormawa');
    }
}
