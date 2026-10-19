@extends('layouts.app')

@section('titulo', 'Panel principal | Bengal Vinto')
@section('encabezado', 'Panel principal')

@push('estilos')
<style>
    .dashboard-contenedor {
        color: #111111;
        font-weight: 400;
    }

    .bienvenida-dashboard {
        min-height: 235px;
        margin-bottom: 26px;
        padding: 42px 46px;
        display: flex;
        align-items: center;
        position: relative;
        overflow: hidden;
        border: 0;
        border-radius: 22px;
        background-image:
        linear-gradient(
            90deg,
            rgba(0, 0, 0, 0.45),
            rgba(0, 0, 0, 0.10)
            ),
            url('{{ asset('images/quinua-dashboard.jpg') }}');
        background-size: cover;
        background-position: center;
        box-shadow: none;

    }

    .bienvenida-contenido {
        position: relative;
        z-index: 1;
        max-width: 720px;
    }

    .bienvenida-dashboard h2 {
        margin: 0 0 8px;
        color: #ffffff;
        font-size: 29px;
        font-weight: 500;
        line-height: 1.25;
    }

    .bienvenida-dashboard p {
        margin: 0;
        color: #ffffff;
        font-size: 16px;
        font-weight: 400;
        line-height: 1.5;
    }

    .panel-dashboard {
        margin-bottom: 26px;
        padding: 26px 28px;
        border: 1px solid #d7dfe9;
        border-radius: 16px;
        background: #ffffff;
        box-shadow: none !important;
    }

    .titulo-panel {
        margin-bottom: 20px;
    }

    .titulo-panel h2 {
        margin: 0;
        color: #111111;
        font-size: 21px;
        font-weight: 500;
    }

    .titulo-panel p {
        margin: 5px 0 0;
        color: #333333;
        font-size: 14px;
        font-weight: 400;
    }

    .resumen-dashboard {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        border: 1px solid #d7dfe9;
        border-radius: 13px;
        overflow: hidden;
    }

    .resumen-item {
        min-height: 105px;
        padding: 22px 24px;
        display: flex;
        align-items: center;
        gap: 16px;
        border-right: 1px solid #d7dfe9;
        background: #ffffff;
    }

    .resumen-item:last-child {
        border-right: 0;
    }

    .resumen-icono {
        width: 38px;
        height: 38px;
        flex: 0 0 38px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #111111;
    }

    .resumen-icono svg {
        width: 26px;
        height: 26px;
        fill: none;
        stroke: currentColor;
        stroke-width: 1.6;
        stroke-linecap: round;
        stroke-linejoin: round;
    }

    .resumen-informacion {
        min-width: 0;
    }

    .resumen-informacion strong {
        display: block;
        margin-bottom: 7px;
        color: #111111;
        font-size: 22px;
        font-weight: 400;
        line-height: 1;
    }

    .resumen-informacion span {
        display: block;
        color: #222222;
        font-size: 14px;
        font-weight: 400;
        line-height: 1.35;
    }

    .accesos-dashboard {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 16px;
    }

    .acceso-dashboard {
        min-height: 95px;
        padding: 19px 21px;
        display: flex;
        align-items: center;
        gap: 16px;
        border: 1px solid #d7dfe9;
        border-radius: 13px;
        background: #ffffff;
        color: #111111;
        text-decoration: none;
        transition:
            border-color 0.2s ease,
            background-color 0.2s ease;
    }

    .acceso-dashboard:hover {
        border-color: #1f6fc4;
        background: #fafcff;
        color: #111111;
        text-decoration: none;
    }

    .acceso-icono {
        width: 42px;
        height: 42px;
        flex: 0 0 42px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #111111;
    }

    .acceso-icono svg {
        width: 25px;
        height: 25px;
        fill: none;
        stroke: currentColor;
        stroke-width: 1.6;
        stroke-linecap: round;
        stroke-linejoin: round;
    }

    .acceso-informacion {
        min-width: 0;
        flex: 1;
    }

    .acceso-informacion h3 {
        margin: 0 0 5px;
        color: #111111;
        font-size: 17px;
        font-weight: 400;
    }

    .acceso-informacion p {
        margin: 0;
        color: #333333;
        font-size: 13px;
        font-weight: 400;
        line-height: 1.4;
    }

    .acceso-flecha {
        flex-shrink: 0;
        color: #111111;
        font-size: 22px;
        font-weight: 400;
        line-height: 1;
    }

    @media (max-width: 1100px) {
        .resumen-dashboard {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .resumen-item:nth-child(2) {
            border-right: 0;
        }

        .resumen-item:nth-child(1),
        .resumen-item:nth-child(2) {
            border-bottom: 1px solid #d7dfe9;
        }
    }

    @media (max-width: 700px) {
        .bienvenida-dashboard {
            min-height: 265px;
            padding: 30px 24px;
            border-radius: 22px;
            background-position: center;
        }

        .bienvenida-dashboard h2 {
            font-size: 29px;
        }

        .bienvenida-dashboard p {
            font-size: 17px;
        };
        }

        .panel-dashboard {
            padding: 21px 17px;
            border-radius: 14px;
        }

        .resumen-dashboard {
            grid-template-columns: 1fr;
        }

        .resumen-item {
            min-height: 85px;
            border-right: 0;
            border-bottom: 1px solid #d7dfe9;
        }

        .resumen-item:nth-child(3) {
            border-bottom: 1px solid #d7dfe9;
        }

        .resumen-item:last-child {
            border-bottom: 0;
        }

        .accesos-dashboard {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('contenido')
<div class="dashboard-contenedor">
    <section class="bienvenida-dashboard">
        <div class="bienvenida-contenido">
            <h2>Bienvenido, Administrador</h2>

            <p>
                Consulta la información principal y administra los aportes
                comunitarios de Bengal Vinto.
            </p>
        </div>
    </section>

    <section class="panel-dashboard">
        <div class="titulo-panel">
            <h2>Resumen general</h2>
            <p>Información registrada actualmente en el sistema.</p>
        </div>

        <div class="resumen-dashboard">
            <article class="resumen-item">
                <div class="resumen-icono">
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M3 21v-2a6 6 0 0 1 12 0v2"></path>
                        <path d="M17 11a4 4 0 0 1 4 4v4"></path>
                        <path d="M16 3.5a4 4 0 0 1 0 7"></path>
                    </svg>
                </div>

                <div class="resumen-informacion">
                    <strong>{{ $totalComunarios }}</strong>
                    <span>Comunarios registrados</span>
                </div>
            </article>

            <article class="resumen-item">
                <div class="resumen-icono">
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <rect
                            x="4"
                            y="3"
                            width="16"
                            height="18"
                            rx="2"
                        ></rect>
                        <path d="M8 8h8"></path>
                        <path d="M8 12h8"></path>
                        <path d="M8 16h4"></path>
                    </svg>
                </div>

                <div class="resumen-informacion">
                    <strong>{{ $totalAportesActivos }}</strong>
                    <span>Aportes activos</span>
                </div>
            </article>
            
            <article class="resumen-item">
                <div class="resumen-icono">
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <rect
                            x="3"
                            y="5"
                            width="18"
                            height="16"
                            rx="2"
                        ></rect>
                        <path d="M8 3v4"></path>
                        <path d="M16 3v4"></path>
                        <path d="M3 10h18"></path>
                        <path d="m8 15 2 2 5-5"></path>
                    </svg>
                </div>

                <div class="resumen-informacion">
                    <strong>
                        {{ $totalReuniones ?? 0 }}
                    </strong>
                    <span>Reuniones programadas</span>
                </div>
            </article>
        </div>
    </section>
</div>
@endsection