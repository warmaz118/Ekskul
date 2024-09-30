<?php

namespace App\Models;

use App\Models\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Siswa extends Authenticatable
{
    protected $table = 'siswa';
    protected $fillable = ['nis', 'name', 'kelas', 'alamat', 'password', 'role_id'];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    // Mutator untuk password hashing
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }
}
