@extends('layouts.app')

@section('titulo', 'Detalle del pago')
@section('encabezado', 'Detalle del pago')

@section('contenido')
<style>
    .detalle-contenedor {
        width: 100%;
    }

    .acciones-superiores {
        margin-bottom: 20px;
        display: flex;
        justify-content: flex-end;
        gap: 10px;
    }

    .boton-volver,
    .boton-comprobante {
        min-height: 42px;
        padding: 0 18px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 7px;
        font-size: 14px;
        font-weight: normal;
        text-decoration: none;
    }

    .boton-volver {
        border: 1px solid #cbd5e1;
        color: #202124;
        background: #ffffff;
    }

    .boton-volver:hover {
        background: #f8fafc;
    }

    .boton-comprobante {
        border: 1px solid #1769c2;
        color: #ffffff;
        background: #1769c2;
    }

    .boton-comprobante:hover {
        color: #ffffff;
        background: #125aa8;
    }

    .tarjeta-principal {
        overflow: hidden;
        border: 1px solid #d8e3ef;
        border-radius: 10px;
        background: #ffffff;
    }

    .resumen-pago {
        padding: 22px 28px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 24px;
        border-bottom: 1px solid #e5edf5;
        background: #ffffff;
    }

    .resumen-pago h2 {
        margin: 0 0 6px;
        color: #202124;
        font-size: 23px;
        font-weight: normal;
    }

    .resumen-pago p {
        margin: 0;
        color: #5f6368;
        font-size: 14px;
        font-weight: normal;
    }

    .monto-principal {
        text-align: right;
    }

    .monto-principal span {
        display: block;
        margin-bottom: 5px;
        color: #5f6368;
        font-size: 12px;
        font-weight: normal;
        text-transform: uppercase;
    }

    .monto-principal strong {
        display: block;
        color: #202124;
        font-size: 25px;
        font-weight: normal;
    }

    .detalle-cuerpo {
        padding: 28px;
    }

    .seccion-detalle {
        margin-bottom: 28px;
    }

    .seccion-detalle:last-child {
        margin-bottom: 0;
    }

    .seccion-detalle h3 {
        margin: 0 0 14px;
        padding-bottom: 9px;
        border-bottom: 1px solid #e5edf5;
        color: #202124;
        font-size: 18px;
        font-weight: normal;
    }

    .datos-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        overflow: hidden;
        border: 1px solid #d8e3ef;
        border-radius: 8px;
        background: #ffffff;
    }

    .dato {
        min-width: 0;
        min-height: 82px;
        padding: 15px 17px;
        border-right: 1px solid #e5edf5;
        border-bottom: 1px solid #e5edf5;
        background: #ffffff;
    }

    .dato:nth-child(3n) {
        border-right: none;
    }

    .dato:nth-last-child(-n + 3) {
        border-bottom: none;
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
        display: block;
        overflow-wrap: anywhere;
        color: #202124;
        font-size: 15px;
        font-weight: normal;
        line-height: 1.4;
    }

    .dato .estado {
        display: inline-block;
        width: auto;
        padding: 5px 10px;
        border: 1px solid #cbd5e1;
        border-radius: 5px;
        color: #202124;
        background: #f8fafc;
        font-size: 13px;
        font-weight: normal;
        text-transform: capitalize;
    }

    .estado-pagado,
    .estado-parcial,
    .estado-pendiente {
        color: #202124 !important;
        background: #f8fafc;
    }

    @media (max-width: 850px) {
        .datos-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .dato,
        .dato:nth-child(3n) {
            border-right: 1px solid #e5edf5;
            border-bottom: 1px solid #e5edf5;
        }

        .dato:nth-child(2n) {
            border-right: none;
        }

        .dato:nth-last-child(-n + 2) {
            border-bottom: none;
        }
    }

    @media (max-width: 650px) {
        .acciones-superiores {
            flex-direction: column;
        }

        .boton-volver,
        .boton-comprobante {
            width: 100%;
        }

        .resumen-pago {
            align-items: flex-start;
            flex-direction: column;
        }

        .monto-principal {
            text-align: left;
        }

        .datos-grid {
            grid-template-columns: 1fr;
        }

        .dato,
        .dato:nth-child(2n),
        .dato:nth-child(3n),
        .dato:nth-last-child(-n + 2),
        .dato:nth-last-child(-n + 3) {
            border-right: none;
            border-bottom: 1px solid #e5edf5;
        }

        .dato:last-child {
            border-bottom: none;
        }

        .detalle-cuerpo,
        .resumen-pago {
            padding: 21px;
        }
    }
