<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Asistencia extends Model
{
    use HasFactory;

    protected $table = 'asistencias';

    protected $primaryKey = 'id_asistencia';

    public $timestamps = false;

    protected $fillable = [
        'id_reunion',
        'id_comunario',
        'estado_asistencia',
        'observacion',
    ];

    public function reunion(): BelongsTo
    {
        return $this->belongsTo(
            Reunion::class,
            'id_reunion',
            'id_reunion'
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
}