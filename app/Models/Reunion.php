<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Reunion extends Model
{
    use HasFactory;

    protected $table = 'reuniones';

    protected $primaryKey = 'id_reunion';

    public $timestamps = false;

    protected $fillable = [
        'descripcion',
        'fecha',
        'hora',
        'lugar',
        'estado',
    ];

    protected function casts(): array
    {
        return [
            'fecha' => 'date',
        ];
    }

    public function comunidades(): BelongsToMany
    {
        return $this->belongsToMany(
            Comunidad::class,
            'reuniones_comunidades',
            'id_reunion',
            'id_comunidad'
        );
    }

    public function asistencias(): HasMany
    {
        return $this->hasMany(
            Asistencia::class,
            'id_reunion',
            'id_reunion'
        );
    }
}