<?php

namespace App\Models;

use App\Models\Fitur;
use App\Models\AkunStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FiturAkun extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function akunStatus()
    {
        return $this->belongsTo(AkunStatus::class, 'akun_id', 'id');
    }
    public function fitur()
    {
        return $this->belongsTo(Fitur::class, 'fitur_id', 'id');
    }
}
