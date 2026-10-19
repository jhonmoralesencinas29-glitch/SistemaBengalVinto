<?php

use App\Http\Controllers\AporteController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ComunidadController;
use App\Http\Controllers\ComunarioController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\PanelComunarioController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\RespaldoController;
use App\Http\Controllers\ReunionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('guest')->group(function () {
    Route::get(
        '/login',
        [AuthController::class, 'mostrarLogin']
    )->name('login');

    Route::post(
        '/login',
        [AuthController::class, 'iniciarSesion']
    )->name('login.iniciar');
});

Route::middleware('auth')->group(function () {
    Route::middleware('rol:comunario')->group(function () {
        Route::get(
            '/mi-panel',
            [PanelComunarioController::class, 'index']
        )->name('comunario.panel');

        Route::get(
            '/mis-aportes',
            [PanelComunarioController::class, 'aportes']
        )->name('comunario.aportes');

        Route::get(
            '/mis-pagos',
            [PanelComunarioController::class, 'pagos']
        )->name('comunario.pagos');

        Route::get(
            '/mis-comprobantes',
            [PanelComunarioController::class, 'comprobantes']
        )->name('comunario.comprobantes');

        Route::get(
            '/mis-comprobantes/{pago}/pdf',
            [PanelComunarioController::class, 'descargarComprobante']
        )->name('comunario.comprobante.pdf');

        Route::get(
            '/mis-comprobantes/{pago}',
            [PanelComunarioController::class, 'verComprobante']
        )->name('comunario.comprobante');

        Route::get(
            '/mis-reuniones',
            [PanelComunarioController::class, 'reuniones']
        )->name('comunario.reuniones');

        Route::get(
            '/mis-datos',
            [PanelComunarioController::class, 'datos']
        )->name('comunario.datos');
    });

    Route::middleware('rol:administrador')->group(function () {
        Route::get(
            '/dashboard',
            [DashboardController::class, 'index']
        )->name('dashboard');

        Route::get(
            '/comunidades',
            [ComunidadController::class, 'index']
        )->name('comunidades.index');

        Route::patch(
            '/comunarios/{comunario}/estado',
            [ComunarioController::class, 'cambiarEstado']
        )->name('comunarios.estado');

        Route::resource(
            'comunarios',
            ComunarioController::class
        )
            ->parameters([
                'comunarios' => 'comunario',
            ])
            ->only([
                'index',
                'create',
                'store',
                'show',
                'edit',
                'update',
            ]);

        Route::post(
            '/aportes/tipos',
            [AporteController::class, 'guardarTipo']
        )->name('aportes.tipos.store');

        Route::patch(
            '/aportes/{aporte}/estado',
            [AporteController::class, 'cambiarEstado']
        )->name('aportes.estado');

        Route::resource(
            'aportes',
            AporteController::class
        )
            ->parameters([
                'aportes' => 'aporte',
            ])
            ->only([
                'index',
                'create',
                'store',
                'show',
                'edit',
                'update',
            ]);

        Route::get(
            '/pagos/{pago}/comprobante/pdf',
            [PagoController::class, 'descargarComprobante']
        )->name('pagos.comprobante.pdf');

        Route::get(
            '/pagos/{pago}/comprobante',
            [PagoController::class, 'comprobante']
        )->name('pagos.comprobante');

        Route::resource(
            'pagos',
            PagoController::class
        )
            ->parameters([
                'pagos' => 'pago',
            ])
            ->only([
                'index',
                'create',
                'store',
                'show',
            ]);

        Route::get(
            '/reuniones/{reunion}/asistencia',
            [ReunionController::class, 'asistencia']
        )->name('reuniones.asistencia');

        Route::put(
            '/reuniones/{reunion}/asistencia',
            [ReunionController::class, 'guardarAsistencia']
        )->name('reuniones.asistencia.guardar');

        Route::patch(
            '/reuniones/{reunion}/estado',
            [ReunionController::class, 'cambiarEstado']
        )->name('reuniones.estado');

        Route::get(
            '/reuniones/{reunion}/imprimir',
            [ReunionController::class, 'imprimir']
        )->name('reuniones.imprimir');

        Route::resource(
            'reuniones',
            ReunionController::class
        )
            ->parameters([
                'reuniones' => 'reunion',
            ])
            ->only([
                'index',
                'create',
                'store',
                'show',
                'edit',
                'update',
            ]);

        Route::get(
            '/respaldos/descargar',
            [RespaldoController::class, 'descargar']
        )->name('respaldos.descargar');

        Route::get(
            '/reportes/imprimir',
            [ReporteController::class, 'imprimir']
        )->name('reportes.imprimir');

        Route::get(
            '/reportes/pdf',
            [ReporteController::class, 'descargarPdf']
        )->name('reportes.pdf');

        Route::get(
            '/reportes',
            [ReporteController::class, 'index']
        )->name('reportes.index');
    });

    Route::post(
        '/logout',
        [AuthController::class, 'cerrarSesion']
    )->name('logout');
});