</style>

@php
    $asignacion = $pago->aporteComunario;
    $comunario = $asignacion->comunario;
    $aporte = $asignacion->aporte;
    $comprobante = $pago->comprobante;
@endphp

<div class="detalle-contenedor">
    <div class="acciones-superiores">
        <a
            href="{{ route('pagos.index') }}"
            class="boton-volver"
        >
            Volver a pagos
        </a>

        @if ($comprobante)
            <a
                href="{{ route('pagos.comprobante', $pago) }}"
                class="boton-comprobante"
            >
                Ver comprobante
            </a>
        @endif
    </div>

    <div class="tarjeta-principal">
        <div class="resumen-pago">
            <div>
                <h2>Pago registrado</h2>

                <p>
                    Código de pago: {{ $pago->id_pago }}
                </p>
            </div>

            <div class="monto-principal">
                <span>Monto pagado</span>

                <strong>
                    Bs
                    {{ number_format(
                        (float) $pago->monto_pagado,
                        2,
                        ',',
                        '.'
                    ) }}
                </strong>
            </div>
        </div>

        <div class="detalle-cuerpo">
            <div class="seccion-detalle">
                <h3>Datos del comunario</h3>

                <div class="datos-grid">
                    <div class="dato">
                        <span>Nombre completo</span>

                        <strong>
                            {{ $comunario->nombres }}
                            {{ $comunario->apellidos }}
                        </strong>
                    </div>

                    <div class="dato">
                        <span>Cédula de identidad</span>

                        <strong>
                            {{ $comunario->ci }}
                        </strong>
                    </div>

                    <div class="dato">
                        <span>Comunidad</span>

                        <strong>
                            {{ $comunario->comunidad->nombre ?? 'Sin comunidad' }}
                        </strong>
                    </div>

                    <div class="dato">
                        <span>Teléfono</span>

                        <strong>
                            {{ $comunario->telefono ?: 'No registrado' }}
                        </strong>
                    </div>
                </div>
            </div>

            <div class="seccion-detalle">
                <h3>Datos del aporte</h3>

                <div class="datos-grid">
                    <div class="dato">
                        <span>Concepto</span>

                        <strong>
                            {{ $aporte->concepto }}
                        </strong>
                    </div>

                    <div class="dato">
                        <span>Monto asignado</span>

                        <strong>
                            Bs
                            {{ number_format(
                                (float) $asignacion->monto_asignado,
                                2,
                                ',',
                                '.'
                            ) }}
                        </strong>
                    </div>

                    <div class="dato">
                        <span>Saldo pendiente</span>

                        <strong>
                            Bs
                            {{ number_format(
                                (float) $asignacion->saldo,
                                2,
                                ',',
                                '.'
                            ) }}
                        </strong>
                    </div>

                    <div class="dato">
                        <span>Estado del aporte</span>

                        <strong
                            class="estado estado-{{ strtolower($asignacion->estado_pago) }}"
                        >
                            {{ $asignacion->estado_pago }}
                        </strong>
                    </div>
                </div>
            </div>

            <div class="seccion-detalle">
                <h3>Información del pago</h3>

                <div class="datos-grid">
                    <div class="dato">
                        <span>Fecha</span>

                        <strong>
                            {{ $pago->fecha_pago->format('d/m/Y') }}
                        </strong>
                    </div>

                    <div class="dato">
                        <span>Hora</span>

                        <strong>
                            {{ $pago->fecha_pago->format('H:i') }}
                        </strong>
                    </div>

                    <div class="dato">
                        <span>Registrado por</span>

                        <strong>
                            {{ $pago->usuario->nombre_completo }}
                        </strong>
                    </div>

                    <div class="dato">
                        <span>Número de comprobante</span>

                        <strong>
                            {{ $comprobante?->numero_comprobante ?? 'No generado' }}
                        </strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection