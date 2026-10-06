<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TipoAporte extends Model
{
    use HasFactory;

    protected $table = 'tipos_aportes';

    protected $primaryKey = 'id_tipo_aporte';

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

    public function aportes(): HasMany
    {
        return $this->hasMany(
            Aporte::class,
            'id_tipo_aporte',
            'id_tipo_aporte'
        );
    }
}