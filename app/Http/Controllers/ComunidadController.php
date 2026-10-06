<?php

namespace App\Http\Controllers;

use App\Models\Comunidad;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ComunidadController extends Controller
{
    public function index(Request $request): View
    {
        $buscar = trim((string) $request->input('buscar'));

        $comunidades = Comunidad::query()
            ->withCount([
                'comunarios',
                'comunarios as comunarios_activos_count' => function ($consulta) {
                    $consulta->where('estado', true);
                },
            ])
            ->when($buscar, function ($consulta) use ($buscar) {
                $consulta->where('nombre', 'like', "%{$buscar}%");
            })
            ->orderBy('id_comunidad')
            ->get();

        return view('comunidades.index', compact(
            'comunidades',
            'buscar'
        ));
    }
}