@extends('layouts.comunario')

@section('titulo', 'Mis pagos')
@section('encabezado', 'Mis pagos')

@section('contenido')
<style>
    .pagina-pagos {
        width: 100%;
        max-width: 1400px;
        margin: 0 auto;
        color: #202124;
    }

    .encabezado-pagos {
        min-height: 260px;
        margin-bottom: 24px;
        padding: 32px 38px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 24px;
        border-radius: 20px;
        background-image:
            linear-gradient(
                rgba(0, 0, 0, 0.40),
                rgba(0, 0, 0, 0.10)
            ),
            url('{{ asset('images/pagos.jpg') }}');
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }

    .encabezado-pagos h2 {
        margin: 0 0 8px;
        color: #ffffff;
        font-size: 30px;
        font-weight: 600;
        text-shadow: 0 2px 5px rgba(0, 0, 0, 0.45);
    }

    .encabezado-pagos p {
        margin: 0;
        color: #ffffff;
        font-size: 16px;
        line-height: 1.5;
        text-shadow: 0 2px 5px rgba(0, 0, 0, 0.45);
    }

    .boton-volver {
        min-height: 44px;
        padding: 0 20px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        border: 1px solid #ffffff;
        border-radius: 8px;
        color: #202124;
        background: #ffffff;
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
        transition: 0.2s ease;
    }

    .boton-volver:hover {
        color: #ffffff;
        background: transparent;
    }

    .contenedor-pagos {
        overflow: hidden;
        border: 1px solid #d8e0e8;
        border-radius: 14px;
        background: #ffffff;
    }

    .titulo-seccion {
        padding: 24px 26px;
        border-bottom: 1px solid #e6ebf0;
    }

    .titulo-seccion h3 {
        margin: 0 0 6px;
        color: #202124;
        font-size: 22px;
        font-weight: 600;
    }

    .titulo-seccion p {
        margin: 0;
        color: #5f6368;
        font-size: 14px;
    }

    .tabla-responsive {
        width: 100%;
        overflow-x: auto;
    }

    .tabla-pagos {
        width: 100%;
        min-width: 850px;
        border-collapse: collapse;
    }

    .tabla-pagos th {
        padding: 14px 18px;
        border-bottom: 1px solid #dfe5eb;
        color: #202124;
        background: #f7f8fa;
        font-size: 12px;
        font-weight: 700;
        text-align: left;
        text-transform: uppercase;
    }

    .tabla-pagos td {
        padding: 17px 18px;
        border-bottom: 1px solid #edf0f3;
        color: #202124;
        font-size: 14px;
        vertical-align: middle;
    }

    .tabla-pagos th:nth-child(3),
    .tabla-pagos th:nth-child(4),
    .tabla-pagos th:nth-child(5),
    .tabla-pagos td:nth-child(3),
    .tabla-pagos td:nth-child(4),
    .tabla-pagos td:nth-child(5) {
        text-align: center;
    }

    .tabla-pagos tbody tr:hover {
        background: #fafbfc;
    }

    .tabla-pagos tbody tr:last-child td {
        border-bottom: none;
    }

    .concepto-aporte {
        display: block;
        margin-bottom: 4px;
        color: #202124;
        font-weight: 600;
    }

    .tipo-aporte {
        color: #6b7280;
        font-size: 12px;
    }

    .monto-pagado {
        font-size: 15px;
        font-weight: 700;
    }

    .numero-comprobante {
        font-size: 13px;
        font-weight: 600;
    }

    .boton-comprobante {
        min-height: 36px;
        padding: 0 14px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #202124;
        border-radius: 7px;
        color: #ffffff;
        background: #202124;
        font-size: 12px;
        font-weight: 600;
        text-decoration: none;
        transition: 0.2s ease;
    }

    .boton-comprobante:hover {
        color: #202124;
        background: #ffffff;
    }

    .sin-comprobante {
        color: #6b7280;
        font-size: 13px;
    }

    .sin-registros {
        padding: 45px 20px !important;
        color: #5f6368 !important;
        text-align: center !important;
    }

    .paginacion {
        padding: 20px 26px;
        border-top: 1px solid #e6ebf0;
    }

    @media (max-width: 650px) {
        .encabezado-pagos {
            min-height: 180px;
            padding: 26px 22px;
            align-items: flex-start;
            flex-direction: column;
            justify-content: center;
            border-radius: 16px;
        }

        .encabezado-pagos h2 {
            font-size: 25px;
        }

        .encabezado-pagos p {
            font-size: 14px;
        }

        .boton-volver {
            width: 100%;
        }

        .titulo-seccion {
            padding: 20px;
        }
    }
</style>

<div class="pagina-pagos">
    <div class="encabezado-pagos">
        <div>
            <h2>Mis pagos</h2>

            <p>
                Consulta todos los pagos que realizaste por tus aportes comunitarios.
            </p>
        </div>

        <a
            href="{{ route('comunario.panel') }}"
            class="boton-volver"
        >
            Volver al panel
        </a>
    </div>

    <div class="contenedor-pagos">
        <div class="titulo-seccion">
            <h3>Historial de pagos</h3>

            <p>
                Los pagos más recientes aparecen primero.
            </p>
        </div>

        <div class="tabla-responsive">
            <table class="tabla-pagos">
                <thead>
                    <tr>
                        <th>Aporte</th>
                        <th>Fecha y hora</th>
                        <th>Monto pagado</th>
                        <th>Comprobante</th>
                        <th>Acción</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($pagos as $pago)
                        <tr>
                            <td>
                                <span class="concepto-aporte">
                                    {{ $pago->aporteComunario->aporte->concepto }}
                                </span>

                                <span class="tipo-aporte">
                                    {{ $pago->aporteComunario->aporte->tipoAporte->nombre ?? 'Aporte comunitario' }}
                                </span>
                            </td>

                            <td>
                                {{ $pago->fecha_pago->format('d/m/Y H:i') }}
                            </td>

                            <td>
                                <span class="monto-pagado">
                                    Bs {{ number_format((float) $pago->monto_pagado, 2, ',', '.') }}
                                </span>
                            </td>

                            <td>
                                @if ($pago->comprobante)
                                    <span class="numero-comprobante">
                                        {{ $pago->comprobante->numero_comprobante }}
                                    </span>
                                @else
                                    <span class="sin-comprobante">
                                        No generado
                                    </span>
                                @endif
                            </td>

                            <td>
                                @if ($pago->comprobante)
                                    <a
                                        href="{{ route('comunario.comprobante', $pago) }}"
                                        class="boton-comprobante"
                                    >
                                        Ver comprobante
                                    </a>
                                @else
                                    <span class="sin-comprobante">
                                        No disponible
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="sin-registros">
                                Todavía no tienes pagos registrados.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($pagos->hasPages())
            <div class="paginacion">
                {{ $pagos->links() }}
            </div>
        @endif
    </div>
</div>
@endsection