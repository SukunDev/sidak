<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlatImage extends Model
{
    use HasFactory;
    protected $table = 'alat_images';
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
