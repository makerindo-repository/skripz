<?php

namespace App\Models;

use App\Models\Provinsi;
use App\Models\Kecamatan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kabupaten extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function kecamatans()
    {
        return $this->hasMany(Kecamatan::class);
    }
    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class);
    }
}
