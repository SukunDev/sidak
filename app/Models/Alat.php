<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alat extends Model
{
    use HasFactory;
    protected $table = 'alats';
    protected $guarded = ['id'];
    protected $with = ['jadwal', 'images'];

    public function scopeFilter($query, array $filters)
    {
        $query->when(
            $filters['search'] ?? false,
            fn($query, $search) => $query
                ->where('nama_alat', 'like', '%' . $search . '%')
                ->orWhere('merk', 'like', '%' . $search . '%')
                ->orWhere('kode_alat', 'like', '%' . $search . '%')
        );
        $query->when(
            $filters['status'] ?? false,
            fn($query, $status) => $query->where(
                'status_kalibrasi',
                '=',
                $status
            )
        );
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function jadwal()
    {
        return $this->hasMany(AlatJadwal::class)->latest('jadwal_kalibrasi');
    }
    public function images()
    {
        return $this->hasMany(AlatImages::class);
    }
}
