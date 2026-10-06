<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Comunidad extends Model
{
    use HasFactory;

    protected $table = 'comunidades';

    protected $primaryKey = 'id_comunidad';

    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'descripcion',
        'estado',
    ];

    protected function casts(): array
    {
        return [
            'estado' => 'boolean',
        ];
    }

    public function comunarios(): HasMany
    {
        return $this->hasMany(
            Comunario::class,
            'id_comunidad',
            'id_comunidad'
        );
    }

    public function aportesComunidades(): HasMany
    {
        return $this->hasMany(
            AporteComunidad::class,
            'id_comunidad',
            'id_comunidad'
        );
    }
}