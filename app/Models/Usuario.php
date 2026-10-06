<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Usuario extends Authenticatable
{
    use HasFactory;

    protected $table = 'usuarios';

    protected $primaryKey = 'id_usuario';

    public $timestamps = false;

    protected $fillable = [
        'nombre_completo',
        'usuario',
        'contrasena',
        'rol',
        'estado',
    ];

    protected $hidden = [
        'contrasena',
    ];

    protected function casts(): array
    {
        return [
            'contrasena' => 'hashed',
            'estado' => 'boolean',
        ];
    }

    public function getAuthPasswordName(): string
    {
        return 'contrasena';
    }

    public function comunario(): HasOne
    {
        return $this->hasOne(
            Comunario::class,
            'id_usuario',
            'id_usuario'
        );
    }

    public function pagos(): HasMany
    {
        return $this->hasMany(
            Pago::class,
            'id_usuario',
            'id_usuario'
        );
    }
}