@extends('layouts.app')

@section('titulo', 'Detalle del aporte')
@section('encabezado', 'Aportes')

@push('estilos')
<style>
    .pagina-aporte {
        width: 100%;
        max-width: 1250px;
        margin: 0 auto;
        color: #202124;
    }

    .encabezado-aporte {
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
    }

    .encabezado-aporte h2 {
        margin: 0 0 6px;
        color: #202124;
        font-size: 27px;
        font-weight: normal;
    }

    .encabezado-aporte p {
        margin: 0;
        color: #4b5563;
        font-size: 15px;
        font-weight: normal;
        line-height: 1.5;
    }

    .acciones-superiores {
        display: flex;
        gap: 10px;
    }

    .boton {
        min-height: 44px;
        padding: 0 18px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 7px;
        font-size: 14px;
        font-weight: normal;
        text-decoration: none;
        box-sizing: border-box;
    }

    .boton-volver {
        border: 1px solid #cbd5e1;
        color: #202124;
        background: #ffffff;
    }

    .boton-volver:hover {
        background: #f3f4f6;
    }

    .boton-editar {
        border: 1px solid #1669c1;
        color: #ffffff;
        background: #1669c1;
    }

    .boton-editar:hover {
        border-color: #1259a6;
        background: #1259a6;
    }

    .seccion {
        margin-bottom: 22px;
        overflow: hidden;
        border: 1px solid #d7dce2;
        border-radius: 10px;
        background: #ffffff;
    }

    .seccion-titulo {
        padding: 20px 24px;
        border-bottom: 1px solid #d7dce2;
        background: #f8fafc;
    }

    .seccion-titulo h3 {
        margin: 0 0 5px;
        color: #202124;
        font-size: 19px;
        font-weight: normal;
    }

    .seccion-titulo p {
        margin: 0;
        color: #4b5563;
        font-size: 13px;
        font-weight: normal;
        line-height: 1.5;
    }

    .informacion {
        padding: 24px;
        display: grid;
        grid-template-columns: repeat(5, minmax(0, 1fr));
        gap: 24px;
    }

    .dato span {
        display: block;
        margin-bottom: 7px;
        color: #5f6368;
        font-size: 12px;
        font-weight: normal;
        text-transform: uppercase;
    }

    .dato strong {
        color: #202124;
        font-size: 15px;
        font-weight: normal;
        line-height: 1.4;
        overflow-wrap: anywhere;
    }

    .estado {
        display: inline-block;
        padding: 6px 12px;
        border: 1px solid #c8cdd3;
        border-radius: 20px;
        color: #202124;
        background: #f7f8fa;
        font-size: 12px !important;
        font-weight: normal !important;
    }

    .estado-activo {
        border-color: #b9d8c2;
        color: #245c34 !important;
        background: #f4faf6;
    }

    .estado-inactivo {
        border-color: #d1d5db;
        color: #4b5563 !important;
        background: #f7f8fa;
    }

    .resumen-dinero {
        padding: 24px;
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 18px;
    }

    .tarjeta-dinero {
        min-height: 125px;
        padding: 21px;
        border: 1px solid #d7dce2;
        border-radius: 10px;
        background: #ffffff;
        box-sizing: border-box;
    }

    .tarjeta-dinero h4 {
        margin: 0 0 11px;
        color: #202124;
        font-size: 14px;
        font-weight: normal;
    }

    .tarjeta-dinero strong {
        display: block;
        margin-bottom: 9px;
        color: #202124;
        font-size: 22px;
        font-weight: normal;
    }

    .tarjeta-dinero p {
        margin: 0;
        color: #5f6368;
        font-size: 12px;
        font-weight: normal;
        line-height: 1.5;
    }

    .encabezado-personas {
        padding: 20px 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        border-bottom: 1px solid #d7dce2;
        background: #f8fafc;
    }

    .encabezado-personas h3 {
        margin: 0 0 5px;
        color: #202124;
        font-size: 19px;
        font-weight: normal;
    }

    .encabezado-personas p {
        margin: 0;
        color: #4b5563;
        font-size: 13px;
        font-weight: normal;
        line-height: 1.5;
    }

    .cantidad-personas {
        flex-shrink: 0;
        color: #202124;
        font-size: 14px;
        font-weight: normal;
    }

    .tabla-responsive {
        width: 100%;
        overflow-x: auto;
    }

    .tabla-personas {
        width: 100%;
        min-width: 850px;
        border-collapse: collapse;
    }

    .tabla-personas th {
        padding: 14px 16px;
        border-bottom: 1px solid #d7dce2;
        color: #202124;
        background: #f7f8fa;
        font-size: 12px;
        font-weight: normal;
        text-align: left;
        text-transform: uppercase;
    }

    .tabla-personas td {
        padding: 17px 16px;
        border-bottom: 1px solid #e2e5e9;
        color: #202124;
        font-size: 14px;
        font-weight: normal;
        vertical-align: middle;
    }

    .tabla-personas tbody tr:last-child td {
        border-bottom: none;
    }

    .tabla-personas tbody tr:hover {
        background: #fafafa;
    }

    .nombre-persona {
        color: #202124;
        font-weight: normal;
    }

    .monto {
        color: #202124;
        font-weight: normal;
        white-space: nowrap;
    }

    .estado-pago {
        display: inline-block;
        min-width: 90px;
        padding: 6px 11px;
        border: 1px solid #c8cdd3;
        border-radius: 20px;
        color: #202124;
        background: #f7f8fa;
        font-size: 12px;
        font-weight: normal;
        text-align: center;
    }

    .estado-pagado {
        border-color: #b9d8c2;
        color: #245c34;
        background: #f4faf6;
    }

    .estado-parcial {
        border-color: #d9c99d;
        color: #6b5315;
        background: #fffaf0;
    }

    .estado-pendiente {
        border-color: #d1d5db;
        color: #4b5563;
        background: #f7f8fa;
    }

    .sin-personas {
        padding: 35px 20px !important;
        color: #5f6368 !important;
        text-align: center;
    }

    .control-aporte {
        padding: 21px 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
    }

    .control-aporte h3 {
        margin: 0 0 5px;
        color: #202124;
        font-size: 17px;
        font-weight: normal;
    }

    .control-aporte p {
        margin: 0;
        color: #4b5563;
        font-size: 14px;
        font-weight: normal;
        line-height: 1.5;
    }

    .boton-estado {
        min-height: 44px;
        padding: 0 17px;
        border-radius: 7px;
        background: #ffffff;
        font-family: inherit;
        font-size: 13px;
        font-weight: normal;
        cursor: pointer;
        white-space: nowrap;
    }

    .boton-desactivar {
        border: 1px solid #d9a6a6;
        color: #8b1e1e;
    }

    .boton-desactivar:hover {
        background: #fff5f5;
    }

    .boton-activar {
        border: 1px solid #9fc8aa;
        color: #245c34;
    }

    .boton-activar:hover {
        background: #f3faf5;
    }

    @media (max-width: 1050px) {
        .informacion {
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }
    }

    @media (max-width: 800px) {
        .resumen-dinero {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 700px) {
        .encabezado-aporte {
            align-items: stretch;
            flex-direction: column;
        }

        .acciones-superiores {
            width: 100%;
        }

        .acciones-superiores .boton {
            flex: 1;
        }

        .informacion {
            grid-template-columns: 1fr;
        }

        .encabezado-personas {
            align-items: flex-start;
            flex-direction: column;
        }

        .control-aporte {
            align-items: stretch;
            flex-direction: column;
        }

        .control-aporte form,
        .boton-estado {
            width: 100%;
        }
    }
</style>
@endpush

@section('contenido')
@php
    $cantidadPersonas = $aporte->aportesComunarios->count();

    $totalCobrar = $aporte->aportesComunarios->sum(
        'monto_asignado'
    );

    $totalPendiente = $aporte->aportesComunarios->sum(
        'saldo'
    );

    $totalCobrado = max(
        0,
        $totalCobrar - $totalPendiente
    );
@endphp

<div class="pagina-aporte">
    <div class="encabezado-aporte">
        <div>
            <h2>{{ $aporte->concepto }}</h2>

            <p>
                Consulta quiénes deben aportar y cuánto falta cobrar.
            </p>
        </div>

        <div class="acciones-superiores">
            <a
                href="{{ route('aportes.index') }}"
                class="boton boton-volver"
            >
                Volver
            </a>

            <a
                href="{{ route('aportes.edit', $aporte) }}"
                class="boton boton-editar"
            >
                Editar aporte
            </a>
        </div>
    </div>

    <section class="seccion">
        <div class="seccion-titulo">
            <h3>Información del aporte</h3>

            <p>
                Datos principales del aporte seleccionado.
            </p>
        </div>

        <div class="informacion">
            <div class="dato">
                <span>Nombre</span>

                <strong>
                    {{ $aporte->concepto }}
                </strong>
            </div>

            <div class="dato">
                <span>Tipo de aporte</span>

                <strong>
                    {{ $aporte->tipoAporte?->nombre ?? 'Sin tipo' }}
                </strong>
            </div>

            <div class="dato">
                <span>Fecha de inicio</span>

                <strong>
                    {{ $aporte->fecha_creacion
                        ? $aporte->fecha_creacion->format('d/m/Y')
                        : 'Sin fecha' }}
                </strong>
            </div>

            <div class="dato">
                <span>Fecha límite</span>

                <strong>
                    {{ $aporte->fecha_vencimiento
                        ? $aporte->fecha_vencimiento->format('d/m/Y')
                        : 'Sin fecha' }}
                </strong>
            </div>

            <div class="dato">
                <span>Estado</span>

                <strong
                    class="estado {{ $aporte->estado === 'activo' ? 'estado-activo' : 'estado-inactivo' }}"
                >
                    {{ $aporte->estado === 'activo'
                        ? 'Activo'
                        : 'Inactivo' }}
                </strong>
            </div>
        </div>
    </section>

    <section class="seccion">
        <div class="seccion-titulo">
            <h3>Resumen económico</h3>

            <p>
                Estado general de los montos correspondientes a este aporte.
            </p>
        </div>

        <div class="resumen-dinero">
            <article class="tarjeta-dinero">
                <h4>Total esperado</h4>

                <strong>
                    Bs
                    {{ number_format(
                        $totalCobrar,
                        2,
                        ',',
                        '.'
                    ) }}
                </strong>

                <p>
                    Monto total asignado a todos los comunarios.
                </p>
            </article>

            <article class="tarjeta-dinero">
                <h4>Total recaudado</h4>

                <strong>
                    Bs
                    {{ number_format(
                        $totalCobrado,
                        2,
                        ',',
                        '.'
                    ) }}
                </strong>

                <p>
                    Dinero que ya fue pagado por los comunarios.
                </p>
            </article>

            <article class="tarjeta-dinero">
                <h4>Saldo pendiente</h4>

                <strong>
                    Bs
                    {{ number_format(
                        $totalPendiente,
                        2,
                        ',',
                        '.'
                    ) }}
                </strong>

                <p>
                    Dinero que todavía falta recaudar.
                </p>
            </article>
        </div>
    </section>

    <section class="seccion">
        <div class="encabezado-personas">
            <div>
                <h3>Comunarios asignados</h3>

                <p>
                    Consulte el monto asignado, los pagos y el saldo de cada persona.
                </p>
            </div>

            <span class="cantidad-personas">
                Total de comunarios:
                {{ $cantidadPersonas }}
            </span>
        </div>

        <div class="tabla-responsive">
            <table class="tabla-personas">
                <thead>
                    <tr>
                        <th>Comunario</th>
                        <th>Comunidad</th>
                        <th>Monto asignado</th>
                        <th>Monto pagado</th>
                        <th>Saldo pendiente</th>
                        <th>Estado</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($aporte->aportesComunarios as $asignacion)
                        @php
                            $montoAsignado = (float)
                                $asignacion->monto_asignado;

                            $saldo = (float)
                                $asignacion->saldo;

                            $montoPagado = max(
                                0,
                                $montoAsignado - $saldo
                            );

                            $claseEstado = match (
                                $asignacion->estado_pago
                            ) {
                                'pagado' => 'estado-pagado',
                                'parcial' => 'estado-parcial',
                                default => 'estado-pendiente',
                            };

                            $textoEstado = match (
                                $asignacion->estado_pago
                            ) {
                                'pagado' => 'Pagado',
                                'parcial' => 'Pago parcial',
                                default => 'Pendiente',
                            };
                        @endphp

                        <tr>
                            <td>
                                <span class="nombre-persona">
                                    {{ $asignacion->comunario?->nombres ?? 'Sin nombre' }}
                                    {{ $asignacion->comunario?->apellidos ?? '' }}
                                </span>
                            </td>

                            <td>
                                {{ $asignacion->comunario?->comunidad?->nombre
                                    ?? 'Sin comunidad' }}
                            </td>

                            <td>
                                <span class="monto">
                                    Bs
                                    {{ number_format(
                                        $montoAsignado,
                                        2,
                                        ',',
                                        '.'
                                    ) }}
                                </span>
                            </td>

                            <td>
                                <span class="monto">
                                    Bs
                                    {{ number_format(
                                        $montoPagado,
                                        2,
                                        ',',
                                        '.'
                                    ) }}
                                </span>
                            </td>

                            <td>
                                <span class="monto">
                                    Bs
                                    {{ number_format(
                                        $saldo,
                                        2,
                                        ',',
                                        '.'
                                    ) }}
                                </span>
                            </td>

                            <td>
                                <span
                                    class="estado-pago {{ $claseEstado }}"
                                >
                                    {{ $textoEstado }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td
                                colspan="6"
                                class="sin-personas"
                            >
                                No existen comunarios asignados a este aporte.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

    <section class="seccion">
        <div class="control-aporte">
            <div>
                <h3>Estado del aporte</h3>

                <p>
                    @if ($aporte->estado === 'activo')
                        Al desactivarlo, dejará de aparecer como un aporte activo.
                    @else
                        Al activarlo, volverá a aparecer como un aporte disponible.
                    @endif
                </p>
            </div>

            <form
                action="{{ route('aportes.estado', $aporte) }}"
                method="POST"
            >
                @csrf
                @method('PATCH')

                @if ($aporte->estado === 'activo')
                    <button
                        type="submit"
                        class="boton-estado boton-desactivar"
                        onclick="return confirm('¿Está seguro de desactivar este aporte?')"
                    >
                        Desactivar aporte
                    </button>
                @else
                    <button
                        type="submit"
                        class="boton-estado boton-activar"
                        onclick="return confirm('¿Está seguro de activar este aporte?')"
                    >
                        Activar aporte
                    </button>
                @endif
            </form>
        </div>
    </section>
</div>
@endsection