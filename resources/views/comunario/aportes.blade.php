@extends('layouts.comunario')

@section('titulo', 'Mis aportes')
@section('encabezado', 'Mis aportes')

@section('contenido')
<style>
    .pagina-aportes {
        width: 100%;
        max-width: 1400px;
        margin: 0 auto;
        color: #202124;
    }

    .encabezado-aportes {
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
            url('{{ asset('images/aportes.jpg') }}');
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }

    .encabezado-aportes h2 {
        margin: 0 0 8px;
        color: #ffffff;
        font-size: 30px;
        font-weight: 600;
        text-shadow: 0 2px 5px rgba(0, 0, 0, 0.45);
    }

    .encabezado-aportes p {
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

    .contenedor-aportes {
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

    .lista-aportes {
        display: grid;
        gap: 18px;
    }

    .tarjeta-aporte {
        overflow: hidden;
        border: 1px solid #d8e0e8;
        border-radius: 12px;
        background: #ffffff;
    }

    .aporte-superior {
        padding: 20px 22px;
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 20px;
        border-bottom: 1px solid #e6ebf0;
        background: #fafbfc;
    }

    .aporte-concepto h4 {
        margin: 0 0 7px;
        color: #202124;
        font-size: 18px;
        font-weight: 600;
    }

    .aporte-concepto p {
        margin: 0;
        color: #5f6368;
        font-size: 14px;
    }

    .estado-aporte {
        min-width: 92px;
        padding: 7px 13px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 20px;
        color: #ffffff;
        background: #202124;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
    }

    .estado-pagado {
        background: #202124;
    }

    .estado-parcial {
        background: #4b5563;
    }

    .estado-pendiente {
        background: #6b7280;
    }

    .aporte-datos {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
    }

    .dato-aporte {
        min-width: 0;
        padding: 20px 22px;
        border-right: 1px solid #e6ebf0;
    }

    .dato-aporte:last-child {
        border-right: none;
    }

    .dato-aporte span {
        display: block;
        margin-bottom: 7px;
        color: #6b7280;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
    }

    .dato-aporte strong {
        display: block;
        color: #202124;
        font-size: 17px;
        font-weight: 600;
        overflow-wrap: anywhere;
    }

    .sin-registros {
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

    @media (max-width: 900px) {
        .aporte-datos {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .dato-aporte:nth-child(2) {
            border-right: none;
        }

        .dato-aporte:nth-child(1),
        .dato-aporte:nth-child(2) {
            border-bottom: 1px solid #e6ebf0;
        }
    }

    @media (max-width: 650px) {
        .encabezado-aportes {
            min-height: 180px;
            padding: 26px 22px;
            align-items: flex-start;
            flex-direction: column;
            justify-content: center;
            border-radius: 16px;
        }

        .encabezado-aportes h2 {
            font-size: 25px;
        }

        .encabezado-aportes p {
            font-size: 14px;
        }

        .boton-volver {
            width: 100%;
        }

        .contenedor-aportes {
            padding: 18px;
        }

        .aporte-superior {
            flex-direction: column;
        }

        .aporte-datos {
            grid-template-columns: 1fr;
        }

        .dato-aporte,
        .dato-aporte:nth-child(2) {
            border-right: none;
            border-bottom: 1px solid #e6ebf0;
        }

        .dato-aporte:last-child {
            border-bottom: none;
        }
    }
</style>

<div class="pagina-aportes">
    <div class="encabezado-aportes">
        <div>
            <h2>Mis aportes</h2>

            <p>
                Consulta tus aportes asignados, pagos realizados y saldos pendientes.
            </p>
        </div>

        <a
            href="{{ route('comunario.panel') }}"
            class="boton-volver"
        >
            Volver al panel
        </a>
    </div>

    <div class="contenedor-aportes">
        <div class="titulo-seccion">
            <h3>Detalle de mis aportes</h3>

            <p>
                Cada aporte se muestra por separado para facilitar su consulta.
            </p>
        </div>

        <div class="lista-aportes">
            @forelse ($aportes as $asignacion)
                @php
                    $aporte = $asignacion->aporte;

                    $montoAsignado = (float) $asignacion->monto_asignado;
                    $saldo = (float) $asignacion->saldo;
                    $totalPagado = max(
                        0,
                        round($montoAsignado - $saldo, 2)
                    );

                    $estado = strtolower(
                        $asignacion->estado_pago ?? 'pendiente'
                    );
                @endphp

                <article class="tarjeta-aporte">
                    <div class="aporte-superior">
                        <div class="aporte-concepto">
                            <h4>
                                {{ $aporte->concepto }}
                            </h4>

                            <p>
                                {{ $aporte->tipoAporte->nombre ?? 'Aporte comunitario' }}
                            </p>
                        </div>

                        <span class="estado-aporte estado-{{ $estado }}">
                            {{ ucfirst($estado) }}
                        </span>
                    </div>

                    <div class="aporte-datos">
                        <div class="dato-aporte">
                            <span>Monto asignado</span>

                            <strong>
                                Bs {{ number_format($montoAsignado, 2, ',', '.') }}
                            </strong>
                        </div>

                        <div class="dato-aporte">
                            <span>Total pagado</span>

                            <strong>
                                Bs {{ number_format($totalPagado, 2, ',', '.') }}
                            </strong>
                        </div>

                        <div class="dato-aporte">
                            <span>Saldo pendiente</span>

                            <strong>
                                Bs {{ number_format($saldo, 2, ',', '.') }}
                            </strong>
                        </div>

                        <div class="dato-aporte">
                            <span>Fecha de vencimiento</span>

                            <strong>
                                {{ $aporte->fecha_vencimiento
                                    ? $aporte->fecha_vencimiento->format('d/m/Y')
                                    : 'Sin fecha' }}
                            </strong>
                        </div>
                    </div>
                </article>
            @empty
                <div class="sin-registros">
                    <h4>No tienes aportes asignados</h4>

                    <p>
                        Cuando se te asigne un aporte, aparecerá en esta sección.
                    </p>
                </div>
            @endforelse
        </div>

        @if ($aportes->hasPages())
            <div class="paginacion">
                {{ $aportes->links() }}
            </div>
        @endif
    </div>
</div>
@endsection