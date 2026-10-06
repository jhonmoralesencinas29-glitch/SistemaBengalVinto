<?php

namespace App\Http\Controllers;

use App\Models\Aporte;
use App\Models\AporteComunidad;
use App\Models\AporteComunario;
use App\Models\Comunidad;
use App\Models\Comunario;
use App\Models\TipoAporte;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Throwable;

class AporteController extends Controller
{
    public function index(Request $request): View
    {
        $buscar = trim((string) $request->input('buscar'));
        $estado = $request->input('estado');

        $aportes = Aporte::query()
            ->with('tipoAporte')
            ->withCount('aportesComunarios')
            ->when($buscar, function ($consulta) use ($buscar) {
                $consulta->where(function ($q) use ($buscar) {
                    $q->where(
                        'concepto',
                        'like',
                        "%{$buscar}%"
                    )
                        ->orWhereHas(
                            'tipoAporte',
                            function ($tipo) use ($buscar) {
                                $tipo->where(
                                    'nombre',
                                    'like',
                                    "%{$buscar}%"
                                );
                            }
                        );
                });
            })
            ->when($estado, function ($consulta) use ($estado) {
                $consulta->where('estado', $estado);
            })
            ->orderByDesc('fecha_creacion')
            ->orderByDesc('id_aporte')
            ->paginate(10)
            ->withQueryString();

        return view('aportes.index', compact(
            'aportes',
            'buscar',
            'estado'
        ));
    }

    public function create(): View
    {
        $tiposAportes = TipoAporte::query()
            ->where('estado', true)
            ->orderBy('nombre')
            ->get();

        $comunidades = Comunidad::query()
            ->withCount([
                'comunarios as comunarios_activos_count' =>
                    function ($consulta) {
                        $consulta->where('estado', true);
                    },
            ])
            ->orderBy('id_comunidad')
            ->get()
            ->unique('id_comunidad')
            ->values();

        return view('aportes.create', compact(
            'tiposAportes',
            'comunidades'
        ));
    }

    public function store(Request $request): RedirectResponse
    {
        $comunidades = Comunidad::query()
            ->orderBy('id_comunidad')
            ->get()
            ->unique('id_comunidad')
            ->values();

        $reglas = $this->reglasAporte();

        foreach ($comunidades as $comunidad) {
            $reglas[
                "montos.{$comunidad->id_comunidad}"
            ] = [
                'required',
                'numeric',
                'min:0.01',
                'max:99999999.99',
            ];
        }

        $mensajes = $this->mensajesValidacion();

        foreach ($comunidades as $comunidad) {
            $mensajes[
                "montos.{$comunidad->id_comunidad}.required"
            ] = "Debe ingresar el monto para {$comunidad->nombre}.";

            $mensajes[
                "montos.{$comunidad->id_comunidad}.numeric"
            ] = "El monto de {$comunidad->nombre} debe ser numérico.";

            $mensajes[
                "montos.{$comunidad->id_comunidad}.min"
            ] = "El monto de {$comunidad->nombre} debe ser mayor que cero.";

            $mensajes[
                "montos.{$comunidad->id_comunidad}.max"
            ] = "El monto de {$comunidad->nombre} es demasiado elevado.";
        }

        $datos = $request->validate(
            $reglas,
            $mensajes
        );

        try {
            DB::transaction(function () use (
                $datos,
                $comunidades
            ) {
                $primeraComunidad = $comunidades->first();

                $montoReferencia = $datos['montos'][
                    $primeraComunidad->id_comunidad
                ];

                $aporte = Aporte::create([
                    'id_tipo_aporte' =>
                        $datos['id_tipo_aporte'],
                    'concepto' =>
                        $datos['concepto'],
                    'monto' =>
                        $montoReferencia,
                    'fecha_creacion' =>
                        $datos['fecha_creacion'],
                    'fecha_vencimiento' =>
                        $datos['fecha_vencimiento'],
                    'estado' =>
                        'activo',
                ]);

                foreach ($comunidades as $comunidad) {
                    $monto = $datos['montos'][
                        $comunidad->id_comunidad
                    ];

                    AporteComunidad::updateOrCreate(
                        [
                            'id_aporte' =>
                                $aporte->id_aporte,
                            'id_comunidad' =>
                                $comunidad->id_comunidad,
                        ],
                        [
                            'monto' => $monto,
                        ]
                    );
                }

                $comunarios = Comunario::query()
                    ->where('estado', true)
                    ->whereNotNull('id_comunidad')
                    ->orderBy('id_comunario')
                    ->get()
                    ->unique('id_comunario')
                    ->values();

                foreach ($comunarios as $comunario) {
                    if (
                        !array_key_exists(
                            $comunario->id_comunidad,
                            $datos['montos']
                        )
                    ) {
                        continue;
                    }

                    $montoAsignado = $datos['montos'][
                        $comunario->id_comunidad
                    ];

                    AporteComunario::updateOrCreate(
                        [
                            'id_aporte' =>
                                $aporte->id_aporte,
                            'id_comunario' =>
                                $comunario->id_comunario,
                        ],
                        [
                            'monto_asignado' =>
                                $montoAsignado,
                            'saldo' =>
                                $montoAsignado,
                            'estado_pago' =>
                                'pendiente',
                        ]
                    );
                }
            });
        } catch (Throwable $error) {
            report($error);

            return redirect()
                ->back()
                ->withInput()
                ->withErrors([
                    'general' =>
                        'No se pudo crear el aporte. Verifique los datos e inténtelo nuevamente.',
                ]);
        }

        return redirect()
            ->route('aportes.index')
            ->with(
                'exito',
                'El aporte fue creado y asignado a todos los contribuyentes activos.'
            );
    }

