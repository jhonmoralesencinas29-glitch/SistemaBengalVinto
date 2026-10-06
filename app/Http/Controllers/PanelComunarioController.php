<?php

namespace App\Http\Controllers;

use App\Models\Comunario;
use App\Models\Pago;
use App\Models\Reunion;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PanelComunarioController extends Controller
{
    private function obtenerComunario(): Comunario
    {
        $comunario = Auth::user()
            ->comunario()
            ->with('comunidad')
            ->first();

        if (!$comunario) {
            abort(
                403,
                'El usuario no tiene un comunario asociado.'
            );
        }

        return $comunario;
    }

    public function index(): View
    {
        $comunario = $this->obtenerComunario();

        $asignaciones = $comunario
            ->aportesComunarios()
            ->get();

        $totalAportes = $asignaciones->count();

        $totalAsignado = (float) $asignaciones
            ->sum('monto_asignado');

        $saldoPendiente = (float) $asignaciones
            ->sum('saldo');

        $totalPagado = round(
            $totalAsignado - $saldoPendiente,
            2
        );

        return view('comunario.panel', compact(
            'comunario',
            'totalAportes',
            'totalAsignado',
            'totalPagado',
            'saldoPendiente'
        ));
    }

    public function aportes(): View
    {
        $comunario = $this->obtenerComunario();

        $aportes = $comunario
            ->aportesComunarios()
            ->with([
                'aporte.tipoAporte',
                'pagos.comprobante',
            ])
            ->orderByDesc('id_aporte_comunario')
            ->paginate(10);

        return view('comunario.aportes', compact(
            'comunario',
            'aportes'
        ));
    }

    public function pagos(): View
    {
        $comunario = $this->obtenerComunario();

        $pagos = Pago::query()
            ->with([
                'aporteComunario.aporte.tipoAporte',
                'comprobante',
            ])
            ->whereHas(
                'aporteComunario',
                function ($consulta) use ($comunario) {
                    $consulta->where(
                        'id_comunario',
                        $comunario->id_comunario
                    );
                }
            )
            ->orderByDesc('fecha_pago')
            ->orderByDesc('id_pago')
            ->paginate(10);

        return view('comunario.pagos', compact(
            'comunario',
            'pagos'
        ));
    }

    public function comprobantes(): View
    {
        $comunario = $this->obtenerComunario();

        $pagos = Pago::query()
            ->with([
                'aporteComunario.aporte',
                'comprobante',
            ])
            ->whereHas(
                'aporteComunario',
                function ($consulta) use ($comunario) {
                    $consulta->where(
                        'id_comunario',
                        $comunario->id_comunario
                    );
                }
            )
            ->whereHas('comprobante')
            ->orderByDesc('fecha_pago')
            ->orderByDesc('id_pago')
            ->paginate(10);

        return view('comunario.comprobantes', compact(
            'comunario',
            'pagos'
        ));
    }

    public function verComprobante(Pago $pago): View
    {
        $comunario = $this->obtenerComunario();

        $pago->load([
            'aporteComunario.aporte.tipoAporte',
            'aporteComunario.comunario.comunidad',
            'usuario',
            'comprobante',
        ]);

        if (
            $pago->aporteComunario->id_comunario !==
            $comunario->id_comunario
        ) {
            abort(
                403,
                'No tienes permiso para ver este comprobante.'
            );
        }

        return view('pagos.comprobante', compact('pago'));
    }

    public function reuniones(): View
    {
        $comunario = $this->obtenerComunario();

        $reuniones = Reunion::query()
            ->with([
                'comunidades',
                'asistencias' => function ($consulta) use ($comunario) {
                    $consulta->where(
                        'id_comunario',
                        $comunario->id_comunario
                    );
                },
            ])
            ->whereHas(
                'comunidades',
                function ($consulta) use ($comunario) {
                    $consulta->where(
                        'comunidades.id_comunidad',
                        $comunario->id_comunidad
                    );
                }
            )
            ->orderByDesc('fecha')
            ->orderByDesc('hora')
            ->paginate(10);

        return view('comunario.reuniones', compact(
            'comunario',
            'reuniones'
        ));
    }

    public function datos(): View
    {
        $comunario = $this->obtenerComunario();

        return view('comunario.datos', compact(
            'comunario'
        ));
    }
}