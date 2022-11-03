<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalKalibrasi extends Model
{
    use HasFactory;
    protected $table = 'jadwal_kalibrasis';
    protected $guarded = ['id'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function alat()
    {
        return $this->belongsTo(Alat::class);
    }
}
