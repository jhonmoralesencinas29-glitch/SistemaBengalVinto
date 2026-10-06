<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Pago extends Model
{
    use HasFactory;

    protected $table = 'pagos';

    protected $primaryKey = 'id_pago';

    public $timestamps = false;

    protected $fillable = [
        'id_aporte_comunario',
        'id_usuario',
        'monto_pagado',
        'fecha_pago',
    ];

    protected function casts(): array
    {
        return [
            'monto_pagado' => 'decimal:2',
            'fecha_pago' => 'datetime',
        ];
    }

    public function aporteComunario(): BelongsTo
    {
        return $this->belongsTo(
            AporteComunario::class,
            'id_aporte_comunario',
            'id_aporte_comunario'
        );
    }

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(
            Usuario::class,
            'id_usuario',
            'id_usuario'
        );
    }

    public function comprobante(): HasOne
    {
        return $this->hasOne(
            Comprobante::class,
            'id_pago',
            'id_pago'
        );
    }
}