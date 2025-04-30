<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'origin_user',
        'last_user',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function devices()
    {
        return $this->hasMany(Device::class);
    }
}
