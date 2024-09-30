<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ekskul extends Model
{
    use HasFactory;
    protected $table = 'ekskul'; // Menentukan nama tabel

    protected $fillable = ['divisi_id', 'pembimbing_id', 'name', 'hari', 'jam', 'lokasi'];

    public function divisi()
    {
        return $this->belongsTo(Divisi::class);
    }

    public function pembimbing()
    {
        return $this->belongsTo(User::class, 'pembimbing_id');
    }
}
