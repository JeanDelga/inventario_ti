<?php

namespace App\Models;

use App\Models\Device;
use App\Models\Department;
use Illuminate\Support\Carbon;
use App\Models\DeviceUserHistory;
use App\Constants\DeviceConstants;
use Spatie\Activitylog\LogOptions;
use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Device extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $table = 'devices';
    protected $guarded = ['id'];


    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_user_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function histories()
    {
        return $this->hasMany(DeviceUserHistory::class);
    }

    protected static function booted()
    {
        static::creating(function ($device) {
            if (empty($device->code)) {
                $device->code = self::generateCode($device);
            }
        });

        static::updated(function ($device) {
            if ($device->isDirty('assigned_user_id') && $device->assigned_user_id) {
                \App\Models\DeviceUserHistory::create([
                    'device_id'   => $device->id,
                    'user_id'     => $device->assigned_user_id,
                    'origin_user' => $device->getOriginal('assigned_user_id'),
                    'last_user'   => $device->assigned_user_id,
                    'assigned_at' => now(),
                ]);
            }
        });
    
        static::created(function ($device) {
            if ($device->assigned_user_id) {
                \App\Models\DeviceUserHistory::create([
                    'device_id'   => $device->id,
                    'user_id'     => $device->assigned_user_id,
                    'origin_user' => null,
                    'last_user'   => $device->assigned_user_id,
                    'assigned_at' => now(),
                ]);
            }
        });
    }

    protected static function generateCode(Device $device): string
    {
        $typeAbbreviation = strtoupper(substr($device->device_type, 0, 3));
        $purchaseDate = $device->purchase_date
            ? \Carbon\Carbon::parse($device->purchase_date)->format('y')
            : now()->format('y');
        
        $companycode = \App\Constants\DeviceConstants::COMPANY_CODES[$device->company] ?? 'XX';

        do {
            $random = str_pad(rand(1, 999), 2, '0', STR_PAD_LEFT);
            $code = "{$companycode}-{$typeAbbreviation}{$random}-{$purchaseDate}";
        } while (Device::where('code', $code)->exists());

    return $code;
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly([
            'name',
            'code',
            'device_type',
            'brand',
            'model',
            'serial_number',
            'assigned_user_id',
            'department_id',
            'purchase_date',
            'warranty_expiration_date',
        ]);
        // Chain fluent methods for configuration options
    }

}
