@extends('layouts.comunario')

@section('titulo', 'Mis comprobantes')
@section('encabezado', 'Mis comprobantes')

@section('contenido')
<style>
    .pagina-comprobantes {
        width: 100%;
        max-width: 1400px;
        margin: 0 auto;
        color: #202124;
    }

    .encabezado-comprobantes {
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
                rgba(0, 0, 0, 0.60),
                rgba(0, 0, 0, 0.60)
            ),
            url('{{ asset('images/pagos.jpg') }}');
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }

    .encabezado-comprobantes h2 {
        margin: 0 0 8px;
        color: #ffffff;
        font-size: 30px;
        font-weight: 600;
        text-shadow: 0 2px 5px rgba(0, 0, 0, 0.45);
    }

    .encabezado-comprobantes p {
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

    .contenedor-comprobantes {
        padding: 26px;
        border: 1px solid #d8e0e8;
        border-radius: 14px;
        background: #ffffff;
    }

    .titulo-seccion {
        margin-bottom: 22px;
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

    .lista-comprobantes {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 18px;
    }

    .tarjeta-comprobante {
        padding: 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 18px;
        border: 1px solid #d8e0e8;
        border-radius: 12px;
        background: #ffffff;
        transition: 0.2s ease;
    }

    .tarjeta-comprobante:hover {
        border-color: #9ca3af;
        background: #fafbfc;
    }

    .informacion-comprobante {
        min-width: 0;
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .icono-comprobante {
        width: 48px;
        height: 48px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        border-radius: 10px;
        color: #ffffff;
        background: #202124;
    }

    .icono-comprobante svg {
        width: 24px;
        height: 24px;
        fill: none;
        stroke: currentColor;
        stroke-linecap: round;
        stroke-linejoin: round;
        stroke-width: 1.8;
    }

    .detalle-comprobante {
        min-width: 0;
    }

    .detalle-comprobante h4 {
        margin: 0 0 5px;
        color: #202124;
        font-size: 15px;
        font-weight: 700;
        overflow-wrap: anywhere;
    }

    .detalle-comprobante p {
        margin: 0 0 4px;
        color: #5f6368;
        font-size: 13px;
        line-height: 1.4;
    }

    .detalle-comprobante strong {
        color: #202124;
        font-size: 14px;
    }

    .boton-ver {
        min-height: 38px;
        padding: 0 16px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        border: 1px solid #202124;
        border-radius: 7px;
        color: #ffffff;
        background: #202124;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        transition: 0.2s ease;
    }

    .boton-ver:hover {
        color: #202124;
        background: #ffffff;
    }

    .sin-registros {
        grid-column: 1 / -1;
        padding: 45px 20px;
        border: 1px dashed #cbd5e1;
        border-radius: 10px;
        color: #5f6368;
        background: #fafbfc;
        text-align: center;
    }

    .sin-registros h4 {
        margin: 0 0 7px;
        color: #202124;
        font-size: 18px;
    }

    .sin-registros p {
        margin: 0;
        font-size: 14px;
    }

    .paginacion {
        margin-top: 24px;
    }

    @media (max-width: 950px) {
        .lista-comprobantes {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 650px) {
        .encabezado-comprobantes {
            min-height: 180px;
            padding: 26px 22px;
            align-items: flex-start;
            flex-direction: column;
            justify-content: center;
            border-radius: 16px;
        }

        .encabezado-comprobantes h2 {
            font-size: 25px;
        }

        .encabezado-comprobantes p {
            font-size: 14px;
        }

        .boton-volver {
            width: 100%;
        }

        .contenedor-comprobantes {
            padding: 18px;
        }

        .tarjeta-comprobante {
            align-items: flex-start;
            flex-direction: column;
        }

        .boton-ver {
            width: 100%;
        }
    }
</style>

<div class="pagina-comprobantes">
    <div class="encabezado-comprobantes">
        <div>
            <h2>Mis comprobantes</h2>

            <p>
                Consulta los comprobantes generados por tus pagos.
            </p>
        </div>

        <a
            href="{{ route('comunario.panel') }}"
            class="boton-volver"
        >
            Volver al panel
        </a>
    </div>

    <div class="contenedor-comprobantes">
        <div class="titulo-seccion">
            <h3>Comprobantes disponibles</h3>

            <p>
                Puedes abrir cada comprobante para consultarlo o imprimirlo.
            </p>
        </div>

        <div class="lista-comprobantes">
            @forelse ($pagos as $pago)
                <article class="tarjeta-comprobante">
                    <div class="informacion-comprobante">
                        <div class="icono-comprobante">
                            <svg viewBox="0 0 24 24">
                                <path d="M6 2h9l3 3v17H6z"></path>
                                <path d="M14 2v4h4"></path>
                                <path d="M9 11h6"></path>
                                <path d="M9 15h6"></path>
                                <path d="M9 19h4"></path>
                            </svg>
                        </div>

                        <div class="detalle-comprobante">
                            <h4>
                                {{ $pago->comprobante->numero_comprobante }}
                            </h4>

                            <p>
                                {{ $pago->aporteComunario->aporte->concepto }}
                            </p>

                            <p>
                                {{ $pago->fecha_pago->format('d/m/Y H:i') }}
                            </p>

                            <strong>
                                Bs {{ number_format((float) $pago->monto_pagado, 2, ',', '.') }}
                            </strong>
                        </div>
                    </div>

                    <a
                        href="{{ route('comunario.comprobante', $pago) }}"
                        class="boton-ver"
                    >
                        Ver comprobante
                    </a>
                </article>
            @empty
                <div class="sin-registros">
                    <h4>No tienes comprobantes</h4>

                    <p>
                        Los comprobantes aparecerán después de registrar tus pagos.
                    </p>
                </div>
            @endforelse
        </div>

        @if ($pagos->hasPages())
            <div class="paginacion">
                {{ $pagos->links() }}
            </div>
        @endif
    </div>
</div>
@endsection