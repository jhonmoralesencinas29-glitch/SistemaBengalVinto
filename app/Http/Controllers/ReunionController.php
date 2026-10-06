<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use App\Models\Comunidad;
use App\Models\Comunario;
use App\Models\Reunion;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class ReunionController extends Controller
{
    public function index(Request $request): View
    {
        $buscar = trim((string) $request->input('buscar'));
        $estado = $request->input('estado');

        $reuniones = Reunion::query()
            ->with('comunidades')
            ->withCount([
                'asistencias as presentes_count' =>
                    fn ($consulta) => $consulta->where(
                        'estado_asistencia',
                        'presente'
                    ),

                'asistencias as retrasos_count' =>
                    fn ($consulta) => $consulta->where(
                        'estado_asistencia',
                        'retraso'
                    ),

                'asistencias as faltas_count' =>
                    fn ($consulta) => $consulta->where(
                        'estado_asistencia',
                        'falta'
                    ),

                'asistencias as licencias_count' =>
                    fn ($consulta) => $consulta->where(
                        'estado_asistencia',
                        'licencia'
                    ),
            ])
            ->when($buscar !== '', function ($consulta) use ($buscar) {
                $consulta->where(function ($q) use ($buscar) {
                    $q->where(
                        'descripcion',
                        'like',
                        "%{$buscar}%"
                    )
                    ->orWhere(
                        'lugar',
                        'like',
                        "%{$buscar}%"
                    )
                    ->orWhereHas(
                        'comunidades',
                        function ($comunidad) use ($buscar) {
                            $comunidad->where(
                                'nombre',
                                'like',
                                "%{$buscar}%"
                            );
                        }
                    );
                });
            })
            ->when(
                $estado,
                fn ($consulta) => $consulta->where(
                    'estado',
                    $estado
                )
            )
            ->orderByDesc('fecha')
            ->orderByDesc('hora')
            ->orderByDesc('id_reunion')
            ->paginate(10)
            ->withQueryString();

        $totalReuniones = Reunion::query()->count();

        $programadas = Reunion::query()
            ->where('estado', 'programada')
            ->count();

        $realizadas = Reunion::query()
            ->where('estado', 'realizada')
            ->count();

        $canceladas = Reunion::query()
            ->where('estado', 'cancelada')
            ->count();

        return view('reuniones.index', compact(
            'reuniones',
            'buscar',
            'estado',
            'totalReuniones',
            'programadas',
            'realizadas',
            'canceladas'
        ));
    }

    public function create(): View
    {
        $comunidades = Comunidad::query()
            ->where('estado', true)
            ->withCount([
                'comunarios as comunarios_activos_count' =>
                    fn ($consulta) => $consulta->where(
                        'estado',
                        true
                    ),
            ])
            ->orderBy('nombre')
            ->get();

        return view(
            'reuniones.create',
            compact('comunidades')
        );
    }

    public function store(Request $request): RedirectResponse
    {
        $datos = $request->validate([
            'descripcion' => [
                'required',
                'string',
                'max:20000',
            ],
            'fecha' => [
                'required',
                'date',
            ],
            'hora' => [
                'required',
                'date_format:H:i',
            ],
            'lugar' => [
                'required',
                'string',
                'max:150',
            ],
            'id_comunidades' => [
                'required',
                'array',
                'min:1',
            ],
            'id_comunidades.*' => [
                'required',
                'integer',
                'distinct',
                'exists:comunidades,id_comunidad',
            ],
        ], [
            'descripcion.required' =>
                'Escribe el motivo o descripción de la reunión.',

            'descripcion.string' =>
                'La descripción de la reunión no es válida.',

            'descripcion.max' =>
                'La descripción no puede superar los 20.000 caracteres.',

            'fecha.required' =>
                'Selecciona la fecha de la reunión.',

            'fecha.date' =>
                'La fecha seleccionada no es válida.',

            'hora.required' =>
                'Selecciona la hora de la reunión.',

            'hora.date_format' =>
                'La hora seleccionada no es válida.',

            'lugar.required' =>
                'Escribe el lugar de la reunión.',

            'lugar.string' =>
                'El lugar de la reunión no es válido.',

            'lugar.max' =>
                'El lugar no puede superar los 150 caracteres.',

            'id_comunidades.required' =>
                'Selecciona al menos una comunidad.',

            'id_comunidades.array' =>
                'La selección de comunidades no es válida.',

            'id_comunidades.min' =>
                'Selecciona al menos una comunidad.',

            'id_comunidades.*.distinct' =>
                'No puedes seleccionar dos veces la misma comunidad.',

            'id_comunidades.*.exists' =>
                'Una de las comunidades seleccionadas no existe.',
        ]);

        $reunion = DB::transaction(function () use ($datos) {
            $reunion = Reunion::create([
                'descripcion' => $datos['descripcion'],
                'fecha' => $datos['fecha'],
                'hora' => $datos['hora'],
                'lugar' => $datos['lugar'],
                'estado' => 'programada',
            ]);

            $reunion->comunidades()->attach(
                $datos['id_comunidades']
            );

            return $reunion;
        });

        return redirect()
            ->route('reuniones.show', $reunion)
            ->with(
                'exito',
                'La reunión fue registrada correctamente.'
            );
    }

    public function show(Reunion $reunion): View
    {
        $reunion->load([
            'comunidades',
            'asistencias.comunario.comunidad',
        ]);

        $idsComunidades = $reunion->comunidades
            ->pluck('id_comunidad');

        $totalConvocados = Comunario::query()
            ->where('estado', true)
            ->whereIn('id_comunidad', $idsComunidades)
            ->count();

        $resumenAsistencia = [
            'registrados' => $reunion->asistencias->count(),

            'presentes' => $reunion->asistencias
                ->where('estado_asistencia', 'presente')
                ->count(),

            'retrasos' => $reunion->asistencias
                ->where('estado_asistencia', 'retraso')
                ->count(),

            'faltas' => $reunion->asistencias
                ->where('estado_asistencia', 'falta')
                ->count(),

            'licencias' => $reunion->asistencias
                ->where('estado_asistencia', 'licencia')
                ->count(),
        ];

        return view('reuniones.show', compact(
            'reunion',
            'totalConvocados',
            'resumenAsistencia'
        ));
    }

    public function edit(Reunion $reunion): View
    {
        $reunion->load('comunidades');

        $comunidades = Comunidad::query()
            ->where('estado', true)
            ->withCount([
                'comunarios as comunarios_activos_count' =>
                    fn ($consulta) => $consulta->where(
                        'estado',
                        true
                    ),
            ])
            ->orderBy('nombre')
            ->get();

        $comunidadesSeleccionadas = $reunion->comunidades
            ->pluck('id_comunidad')
            ->map(fn ($id) => (int) $id)
            ->all();

        return view('reuniones.edit', compact(
            'reunion',
            'comunidades',
            'comunidadesSeleccionadas'
        ));
    }

    public function update(
        Request $request,
        Reunion $reunion
    ): RedirectResponse {
        $datos = $request->validate([
            'descripcion' => [
                'required',
                'string',
                'max:20000',
            ],
            'fecha' => [
                'required',
                'date',
            ],
            'hora' => [
                'required',
                'date_format:H:i',
            ],
            'lugar' => [
                'required',
                'string',
                'max:150',
            ],
            'estado' => [
                'required',
                'in:programada,realizada,cancelada',
            ],
            'id_comunidades' => [
                'required',
                'array',
                'min:1',
            ],
            'id_comunidades.*' => [
                'required',
                'integer',
                'distinct',
                'exists:comunidades,id_comunidad',
            ],
        ], [
            'descripcion.required' =>
                'Escribe el motivo o descripción de la reunión.',

            'descripcion.string' =>
                'La descripción de la reunión no es válida.',

            'descripcion.max' =>
                'La descripción no puede superar los 20.000 caracteres.',

            'fecha.required' =>
                'Selecciona la fecha de la reunión.',

            'fecha.date' =>
                'La fecha seleccionada no es válida.',

            'hora.required' =>
                'Selecciona la hora de la reunión.',

            'hora.date_format' =>
                'La hora seleccionada no es válida.',

            'lugar.required' =>
                'Escribe el lugar de la reunión.',

            'lugar.string' =>
                'El lugar de la reunión no es válido.',

            'lugar.max' =>
                'El lugar no puede superar los 150 caracteres.',

            'estado.required' =>
                'Selecciona el estado de la reunión.',

            'estado.in' =>
                'El estado seleccionado no es válido.',

            'id_comunidades.required' =>
                'Selecciona al menos una comunidad.',

            'id_comunidades.array' =>
                'La selección de comunidades no es válida.',

            'id_comunidades.min' =>
                'Selecciona al menos una comunidad.',

            'id_comunidades.*.distinct' =>
                'No puedes seleccionar dos veces la misma comunidad.',

            'id_comunidades.*.exists' =>
                'Una de las comunidades seleccionadas no existe.',
        ]);

        $idsActuales = $reunion->comunidades()
            ->pluck('comunidades.id_comunidad')
            ->map(fn ($id) => (int) $id)
            ->sort()
            ->values();

        $idsNuevos = collect($datos['id_comunidades'])
            ->map(fn ($id) => (int) $id)
            ->unique()
            ->sort()
            ->values();

        if (
            $reunion->asistencias()->exists() &&
            $idsActuales->all() !== $idsNuevos->all()
        ) {
            throw ValidationException::withMessages([
                'id_comunidades' =>
                    'No se pueden cambiar las comunidades porque la reunión ya tiene una asistencia registrada.',
            ]);
        }

        DB::transaction(function () use (
            $datos,
            $reunion,
            $idsNuevos
        ) {
            $reunion->update([
                'descripcion' => $datos['descripcion'],
                'fecha' => $datos['fecha'],
                'hora' => $datos['hora'],
                'lugar' => $datos['lugar'],
                'estado' => $datos['estado'],
            ]);

            $reunion->comunidades()->sync(
                $idsNuevos->all()
            );
        });

        return redirect()
            ->route('reuniones.show', $reunion)
            ->with(
                'exito',
                'La reunión fue actualizada correctamente.'
            );
    }

    public function asistencia(Reunion $reunion): View
    {
        $reunion->load('comunidades');

        $idsComunidades = $reunion->comunidades
            ->pluck('id_comunidad');

        $comunarios = Comunario::query()
            ->with('comunidad')
            ->where('estado', true)
            ->whereIn('id_comunidad', $idsComunidades)
            ->orderBy('id_comunidad')
            ->orderBy('apellidos')
            ->orderBy('nombres')
            ->get();

        $asistencias = $reunion->asistencias()
            ->get()
            ->keyBy('id_comunario');

        return view('reuniones.asistencia', compact(
            'reunion',
            'comunarios',
            'asistencias'
        ));
    }

    public function guardarAsistencia(
        Request $request,
        Reunion $reunion
    ): RedirectResponse {
        $datos = $request->validate([
            'asistencias' => [
                'required',
                'array',
            ],
            'asistencias.*.estado_asistencia' => [
                'required',
                'in:presente,retraso,falta,licencia',
            ],
            'asistencias.*.observacion' => [
                'nullable',
                'string',
                'max:200',
            ],
        ], [
            'asistencias.required' =>
                'Debes registrar la asistencia de los comunarios.',

            'asistencias.array' =>
                'La información de asistencia no es válida.',

            'asistencias.*.estado_asistencia.required' =>
                'Selecciona el estado de asistencia de cada comunario.',

            'asistencias.*.estado_asistencia.in' =>
                'Uno de los estados de asistencia no es válido.',

            'asistencias.*.observacion.string' =>
                'Una de las observaciones no es válida.',

            'asistencias.*.observacion.max' =>
                'Cada observación puede tener como máximo 200 caracteres.',
        ]);

        $reunion->load('comunidades');

        $idsComunidades = $reunion->comunidades
            ->pluck('id_comunidad');

        $idsValidos = Comunario::query()
            ->where('estado', true)
            ->whereIn('id_comunidad', $idsComunidades)
            ->pluck('id_comunario')
            ->map(fn ($id) => (int) $id)
            ->sort()
            ->values();

        $idsRecibidos = collect(
            array_keys($datos['asistencias'])
        )
            ->map(fn ($id) => (int) $id)
            ->unique()
            ->sort()
            ->values();

        if (
            $idsValidos->all() !==
            $idsRecibidos->all()
        ) {
            throw ValidationException::withMessages([
                'asistencias' =>
                    'La lista de comunarios no coincide con las comunidades convocadas.',
            ]);
        }

        DB::transaction(function () use (
            $datos,
            $reunion,
            $idsValidos
        ) {
            foreach ($idsValidos as $idComunario) {
                $registro =
                    $datos['asistencias'][$idComunario];

                Asistencia::updateOrCreate(
                    [
                        'id_reunion' =>
                            $reunion->id_reunion,

                        'id_comunario' =>
                            $idComunario,
                    ],
                    [
                        'estado_asistencia' =>
                            $registro['estado_asistencia'],

                        'observacion' =>
                            $registro['observacion']
                            ?? null,
                    ]
                );
            }

            $reunion->update([
                'estado' => 'realizada',
            ]);
        });

        return redirect()
            ->route('reuniones.show', $reunion)
            ->with(
                'exito',
                'La asistencia fue guardada correctamente.'
            );
    }

    public function cambiarEstado(
        Request $request,
        Reunion $reunion
    ): RedirectResponse {
        $datos = $request->validate([
            'estado' => [
                'required',
                'in:programada,realizada,cancelada',
            ],
        ], [
            'estado.required' =>
                'Selecciona el estado de la reunión.',

            'estado.in' =>
                'El estado seleccionado no es válido.',
        ]);

        $reunion->update([
            'estado' => $datos['estado'],
        ]);

        return back()->with(
            'exito',
            'El estado de la reunión fue actualizado.'
        );
    }

    public function imprimir(Reunion $reunion): View
    {
        $reunion->load([
            'comunidades',
            'asistencias.comunario.comunidad',
        ]);

        return view(
            'reuniones.imprimir',
            compact('reunion')
        );
    }
}