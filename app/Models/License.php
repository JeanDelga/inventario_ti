<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class License extends Model
{
    protected $table = 'licenses';
    protected $guarded = ['id'];

    public function device()
    {
        return $this->belongsTo(Device::class);
    }
}
