<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AporteComunario extends Model
{
    use HasFactory;

    protected $table = 'aportes_comunarios';

    protected $primaryKey = 'id_aporte_comunario';

    public $timestamps = false;

    protected $fillable = [
        'id_aporte',
        'id_comunario',
        'monto_asignado',
        'saldo',
        'estado_pago',
    ];

    protected function casts(): array
    {
        return [
            'monto_asignado' => 'decimal:2',
            'saldo' => 'decimal:2',
        ];
    }

    public function aporte(): BelongsTo
    {
        return $this->belongsTo(
            Aporte::class,
            'id_aporte',
            'id_aporte'
        );
    }

    public function comunario(): BelongsTo
    {
        return $this->belongsTo(
            Comunario::class,
            'id_comunario',
            'id_comunario'
        );
    }

    public function pagos(): HasMany
    {
        return $this->hasMany(
            Pago::class,
            'id_aporte_comunario',
            'id_aporte_comunario'
        );
    }
}