<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $table = 'users';
    protected $guarded = ['id'];
    
    /**
 * Override username for login
 */
    public function username()
    {
        return 'user_name';
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relationships
     */

    // Um usuário pertence a um departamento
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    // Um usuário pode ter muitos devices (equipamentos atribuídos)
    public function devices(): HasMany
    {
        return $this->hasMany(Device::class, 'assigned_user_id');
    }
}
