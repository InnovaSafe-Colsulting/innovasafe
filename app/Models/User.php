<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'names',
        'last_names',
        'city_id',
        'address',
        'neighboarhood',
        'cellphone',
        'email',
        'password',
        'role_id',
        'status',
        'active',
    ];

    protected $hidden = [
        'password',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'status'   => 'string',
            'active'   => 'string',
        ];
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function getNameAttribute(): string
    {
        return $this->names . ' ' . $this->last_names;
    }

    // Método requerido por Filament para mostrar el nombre del usuario
    public function getFilamentName(): string
    {
        return $this->getNameAttribute();
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->role_id == 1;
    }

    public function setStatusAttribute($value)
    {
        $this->attributes['status'] = $value == true ? '1' : '0';
    }
}
