<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Auth\Passwords\CanResetPassword as ResetPasswordTrait;

class Pengguna extends Model implements AuthenticatableContract, CanResetPassword
{
    use HasFactory, SoftDeletes, Authenticatable, Notifiable, ResetPasswordTrait;

    protected $table = 'tbl_pengguna';

    protected $fillable = [
        'email',
        'password',
        'role',
    ];

    // Relasi lainnya
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
