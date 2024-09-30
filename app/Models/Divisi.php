<?php

namespace App\Models;

use App\Models\Ekskul;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Divisi extends Model
{
    use HasFactory;
    protected $table = 'divisi';

    protected $fillable = ['nama'];

    public function ekskuls()
    {
        return $this->hasMany(Ekskul::class);
    }
}
