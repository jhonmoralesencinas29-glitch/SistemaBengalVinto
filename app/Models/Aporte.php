<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Aporte extends Model
{
    use HasFactory;

    protected $table = 'aportes';

    protected $primaryKey = 'id_aporte';

    public $timestamps = false;

    protected $fillable = [
        'id_tipo_aporte',
        'concepto',
        'monto',
        'fecha_creacion',
        'fecha_vencimiento',
        'estado',
    ];

    protected function casts(): array
    {
        return [
            'monto' => 'decimal:2',
            'fecha_creacion' => 'date',
            'fecha_vencimiento' => 'date',
        ];
    }

    public function tipoAporte(): BelongsTo
    {
        return $this->belongsTo(
            TipoAporte::class,
            'id_tipo_aporte',
            'id_tipo_aporte'
        );
    }

    public function aportesComunidades(): HasMany
    {
        return $this->hasMany(
            AporteComunidad::class,
            'id_aporte',
            'id_aporte'
        );
    }

    public function aportesComunarios(): HasMany
    {
        return $this->hasMany(
            AporteComunario::class,
            'id_aporte',
            'id_aporte'
        );
    }
}