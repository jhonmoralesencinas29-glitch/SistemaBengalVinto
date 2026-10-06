<?php

namespace App\Http\Controllers;

use App\Models\Aporte;
use App\Models\AporteComunario;
use App\Models\Comprobante;
use App\Models\Pago;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class PagoController extends Controller
{
    public function index(Request $request): View
    {
        $buscar = trim((string) $request->input('buscar'));
        $idAporte = $request->input('id_aporte');
        $fechaInicio = $request->input('fecha_inicio');
        $fechaFin = $request->input('fecha_fin');

        $hayFiltros =
            $buscar !== '' ||
            !empty($idAporte) ||
            !empty($fechaInicio) ||
            !empty($fechaFin);

        $pagos = null;

        if ($hayFiltros) {
            $pagos = Pago::query()
                ->with([
                    'aporteComunario.aporte',
                    'aporteComunario.comunario.comunidad',
                    'usuario',
                    'comprobante',
                ])
                ->when($buscar !== '', function ($consulta) use ($buscar) {
                    $consulta->where(function ($q) use ($buscar) {
                        $q->whereHas(
                            'aporteComunario.comunario',
                            function ($comunario) use ($buscar) {
                                $comunario
                                    ->where('nombres', 'like', "%{$buscar}%")
                                    ->orWhere('apellidos', 'like', "%{$buscar}%")
                                    ->orWhere('ci', 'like', "%{$buscar}%");
                            }
                        )
                        ->orWhereHas(
                            'aporteComunario.aporte',
                            function ($aporte) use ($buscar) {
                                $aporte->where(
                                    'concepto',
                                    'like',
                                    "%{$buscar}%"
                                );
                            }
                        )
                        ->orWhereHas(
                            'comprobante',
                            function ($comprobante) use ($buscar) {
                                $comprobante->where(
                                    'numero_comprobante',
                                    'like',
                                    "%{$buscar}%"
                                );
                            }
                        );
                    });
                })
                ->when($idAporte, function ($consulta) use ($idAporte) {
                    $consulta->whereHas(
                        'aporteComunario',
                        function ($aporteComunario) use ($idAporte) {
                            $aporteComunario->where(
                                'id_aporte',
                                $idAporte
                            );
                        }
                    );
                })
                ->when(
                    $fechaInicio,
                    fn ($consulta) => $consulta->whereDate(
                        'fecha_pago',
                        '>=',
                        $fechaInicio
                    )
                )
                ->when(
                    $fechaFin,
                    fn ($consulta) => $consulta->whereDate(
                        'fecha_pago',
                        '<=',
                        $fechaFin
                    )
                )
                ->orderByDesc('fecha_pago')
                ->orderByDesc('id_pago')
                ->paginate(10)
                ->withQueryString();
        }

        $aportes = Aporte::query()
            ->whereHas('aportesComunarios')
            ->orderByDesc('fecha_creacion')
            ->get();

        $aportesResumen = Aporte::query()
            ->whereHas('aportesComunarios')
            ->withSum(
                'aportesComunarios as monto_esperado',
                'monto_asignado'
            )
            ->withSum(
                'aportesComunarios as saldo_pendiente',
                'saldo'
            )
            ->withCount([
                'aportesComunarios as total_asignados',
                'aportesComunarios as total_pagados' =>
                    fn ($consulta) => $consulta->where(
                        'saldo',
                        '<=',
                        0
                    ),
                'aportesComunarios as total_pendientes' =>
                    fn ($consulta) => $consulta->where(
                        'saldo',
                        '>',
                        0
                    ),
            ])
            ->orderByDesc('fecha_creacion')
            ->orderByDesc('id_aporte')
            ->get();

        $aportesResumen->each(function ($aporte) {
            $montoEsperado = round(
                (float) ($aporte->monto_esperado ?? 0),
                2
            );

            $saldoPendiente = round(
                (float) ($aporte->saldo_pendiente ?? 0),
                2
            );

            $montoRecaudado = round(
                $montoEsperado - $saldoPendiente,
                2
            );

            $montoRecaudado = max(0, $montoRecaudado);

            $porcentajeRecaudado = $montoEsperado > 0
                ? round(
                    ($montoRecaudado / $montoEsperado) * 100,
                    1
                )
                : 0;

            $porcentajeRecaudado = min(
                100,
                max(0, $porcentajeRecaudado)
            );

            $aporte->setAttribute(
                'monto_esperado',
                $montoEsperado
            );

            $aporte->setAttribute(
                'saldo_pendiente',
                $saldoPendiente
            );

            $aporte->setAttribute(
                'monto_recaudado',
                $montoRecaudado
            );

            $aporte->setAttribute(
                'porcentaje_recaudado',
                $porcentajeRecaudado
            );
        });

        $aportesPorGestion = $aportesResumen->groupBy(
            function ($aporte) {
                return $aporte->fecha_creacion
                    ?->format('Y') ?? 'Sin fecha';
            }
        );

        $totalPagos = Pago::query()->count();

        $totalRecaudado = (float) Pago::query()
            ->sum('monto_pagado');

        $recaudadoHoy = (float) Pago::query()
            ->whereDate('fecha_pago', now()->toDateString())
            ->sum('monto_pagado');

        $aportesPendientes = AporteComunario::query()
            ->where('saldo', '>', 0)
            ->count();

        return view('pagos.index', compact(
            'pagos',
            'aportes',
            'aportesPorGestion',
            'buscar',
            'idAporte',
            'fechaInicio',
            'fechaFin',
            'hayFiltros',
            'totalPagos',
            'totalRecaudado',
            'recaudadoHoy',
            'aportesPendientes'
        ));
    }

    public function create(Request $request): View
    {
        $idAporteComunario = $request->input(
            'id_aporte_comunario'
        );

        $asignaciones = AporteComunario::query()
            ->with([
                'aporte',
                'comunario.comunidad',
            ])
            ->where('saldo', '>', 0)
            ->whereHas('aporte', function ($aporte) {
                $aporte->where('estado', 'activo');
            })
            ->whereHas('comunario', function ($comunario) {
                $comunario->where('estado', true);
            })
            ->orderBy('id_aporte')
            ->orderBy('id_comunario')
            ->get();

        $comunidades = $asignaciones
            ->pluck('comunario.comunidad')
            ->filter()
            ->unique('id_comunidad')
            ->sortBy('nombre')
            ->values();

        $asignacionSeleccionada = null;

        if ($idAporteComunario) {
            $asignacionSeleccionada = $asignaciones->firstWhere(
                'id_aporte_comunario',
                (int) $idAporteComunario
            );
        }

        return view('pagos.create', compact(
            'asignaciones',
            'comunidades',
            'asignacionSeleccionada',
            'idAporteComunario'
        ));
    }

    public function store(Request $request): RedirectResponse
    {
        $datos = $request->validate([
            'id_aporte_comunario' => [
                'required',
                'integer',
                'exists:aportes_comunarios,id_aporte_comunario',
            ],
            'monto_pagado' => [
                'required',
                'numeric',
                'gt:0',
                'decimal:0,2',
            ],
            'fecha_pago' => [
                'nullable',
                'date',
                'before_or_equal:now',
            ],
        ]);

        $pago = DB::transaction(function () use ($datos) {
            $aporteComunario = AporteComunario::query()
                ->lockForUpdate()
                ->findOrFail($datos['id_aporte_comunario']);

            $saldoActual = round(
                (float) $aporteComunario->saldo,
                2
            );

            $montoPagado = round(
                (float) $datos['monto_pagado'],
                2
            );

            if ($saldoActual <= 0) {
                throw ValidationException::withMessages([
                    'monto_pagado' =>
                        'Este aporte ya fue pagado completamente.',
                ]);
            }

            if ($montoPagado > $saldoActual) {
                throw ValidationException::withMessages([
                    'monto_pagado' =>
                        'El monto no puede ser mayor al saldo pendiente de Bs '
                        .number_format($saldoActual, 2, ',', '.')
                        .'.',
                ]);
            }

            $nuevoSaldo = round(
                $saldoActual - $montoPagado,
                2
            );

            if ($nuevoSaldo <= 0) {
                $nuevoSaldo = 0;
                $estadoPago = 'pagado';
            } else {
                $estadoPago = 'parcial';
            }

            $pago = Pago::create([
                'id_aporte_comunario' =>
                    $aporteComunario->id_aporte_comunario,
                'id_usuario' => auth()->id(),
                'monto_pagado' => $montoPagado,
                'fecha_pago' => $datos['fecha_pago'] ?? now(),
            ]);

            $aporteComunario->update([
                'saldo' => $nuevoSaldo,
                'estado_pago' => $estadoPago,
            ]);

            $numeroComprobante = 'COMP-'
                .now()->format('Ymd')
                .'-'
                .str_pad(
                    (string) $pago->id_pago,
                    6,
                    '0',
                    STR_PAD_LEFT
                );

            Comprobante::create([
                'id_pago' => $pago->id_pago,
                'numero_comprobante' => $numeroComprobante,
                'fecha_emision' => now(),
            ]);

            return $pago;
        });

        return redirect()
            ->route('pagos.show', $pago)
            ->with(
                'exito',
                'El pago fue registrado correctamente.'
            );
    }

    public function show(Pago $pago): View
    {
        $pago->load([
            'aporteComunario.aporte.tipoAporte',
            'aporteComunario.comunario.comunidad',
            'usuario',
            'comprobante',
        ]);

        return view('pagos.show', compact('pago'));
    }

    public function comprobante(Pago $pago): View
    {
        $pago->load([
            'aporteComunario.aporte.tipoAporte',
            'aporteComunario.comunario.comunidad',
            'usuario',
            'comprobante',
        ]);

        return view('pagos.comprobante', compact('pago'));
    }

    public function descargarComprobante(Pago $pago): Response
    {
        $pago->load([
            'aporteComunario.aporte.tipoAporte',
            'aporteComunario.comunario.comunidad',
            'usuario',
            'comprobante',
        ]);

        abort_if(
            !$pago->comprobante,
            404,
            'El comprobante solicitado no existe.'
        );

        $nombreArchivo = 'comprobante-'
            .$pago->comprobante->numero_comprobante
            .'.pdf';

        return Pdf::loadView(
            'pagos.comprobante-pdf',
            compact('pago')
        )
            ->setPaper('letter', 'portrait')
            ->download($nombreArchivo);
    }
}