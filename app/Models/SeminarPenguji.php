<?php

namespace App\Models;

use App\Models\Dosen;
use App\Models\Seminar;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SeminarPenguji extends Model
{
    use HasFactory;
    protected $guarded = [];
    // Relasi ke Sidang
    public function seminar()
    {
        return $this->belongsTo(Seminar::class);
    }

    // Relasi ke Dosen
    public function dosen()
    {
        return $this->belongsTo(Dosen::class);
    }
}
