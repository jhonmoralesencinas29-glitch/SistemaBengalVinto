<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AporteComunidad extends Model
{
    use HasFactory;

    protected $table = 'aportes_comunidades';

    protected $primaryKey = 'id_aporte_comunidad';

    public $timestamps = false;

    protected $fillable = [
        'id_aporte',
        'id_comunidad',
        'monto',
    ];

    protected function casts(): array
    {
        return [
            'monto' => 'decimal:2',
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

    public function comunidad(): BelongsTo
    {
        return $this->belongsTo(
            Comunidad::class,
            'id_comunidad',
            'id_comunidad'
        );
    }
}