    public function show(Aporte $aporte): View
    {
        $aporte->load([
            'tipoAporte',
            'aportesComunidades.comunidad',
            'aportesComunarios.comunario.comunidad',
        ]);

        return view('aportes.show', compact('aporte'));
    }

    public function edit(Aporte $aporte): View
    {
        $aporte->load([
            'tipoAporte',
            'aportesComunidades',
        ]);

        $tiposAportes = TipoAporte::query()
            ->where('estado', true)
            ->orWhere(
                'id_tipo_aporte',
                $aporte->id_tipo_aporte
            )
            ->orderBy('nombre')
            ->get();

        $comunidades = Comunidad::query()
            ->withCount([
                'comunarios as comunarios_activos_count' =>
                    function ($consulta) {
                        $consulta->where('estado', true);
                    },
            ])
            ->orderBy('id_comunidad')
            ->get()
            ->unique('id_comunidad')
            ->values();

        $montosComunidades = $aporte
            ->aportesComunidades
            ->pluck('monto', 'id_comunidad');

        return view('aportes.edit', compact(
            'aporte',
            'tiposAportes',
            'comunidades',
            'montosComunidades'
        ));
    }

    public function update(
        Request $request,
        Aporte $aporte
    ): RedirectResponse {
        $comunidades = Comunidad::query()
            ->orderBy('id_comunidad')
            ->get()
            ->unique('id_comunidad')
            ->values();

        $reglas = $this->reglasAporte();

        foreach ($comunidades as $comunidad) {
            $reglas[
                "montos.{$comunidad->id_comunidad}"
            ] = [
                'required',
                'numeric',
                'min:0.01',
                'max:99999999.99',
            ];
        }

        $mensajes = $this->mensajesValidacion();

        foreach ($comunidades as $comunidad) {
            $mensajes[
                "montos.{$comunidad->id_comunidad}.required"
            ] = "Debe ingresar el monto para {$comunidad->nombre}.";

            $mensajes[
                "montos.{$comunidad->id_comunidad}.numeric"
            ] = "El monto de {$comunidad->nombre} debe ser numérico.";

            $mensajes[
                "montos.{$comunidad->id_comunidad}.min"
            ] = "El monto de {$comunidad->nombre} debe ser mayor que cero.";

            $mensajes[
                "montos.{$comunidad->id_comunidad}.max"
            ] = "El monto de {$comunidad->nombre} es demasiado elevado.";
        }

        $datos = $request->validate(
            $reglas,
            $mensajes
        );

        try {
            DB::transaction(function () use (
                $datos,
                $aporte,
                $comunidades
            ) {
                $primeraComunidad = $comunidades->first();

                $montoReferencia = $datos['montos'][
                    $primeraComunidad->id_comunidad
                ];

                $aporte->update([
                    'id_tipo_aporte' =>
                        $datos['id_tipo_aporte'],
                    'concepto' =>
                        $datos['concepto'],
                    'monto' =>
                        $montoReferencia,
                    'fecha_creacion' =>
                        $datos['fecha_creacion'],
                    'fecha_vencimiento' =>
                        $datos['fecha_vencimiento'],
                ]);

                foreach ($comunidades as $comunidad) {
                    $monto = $datos['montos'][
                        $comunidad->id_comunidad
                    ];

                    AporteComunidad::updateOrCreate(
                        [
                            'id_aporte' =>
                                $aporte->id_aporte,
                            'id_comunidad' =>
                                $comunidad->id_comunidad,
                        ],
                        [
                            'monto' => $monto,
                        ]
                    );
                }

                $asignaciones = AporteComunario::query()
                    ->where(
                        'id_aporte',
                        $aporte->id_aporte
                    )
                    ->with('comunario')
                    ->get();

                foreach ($asignaciones as $asignacion) {
                    if (
                        $asignacion->estado_pago !==
                        'pendiente'
                    ) {
                        continue;
                    }

                    if (!$asignacion->comunario) {
                        continue;
                    }

                    $idComunidad = $asignacion
                        ->comunario
                        ->id_comunidad;

                    if (
                        !array_key_exists(
                            $idComunidad,
                            $datos['montos']
                        )
                    ) {
                        continue;
                    }

                    $nuevoMonto = $datos['montos'][
                        $idComunidad
                    ];

                    $asignacion->update([
                        'monto_asignado' =>
                            $nuevoMonto,
                        'saldo' =>
                            $nuevoMonto,
                    ]);
                }
            });
        } catch (Throwable $error) {
            report($error);

            return redirect()
                ->back()
                ->withInput()
                ->withErrors([
                    'general' =>
                        'No se pudo actualizar el aporte. Verifique los datos e inténtelo nuevamente.',
                ]);
        }

        return redirect()
            ->route('aportes.show', $aporte)
            ->with(
                'exito',
                'El aporte fue actualizado correctamente.'
            );
    }

