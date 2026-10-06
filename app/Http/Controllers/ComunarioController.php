<?php

namespace App\Http\Controllers;

use App\Models\Comunidad;
use App\Models\Comunario;
use App\Models\Usuario;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ComunarioController extends Controller
{
    public function index(Request $request): View
    {
        $buscar = trim((string) $request->input('buscar'));
        $idComunidad = $request->input('id_comunidad');

        if (!$idComunidad) {
            return redirect()->route('comunidades.index');
        }

        $comunidades = Comunidad::query()
            ->withCount('comunarios')
            ->orderBy('id_comunidad')
            ->get();

        $comunidadSeleccionada = $comunidades->firstWhere(
            'id_comunidad',
            (int) $idComunidad
        );

        if (!$comunidadSeleccionada) {
            return redirect()->route('comunidades.index');
        }

        $comunarios = Comunario::query()
            ->with(['usuario', 'comunidad'])
            ->where(
                'id_comunidad',
                $comunidadSeleccionada->id_comunidad
            )
            ->when($buscar, function ($consulta) use ($buscar) {
                $consulta->where(function ($q) use ($buscar) {
                    $q->where('ci', 'like', "%{$buscar}%")
                        ->orWhere(
                            'nombres',
                            'like',
                            "%{$buscar}%"
                        )
                        ->orWhere(
                            'apellidos',
                            'like',
                            "%{$buscar}%"
                        )
                        ->orWhereHas(
                            'usuario',
                            function ($usuario) use ($buscar) {
                                $usuario->where(
                                    'usuario',
                                    'like',
                                    "%{$buscar}%"
                                );
                            }
                        );
                });
            })
            ->orderBy('numero_comunidad')
            ->paginate(100)
            ->withQueryString();

        return view('comunarios.index', compact(
            'comunidades',
            'comunidadSeleccionada',
            'comunarios',
            'buscar',
            'idComunidad'
        ));
    }

    public function create(): View
    {
        $comunidades = Comunidad::query()
            ->where('estado', true)
            ->orderBy('id_comunidad')
            ->get();

        return view('comunarios.create', compact('comunidades'));
    }

    public function store(Request $request): RedirectResponse
    {
        $datos = $request->validate([
            'id_comunidad' => [
                'required',
                'integer',
                Rule::exists('comunidades', 'id_comunidad')
                    ->where('estado', true),
            ],
            'ci' => [
                'required',
                'string',
                'max:20',
                'unique:comunarios,ci',
            ],
            'nombres' => [
                'required',
                'string',
                'max:100',
            ],
            'apellidos' => [
                'required',
                'string',
                'max:100',
            ],
            'telefono' => [
                'nullable',
                'string',
                'max:20',
            ],
            'direccion' => [
                'nullable',
                'string',
                'max:150',
            ],
            'usuario' => [
                'required',
                'string',
                'max:50',
                'unique:usuarios,usuario',
            ],
            'contrasena' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],
        ]);

        DB::transaction(function () use ($datos) {
            Comunidad::query()
                ->where(
                    'id_comunidad',
                    $datos['id_comunidad']
                )
                ->lockForUpdate()
                ->firstOrFail();

            $ultimoNumero = Comunario::query()
                ->where(
                    'id_comunidad',
                    $datos['id_comunidad']
                )
                ->max('numero_comunidad');

            $numeroComunidad = ((int) $ultimoNumero) + 1;

            $usuario = Usuario::create([
                'nombre_completo' =>
                    $datos['nombres'].' '.$datos['apellidos'],
                'usuario' => $datos['usuario'],
                'contrasena' => $datos['contrasena'],
                'rol' => 'comunario',
                'estado' => true,
            ]);

            Comunario::create([
                'id_usuario' => $usuario->id_usuario,
                'id_comunidad' => $datos['id_comunidad'],
                'numero_comunidad' => $numeroComunidad,
                'ci' => $datos['ci'],
                'nombres' => $datos['nombres'],
                'apellidos' => $datos['apellidos'],
                'telefono' => $datos['telefono'] ?? null,
                'direccion' => $datos['direccion'] ?? null,
                'estado' => true,
            ]);
        });

        return redirect()
            ->route('comunarios.index', [
                'id_comunidad' => $datos['id_comunidad'],
            ])
            ->with(
                'exito',
                'El comunario fue registrado correctamente.'
            );
    }

    public function show(Comunario $comunario): View
    {
        $comunario->load(['usuario', 'comunidad']);

        return view('comunarios.show', compact('comunario'));
    }

    public function edit(Comunario $comunario): View
    {
        $comunario->load(['usuario', 'comunidad']);

        $comunidades = Comunidad::query()
            ->where('estado', true)
            ->orderBy('id_comunidad')
            ->get();

        return view('comunarios.edit', compact(
            'comunario',
            'comunidades'
        ));
    }

    public function update(
        Request $request,
        Comunario $comunario
    ): RedirectResponse {
        $datos = $request->validate([
            'id_comunidad' => [
                'required',
                'integer',
                Rule::exists('comunidades', 'id_comunidad')
                    ->where('estado', true),
            ],
            'ci' => [
                'required',
                'string',
                'max:20',
                Rule::unique('comunarios', 'ci')
                    ->ignore(
                        $comunario->id_comunario,
                        'id_comunario'
                    ),
            ],
            'nombres' => [
                'required',
                'string',
                'max:100',
            ],
            'apellidos' => [
                'required',
                'string',
                'max:100',
            ],
            'telefono' => [
                'nullable',
                'string',
                'max:20',
            ],
            'direccion' => [
                'nullable',
                'string',
                'max:150',
            ],
            'usuario' => [
                'required',
                'string',
                'max:50',
                Rule::unique('usuarios', 'usuario')
                    ->ignore(
                        $comunario->id_usuario,
                        'id_usuario'
                    ),
            ],
            'contrasena' => [
                'nullable',
                'string',
                'min:8',
                'confirmed',
            ],
        ]);

        DB::transaction(function () use ($datos, $comunario) {
            $comunarioActual = Comunario::query()
                ->with('usuario')
                ->lockForUpdate()
                ->findOrFail($comunario->id_comunario);

            $comunidadAnterior =
                (int) $comunarioActual->id_comunidad;

            $comunidadNueva =
                (int) $datos['id_comunidad'];

            $numeroComunidad =
                (int) $comunarioActual->numero_comunidad;

            if ($comunidadAnterior !== $comunidadNueva) {
                Comunidad::query()
                    ->whereIn('id_comunidad', [
                        $comunidadAnterior,
                        $comunidadNueva,
                    ])
                    ->orderBy('id_comunidad')
                    ->lockForUpdate()
                    ->get();

                $ultimoNumero = Comunario::query()
                    ->where(
                        'id_comunidad',
                        $comunidadNueva
                    )
                    ->max('numero_comunidad');

                $numeroComunidad =
                    ((int) $ultimoNumero) + 1;
            }

            $datosUsuario = [
                'nombre_completo' =>
                    $datos['nombres'].' '.$datos['apellidos'],
                'usuario' => $datos['usuario'],
            ];

            if (!empty($datos['contrasena'])) {
                $datosUsuario['contrasena'] =
                    $datos['contrasena'];
            }

            $comunarioActual->usuario->update(
                $datosUsuario
            );

            $comunarioActual->update([
                'id_comunidad' => $comunidadNueva,
                'numero_comunidad' => $numeroComunidad,
                'ci' => $datos['ci'],
                'nombres' => $datos['nombres'],
                'apellidos' => $datos['apellidos'],
                'telefono' => $datos['telefono'] ?? null,
                'direccion' => $datos['direccion'] ?? null,
            ]);

            if ($comunidadAnterior !== $comunidadNueva) {
                $comunariosAnteriores = Comunario::query()
                    ->where(
                        'id_comunidad',
                        $comunidadAnterior
                    )
                    ->orderBy('numero_comunidad')
                    ->orderBy('id_comunario')
                    ->lockForUpdate()
                    ->get();

                foreach (
                    $comunariosAnteriores as $indice => $registro
                ) {
                    $nuevoNumero = $indice + 1;

                    if (
                        (int) $registro->numero_comunidad
                        !== $nuevoNumero
                    ) {
                        $registro->update([
                            'numero_comunidad' => $nuevoNumero,
                        ]);
                    }
                }
            }
        });

        return redirect()
            ->route('comunarios.index', [
                'id_comunidad' => $datos['id_comunidad'],
            ])
            ->with(
                'exito',
                'Los datos fueron actualizados correctamente.'
            );
    }

    public function cambiarEstado(
        Comunario $comunario
    ): RedirectResponse {
        DB::transaction(function () use ($comunario) {
            $nuevoEstado = !$comunario->estado;

            $comunario->update([
                'estado' => $nuevoEstado,
            ]);

            $comunario->usuario->update([
                'estado' => $nuevoEstado,
            ]);
        });

        return redirect()
            ->route('comunarios.index', [
                'id_comunidad' => $comunario->id_comunidad,
            ])
            ->with(
                'exito',
                'El estado del comunario fue actualizado.'
            );
    }
}