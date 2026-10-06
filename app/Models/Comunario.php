<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Comunario extends Model
{
    use HasFactory;

    protected $table = 'comunarios';

    protected $primaryKey = 'id_comunario';

    public $timestamps = false;

    protected $fillable = [
        'id_usuario',
        'id_comunidad',
        'numero_comunidad',
        'ci',
        'nombres',
        'apellidos',
        'telefono',
        'direccion',
        'estado',
    ];

    protected function casts(): array
    {
        return [
            'numero_comunidad' => 'integer',
            'estado' => 'boolean',
        ];
    }

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(
            Usuario::class,
            'id_usuario',
            'id_usuario'
        );
    }

    public function comunidad(): BelongsTo
    {
        return $this->belongsTo(
            Comunidad::class,
            'id_comunidad',
            'id_comunidad'
        );
    }

    public function aportesComunarios(): HasMany
    {
        return $this->hasMany(
            AporteComunario::class,
            'id_comunario',
            'id_comunario'
        );
    }

    public function asistencias(): HasMany
    {
        return $this->hasMany(
            Asistencia::class,
            'id_comunario',
            'id_comunario'
        );
    }
}