    public function cambiarEstado(
        Aporte $aporte
    ): RedirectResponse {
        $nuevoEstado = $aporte->estado === 'activo'
            ? 'inactivo'
            : 'activo';

        $aporte->update([
            'estado' => $nuevoEstado,
        ]);

        $mensaje = $nuevoEstado === 'activo'
            ? 'El aporte fue activado correctamente.'
            : 'El aporte fue desactivado correctamente.';

        return redirect()
            ->route('aportes.index')
            ->with('exito', $mensaje);
    }

    public function guardarTipo(
        Request $request
    ): RedirectResponse {
        $datos = $request->validate(
            [
                'nombre' => [
                    'required',
                    'string',
                    'max:100',
                    'unique:tipos_aportes,nombre',
                ],
                'descripcion' => [
                    'nullable',
                    'string',
                    'max:200',
                ],
            ],
            [
                'nombre.required' =>
                    'El nombre del tipo de aporte es obligatorio.',
                'nombre.unique' =>
                    'Ya existe un tipo de aporte con ese nombre.',
                'nombre.max' =>
                    'El nombre no debe superar los 100 caracteres.',
                'descripcion.max' =>
                    'La descripción no debe superar los 200 caracteres.',
            ]
        );

        TipoAporte::create([
            'nombre' => $datos['nombre'],
            'descripcion' =>
                $datos['descripcion'] ?? null,
            'estado' => true,
        ]);

        return redirect()
            ->route('aportes.create')
            ->with(
                'exito',
                'El tipo de aporte fue registrado correctamente.'
            );
    }

    private function reglasAporte(): array
    {
        return [
            'id_tipo_aporte' => [
                'required',
                'integer',
                Rule::exists(
                    'tipos_aportes',
                    'id_tipo_aporte'
                ),
            ],
            'concepto' => [
                'required',
                'string',
                'max:150',
            ],
            'fecha_creacion' => [
                'required',
                'date',
            ],
            'fecha_vencimiento' => [
                'required',
                'date',
                'after_or_equal:fecha_creacion',
            ],
            'montos' => [
                'required',
                'array',
            ],
        ];
    }

    private function mensajesValidacion(): array
    {
        return [
            'id_tipo_aporte.required' =>
                'Debe seleccionar un tipo de aporte.',
            'id_tipo_aporte.exists' =>
                'El tipo de aporte seleccionado no es válido.',
            'concepto.required' =>
                'El concepto del aporte es obligatorio.',
            'concepto.max' =>
                'El concepto no debe superar los 150 caracteres.',
            'fecha_creacion.required' =>
                'La fecha de creación es obligatoria.',
            'fecha_creacion.date' =>
                'La fecha de creación no es válida.',
            'fecha_vencimiento.required' =>
                'La fecha de vencimiento es obligatoria.',
            'fecha_vencimiento.date' =>
                'La fecha de vencimiento no es válida.',
            'fecha_vencimiento.after_or_equal' =>
                'La fecha de vencimiento no puede ser anterior a la fecha de creación.',
            'montos.required' =>
                'Debe ingresar los montos de las comunidades.',
            'montos.array' =>
                'Los montos de las comunidades no son válidos.',
        ];
    }
}