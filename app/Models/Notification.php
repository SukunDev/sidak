<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $table = 'notifications';
    protected $guarded = ['id'];
    protected $with = ['usernotifications'];
    public function usernotifications()
    {
        return $this->hasMany(UserNotification::class);
    }
}
