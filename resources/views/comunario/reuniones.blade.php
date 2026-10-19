@extends('layouts.comunario')

@section('titulo', 'Mis reuniones')
@section('encabezado', 'Mis reuniones')

@section('contenido')
<style>
    .pagina-reuniones {
        width: 100%;
        max-width: 1400px;
        margin: 0 auto;
        color: #202124;
    }

    .encabezado-reuniones {
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
            url('{{ asset('images/plaza.png') }}');
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }

    .encabezado-reuniones h2 {
        margin: 0 0 8px;
        color: #ffffff;
        font-size: 30px;
        font-weight: 600;
        text-shadow: 0 2px 5px rgba(0, 0, 0, 0.45);
    }

    .encabezado-reuniones p {
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

    .contenedor-reuniones {
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

    .lista-reuniones {
        display: grid;
        gap: 18px;
    }

    .tarjeta-reunion {
        overflow: hidden;
        border: 1px solid #d8e0e8;
        border-radius: 12px;
        background: #ffffff;
    }

    .reunion-superior {
        padding: 20px 22px;
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 20px;
        border-bottom: 1px solid #e6ebf0;
        background: #fafbfc;
    }

    .reunion-superior h4 {
        margin: 0 0 6px;
        color: #202124;
        font-size: 18px;
        font-weight: 600;
    }

    .reunion-superior p {
        margin: 0;
        color: #5f6368;
        font-size: 13px;
    }

    .estado-reunion {
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

    .reunion-datos {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
    }

    .dato-reunion {
        min-width: 0;
        padding: 20px 22px;
        border-right: 1px solid #e6ebf0;
    }

    .dato-reunion:last-child {
        border-right: none;
    }

    .dato-reunion span {
        display: block;
        margin-bottom: 7px;
        color: #6b7280;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
    }

    .dato-reunion strong {
        display: block;
        color: #202124;
        font-size: 15px;
        font-weight: 600;
        overflow-wrap: anywhere;
    }

    .asistencia {
        display: inline-flex !important;
        width: auto;
        padding: 6px 12px;
        border-radius: 20px;
        color: #ffffff !important;
        background: #202124;
        font-size: 12px !important;
        font-weight: 600;
        text-transform: uppercase;
    }

    .asistencia-retraso {
        background: #4b5563;
    }

    .asistencia-falta {
        background: #6b7280;
    }

    .asistencia-licencia {
        color: #202124 !important;
        background: #e5e7eb;
    }

    .asistencia-sin-registrar {
        color: #202124 !important;
        background: #e5e7eb;
    }

    .observacion {
        padding: 14px 22px;
        border-top: 1px solid #e6ebf0;
        color: #5f6368;
        background: #ffffff;
        font-size: 13px;
    }

    .observacion strong {
        color: #202124;
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

    @media (max-width: 950px) {
        .reunion-datos {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .dato-reunion:nth-child(2) {
            border-right: none;
        }

        .dato-reunion:nth-child(1),
        .dato-reunion:nth-child(2) {
            border-bottom: 1px solid #e6ebf0;
        }
    }

    @media (max-width: 650px) {
        .encabezado-reuniones {
            min-height: 180px;
            padding: 26px 22px;
            align-items: flex-start;
            flex-direction: column;
            justify-content: center;
            border-radius: 16px;
        }

        .encabezado-reuniones h2 {
            font-size: 25px;
        }

        .encabezado-reuniones p {
            font-size: 14px;
        }

        .boton-volver {
            width: 100%;
        }

        .contenedor-reuniones {
            padding: 18px;
        }

        .reunion-superior {
            flex-direction: column;
        }

        .reunion-datos {
            grid-template-columns: 1fr;
        }

        .dato-reunion,
        .dato-reunion:nth-child(2) {
            border-right: none;
            border-bottom: 1px solid #e6ebf0;
        }

        .dato-reunion:last-child {
            border-bottom: none;
        }
    }
</style>

<div class="pagina-reuniones">
    <div class="encabezado-reuniones">
        <div>
            <h2>Mis reuniones</h2>

            <p>
                Consulta las reuniones programadas para tu comunidad y tu asistencia.
            </p>
        </div>

        <a
            href="{{ route('comunario.panel') }}"
            class="boton-volver"
        >
            Volver al panel
        </a>
    </div>

    <div class="contenedor-reuniones">
        <div class="titulo-seccion">
            <h3>Reuniones de mi comunidad</h3>

            <p>
                Comunidad: {{ $comunario->comunidad->nombre ?? 'Sin comunidad' }}
            </p>
        </div>

        <div class="lista-reuniones">
            @forelse ($reuniones as $reunion)
                @php
                    $asistencia = $reunion->asistencias->first();

                    $estadoAsistencia = strtolower(
                        $asistencia->estado_asistencia ?? 'sin registrar'
                    );

                    $claseAsistencia = str_replace(
                        ' ',
                        '-',
                        $estadoAsistencia
                    );
                @endphp

                <article class="tarjeta-reunion">
                    <div class="reunion-superior">
                        <div>
                            <h4>{{ $reunion->descripcion }}</h4>

                            <p>
                                Reunión programada para tu comunidad
                            </p>
                        </div>

                        <span class="estado-reunion">
                            {{ ucfirst($reunion->estado) }}
                        </span>
                    </div>

                    <div class="reunion-datos">
                        <div class="dato-reunion">
                            <span>Fecha</span>

                            <strong>
                                {{ $reunion->fecha->format('d/m/Y') }}
                            </strong>
                        </div>

                        <div class="dato-reunion">
                            <span>Hora</span>

                            <strong>
                                {{ $reunion->hora
                                    ? substr($reunion->hora, 0, 5)
                                    : 'Sin hora' }}
                            </strong>
                        </div>

                        <div class="dato-reunion">
                            <span>Lugar</span>

                            <strong>
                                {{ $reunion->lugar }}
                            </strong>
                        </div>

                        <div class="dato-reunion">
                            <span>Mi asistencia</span>

                            <strong class="asistencia asistencia-{{ $claseAsistencia }}">
                                {{ ucfirst($estadoAsistencia) }}
                            </strong>
                        </div>
                    </div>

                    @if ($asistencia && $asistencia->observacion)
                        <div class="observacion">
                            <strong>Observación:</strong>
                            {{ $asistencia->observacion }}
                        </div>
                    @endif
                </article>
            @empty
                <div class="sin-registros">
                    <h4>No tienes reuniones registradas</h4>

                    <p>
                        Las reuniones programadas para tu comunidad aparecerán aquí.
                    </p>
                </div>
            @endforelse
        </div>

        @if ($reuniones->hasPages())
            <div class="paginacion">
                {{ $reuniones->links() }}
            </div>
        @endif
    </div>
</div>
@endsection