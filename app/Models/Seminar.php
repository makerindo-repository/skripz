<?php

namespace App\Models;

use App\Models\Mahasiswa;
use App\Models\Penilaian;
use App\Models\SeminarPenguji;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Seminar extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }

    // Relasi ke Penilaian
    public function penilaian()
    {
        return $this->hasMany(Penilaian::class, 'id');
    }

    // Relasi ke Dosen Penguji melalui tabel SidangPenguji
    public function pengujis()
    {
        return $this->hasMany(SeminarPenguji::class);
    }

}
