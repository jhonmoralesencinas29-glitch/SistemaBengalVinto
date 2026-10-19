<?php

namespace App\Http\Controllers;

use App\Models\AporteComunario;
use App\Models\Asistencia;
use App\Models\Comunidad;
use App\Models\Comunario;
use App\Models\Pago;
use App\Models\Reunion;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ReporteController extends Controller
{
    public function index(Request $request): View
    {
        return view(
            'reportes.index',
            $this->obtenerDatos($request)
        );
    }

    public function imprimir(Request $request): View
    {
        return view(
            'reportes.imprimir',
            $this->obtenerDatos($request)
        );
    }

    public function descargarPdf(Request $request)
    {
        $datos = $this->obtenerDatos($request);

        abort_unless(
            $datos['generado'],
            422,
            'Primero debes generar un reporte.'
        );

        $nombre = 'reporte_'
            .Str::slug($datos['tituloReporte'])
            .'_'
            .now()->format('Ymd_His')
            .'.pdf';

        return Pdf::loadView('reportes.imprimir', $datos + ['pdf' => true])
            ->setPaper('letter', 'portrait')
            ->download($nombre);
    }

    private function obtenerDatos(Request $request): array
    {
        $tipo = $request->input('tipo');
        $periodo = $request->input('periodo', 'reunion');
        $generado = $request->boolean('generar');

        $request->validate(
            [
                'tipo' => [
                    Rule::requiredIf($generado),
                    'nullable',
                    'in:asistencias,estado_cuenta',
                ],
                'generar' => [
                    'nullable',
                    'boolean',
                ],
                'periodo' => [
                    'nullable',
                    'in:reunion,dia,mes,semestre,anio,personalizado',
                ],
                'id_reunion' => [
                    Rule::requiredIf(
                        $generado &&
                        $tipo === 'asistencias' &&
                        $periodo === 'reunion'
                    ),
                    'nullable',
                    'integer',
                    'exists:reuniones,id_reunion',
                ],
                'id_comunidad' => [
                    'nullable',
                    'integer',
                    'exists:comunidades,id_comunidad',
                ],
                'id_comunario' => [
                    Rule::requiredIf(
                        $generado &&
                        $tipo === 'estado_cuenta'
                    ),
                    'nullable',
                    'integer',
                    'exists:comunarios,id_comunario',
                ],
                'fecha_referencia' => [
                    Rule::requiredIf(
                        $generado &&
                        $tipo === 'asistencias' &&
                        $periodo === 'dia'
                    ),
                    'nullable',
                    'date',
                ],
                'mes' => [
                    Rule::requiredIf(
                        $generado &&
                        $tipo === 'asistencias' &&
                        $periodo === 'mes'
                    ),
                    'nullable',
                    'date_format:Y-m',
                ],
                'semestre' => [
                    Rule::requiredIf(
                        $generado &&
                        $tipo === 'asistencias' &&
                        $periodo === 'semestre'
                    ),
                    'nullable',
                    'integer',
                    'in:1,2',
                ],
                'anio' => [
                    Rule::requiredIf(
                        $generado &&
                        $tipo === 'asistencias' &&
                        in_array(
                            $periodo,
                            ['semestre', 'anio'],
                            true
                        )
                    ),
                    'nullable',
                    'integer',
                    'between:2000,2100',
                ],
                'fecha_inicio' => [
                    Rule::requiredIf(
                        $generado &&
                        $tipo === 'asistencias' &&
                        $periodo === 'personalizado'
                    ),
                    'nullable',
                    'date',
                ],
                'fecha_fin' => [
                    Rule::requiredIf(
                        $generado &&
                        $tipo === 'asistencias' &&
                        $periodo === 'personalizado'
                    ),
                    'nullable',
                    'date',
                    'after_or_equal:fecha_inicio',
                ],
            ],
            [
                'tipo.required' =>
                    'Debe seleccionar un tipo de reporte.',
                'tipo.in' =>
                    'El tipo de reporte seleccionado no es válido.',
                'periodo.in' =>
                    'El periodo seleccionado no es válido.',
                'id_reunion.required' =>
                    'Debe seleccionar una reunión.',
                'id_reunion.exists' =>
                    'La reunión seleccionada no existe.',
                'id_comunidad.exists' =>
                    'La comunidad seleccionada no existe.',
                'id_comunario.required' =>
                    'Debe seleccionar un comunario.',
                'id_comunario.exists' =>
                    'El comunario seleccionado no existe.',
                'fecha_referencia.required' =>
                    'Debe seleccionar una fecha.',
                'fecha_referencia.date' =>
                    'La fecha seleccionada no es válida.',
                'mes.required' =>
                    'Debe seleccionar un mes.',
                'mes.date_format' =>
                    'El mes seleccionado no es válido.',
                'semestre.required' =>
                    'Debe seleccionar un semestre.',
                'semestre.in' =>
                    'El semestre seleccionado no es válido.',
                'anio.required' =>
                    'Debe indicar el año.',
                'anio.integer' =>
                    'El año debe ser un número entero.',
                'anio.between' =>
                    'El año indicado no es válido.',
                'fecha_inicio.required' =>
                    'Debe seleccionar la fecha inicial.',
                'fecha_inicio.date' =>
                    'La fecha inicial no es válida.',
                'fecha_fin.required' =>
                    'Debe seleccionar la fecha final.',
                'fecha_fin.date' =>
                    'La fecha final no es válida.',
                'fecha_fin.after_or_equal' =>
                    'La fecha final debe ser igual o posterior a la fecha inicial.',
            ]
        );

        $idReunion = $request->filled('id_reunion')
            ? (int) $request->input('id_reunion')
            : null;

        $idComunidad = $request->filled('id_comunidad')
            ? (int) $request->input('id_comunidad')
            : null;

        $idComunario = $request->filled('id_comunario')
            ? (int) $request->input('id_comunario')
            : null;

        $fechaReferencia = $request->input(
            'fecha_referencia',
            now()->format('Y-m-d')
        );

        $mes = $request->input(
            'mes',
            now()->format('Y-m')
        );

        $semestre = (int) $request->input(
            'semestre',
            now()->month <= 6 ? 1 : 2
        );

        $anio = (int) $request->input(
            'anio',
            now()->year
        );

        $fechaInicio = $request->input('fecha_inicio');
        $fechaFin = $request->input('fecha_fin');

        $comunidades = Comunidad::query()
            ->where('estado', true)
            ->orderBy('nombre')
            ->get();

        $reuniones = Reunion::query()
            ->orderByDesc('fecha')
            ->orderByDesc('hora')
            ->orderByDesc('id_reunion')
            ->get();

        $comunarios = Comunario::query()
            ->with('comunidad')
            ->where('estado', true)
            ->orderBy('id_comunidad')
            ->orderBy('apellidos')
            ->orderBy('nombres')
            ->get();

        $asistencias = collect();
        $asignaciones = collect();
        $pagos = collect();

        $comunarioSeleccionado = null;
        $reunionSeleccionada = null;

        $tituloReporte = 'Reportes';
        $descripcionPeriodo = null;

        $resumen = [];

        if ($generado && $tipo === 'asistencias') {
            $fechaInicialCalculada = null;
            $fechaFinalCalculada = null;

            if ($periodo === 'reunion') {
                $reunionSeleccionada = Reunion::query()
                    ->findOrFail($idReunion);

                $tituloReporte = 'Reporte de asistencia';

                $descripcionPeriodo =
                    $reunionSeleccionada->descripcion
                    .' - '
                    .$reunionSeleccionada->fecha->format('d/m/Y');
            }

            if ($periodo === 'dia') {
                $fechaInicialCalculada = Carbon::parse(
                    $fechaReferencia
                )->startOfDay();

                $fechaFinalCalculada = Carbon::parse(
                    $fechaReferencia
                )->endOfDay();

                $tituloReporte = 'Reporte diario de asistencia';

                $descripcionPeriodo =
                    $fechaInicialCalculada->format('d/m/Y');
            }

            if ($periodo === 'mes') {
                $fechaInicialCalculada = Carbon::createFromFormat(
                    'Y-m-d',
                    $mes.'-01'
                )->startOfMonth();

                $fechaFinalCalculada = $fechaInicialCalculada
                    ->copy()
                    ->endOfMonth();

                $tituloReporte = 'Reporte mensual de asistencia';

                $descripcionPeriodo =
                    $fechaInicialCalculada->translatedFormat(
                        'F \d\e Y'
                    );
            }

            if ($periodo === 'semestre') {
                $mesInicial = $semestre === 1 ? 1 : 7;
                $mesFinal = $semestre === 1 ? 6 : 12;

                $fechaInicialCalculada = Carbon::create(
                    $anio,
                    $mesInicial,
                    1
                )->startOfDay();

                $fechaFinalCalculada = Carbon::create(
                    $anio,
                    $mesFinal,
                    1
                )->endOfMonth();

                $tituloReporte = 'Reporte semestral de asistencia';

                $descripcionPeriodo =
                    ($semestre === 1
                        ? 'Primer semestre'
                        : 'Segundo semestre')
                    .' de '
                    .$anio;
            }

            if ($periodo === 'anio') {
                $fechaInicialCalculada = Carbon::create(
                    $anio,
                    1,
                    1
                )->startOfYear();

                $fechaFinalCalculada = Carbon::create(
                    $anio,
                    12,
                    31
                )->endOfYear();

                $tituloReporte = 'Reporte anual de asistencia';
                $descripcionPeriodo = 'Gestión '.$anio;
            }

            if ($periodo === 'personalizado') {
                $fechaInicialCalculada = Carbon::parse(
                    $fechaInicio
                )->startOfDay();

                $fechaFinalCalculada = Carbon::parse(
                    $fechaFin
                )->endOfDay();

                $tituloReporte = 'Reporte de asistencia por fechas';

                $descripcionPeriodo =
                    'Del '
                    .$fechaInicialCalculada->format('d/m/Y')
                    .' al '
                    .$fechaFinalCalculada->format('d/m/Y');
            }

            $asistencias = Asistencia::query()
                ->with([
                    'reunion',
                    'comunario.comunidad',
                ])
                ->when(
                    $periodo === 'reunion',
                    fn ($consulta) => $consulta->where(
                        'id_reunion',
                        $idReunion
                    )
                )
                ->when(
                    $periodo !== 'reunion',
                    function ($consulta) use (
                        $fechaInicialCalculada,
                        $fechaFinalCalculada
                    ) {
                        $consulta->whereHas(
                            'reunion',
                            fn ($reunion) => $reunion->whereBetween(
                                'fecha',
                                [
                                    $fechaInicialCalculada
                                        ->toDateString(),
                                    $fechaFinalCalculada
                                        ->toDateString(),
                                ]
                            )
                        );
                    }
                )
                ->when(
                    $idComunidad,
                    function ($consulta) use ($idComunidad) {
                        $consulta->whereHas(
                            'comunario',
                            fn ($comunario) => $comunario->where(
                                'id_comunidad',
                                $idComunidad
                            )
                        );
                    }
                )
                ->orderBy('id_reunion')
                ->orderBy('id_comunario')
                ->get()
                ->sortBy(function ($asistencia) {
                    return sprintf(
                        '%s|%s|%s|%s',
                        $asistencia->reunion->fecha
                            ->format('Y-m-d'),
                        $asistencia->comunario->comunidad
                            ?->nombre ?? '',
                        $asistencia->comunario->apellidos,
                        $asistencia->comunario->nombres
                    );
                })
                ->values();

            $resumen = [
                'total' => $asistencias->count(),
                'presentes' => $asistencias->filter(
                    fn ($asistencia) =>
                        strtoupper(
                            trim($asistencia->estado_asistencia)
                        ) === 'PRESENTE'
                )->count(),
                'retrasos' => $asistencias->filter(
                    fn ($asistencia) =>
                        strtoupper(
                            trim($asistencia->estado_asistencia)
                        ) === 'RETRASO'
                )->count(),
                'faltas' => $asistencias->filter(
                    fn ($asistencia) =>
                        strtoupper(
                            trim($asistencia->estado_asistencia)
                        ) === 'FALTA'
                )->count(),
                'licencias' => $asistencias->filter(
                    fn ($asistencia) =>
                        strtoupper(
                            trim($asistencia->estado_asistencia)
                        ) === 'LICENCIA'
                )->count(),
                'reuniones' => $asistencias
                    ->pluck('id_reunion')
                    ->unique()
                    ->count(),
            ];
        }

        if ($generado && $tipo === 'estado_cuenta') {
            $comunarioSeleccionado = Comunario::query()
                ->with('comunidad')
                ->findOrFail($idComunario);

            $asignaciones = AporteComunario::query()
                ->with([
                    'aporte.tipoAporte',
                ])
                ->withSum(
                    'pagos as total_pagado',
                    'monto_pagado'
                )
                ->where(
                    'id_comunario',
                    $idComunario
                )
                ->orderByDesc('id_aporte')
                ->get();

            $pagos = Pago::query()
                ->with([
                    'aporteComunario.aporte',
                    'comprobante',
                    'usuario',
                ])
                ->whereHas(
                    'aporteComunario',
                    fn ($asignacion) => $asignacion->where(
                        'id_comunario',
                        $idComunario
                    )
                )
                ->orderByDesc('fecha_pago')
                ->orderByDesc('id_pago')
                ->get();

            $resumen = [
                'aportes' => $asignaciones->count(),
                'total_asignado' => (float) $asignaciones->sum(
                    'monto_asignado'
                ),
                'total_pagado' => (float) $pagos->sum(
                    'monto_pagado'
                ),
                'saldo_pendiente' => (float) $asignaciones->sum(
                    'saldo'
                ),
                'pagos' => $pagos->count(),
            ];

            $tituloReporte = 'Estado de cuenta del comunario';

            $descripcionPeriodo =
                $comunarioSeleccionado->nombres
                .' '
                .$comunarioSeleccionado->apellidos;
        }

        return compact(
            'tipo',
            'periodo',
            'generado',
            'idReunion',
            'idComunidad',
            'idComunario',
            'fechaReferencia',
            'mes',
            'semestre',
            'anio',
            'fechaInicio',
            'fechaFin',
            'comunidades',
            'reuniones',
            'comunarios',
            'asistencias',
            'asignaciones',
            'pagos',
            'comunarioSeleccionado',
            'reunionSeleccionada',
            'tituloReporte',
            'descripcionPeriodo',
            'resumen'
        );
    }
}