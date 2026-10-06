@extends('layouts.app')

@section('titulo', 'Panel principal | Bengal Vinto')
@section('encabezado', 'Panel principal')

@push('estilos')
<style>
    .saludo-dashboard {
        min-height: 190px;
        margin-bottom: 24px;
        padding: 35px 40px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        border-radius: 22px;
        background-image:
            linear-gradient(
                rgba(0, 35, 80, 0.65),
                rgba(0, 35, 80, 0.65)
            ),
            url('{{ asset('images/quinua-dashboard.jpg') }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }

    .saludo-dashboard h2 {
        margin-bottom: 9px;
        color: white;
        font-size: 30px;
        font-weight: normal;
        text-shadow: 0 2px 5px rgba(0, 0, 0, 0.45);
    }

    .saludo-dashboard p {
        max-width: 700px;
        color: white;
        font-size: 16px;
        line-height: 1.5;
        text-shadow: 0 2px 5px rgba(0, 0, 0, 0.45);
    }

    .panel-dashboard {
        margin-bottom: 28px;
        padding: 28px 30px;
        border: 1px solid #e0e3e7;
        border-radius: 22px;
        background: #ffffff;
    }

    .encabezado-panel {
        margin-bottom: 22px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
    }

    .encabezado-panel h2 {
        color: #202124;
        font-size: 22px;
        font-weight: normal;
    }

    .encabezado-panel p {
        margin-top: 5px;
        color: #5f6368;
        font-size: 14px;
    }

    .resumen-dashboard {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        border: 1px solid #e0e3e7;
        border-radius: 14px;
        overflow: hidden;
    }

    .resumen-item {
        min-height: 105px;
        padding: 20px;
        display: flex;
        align-items: center;
        gap: 15px;
        border-right: 1px solid #e0e3e7;
        background: #ffffff;
    }

    .resumen-item:last-child {
        border-right: 0;
    }

    .resumen-icono {
        width: 48px;
        height: 48px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        color: #0b57d0;
        background: #e8f0fe;
    }

    .resumen-icono svg {
        width: 24px;
        height: 24px;
        fill: none;
        stroke: currentColor;
        stroke-width: 1.8;
        stroke-linecap: round;
        stroke-linejoin: round;
    }

    .resumen-informacion {
        min-width: 0;
    }

    .resumen-informacion strong {
        display: block;
        margin-bottom: 5px;
        color: #202124;
        font-size: 23px;
        line-height: 1;
    }

    .resumen-informacion span {
        color: #5f6368;
        font-size: 13px;
        line-height: 1.4;
    }

    .modulos-dashboard {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 20px;
    }

    .modulo-dashboard {
        min-height: 190px;
        display: flex;
        flex-direction: column;
        overflow: hidden;
        color: #202124;
        background: #ffffff;
        border: 1px solid #dadce0;
        border-radius: 12px;
        transition:
            box-shadow 0.2s,
            transform 0.2s;
    }

    a.modulo-dashboard:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(60, 64, 67, 0.18);
    }

    .modulo-cabecera {
        min-height: 74px;
        padding: 17px 19px;
        display: flex;
        align-items: center;
        gap: 13px;
        color: #ffffff;
        background: #0b57d0;
    }

    .modulo-icono {
        width: 39px;
        height: 39px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        color: #0b57d0;
        background: #ffffff;
    }

    .modulo-icono svg {
        width: 21px;
        height: 21px;
        fill: none;
        stroke: currentColor;
        stroke-width: 1.8;
        stroke-linecap: round;
        stroke-linejoin: round;
    }

    .modulo-cabecera h3 {
        font-size: 18px;
        font-weight: normal;
    }

    .modulo-contenido {
        flex: 1;
        padding: 18px 19px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .modulo-contenido p {
        color: #5f6368;
        font-size: 14px;
        line-height: 1.55;
    }

    .modulo-accion {
        margin-top: 17px;
        color: #0b57d0;
        font-size: 13px;
        font-weight: bold;
    }

    .modulo-proximamente {
        cursor: default;
    }

    .modulo-proximamente .modulo-cabecera {
        color: #3c4043;
        background: #e8eaed;
    }

    .modulo-proximamente .modulo-icono {
        color: #5f6368;
        background: #ffffff;
    }

    .modulo-proximamente .modulo-accion {
        color: #5f6368;
        font-weight: normal;
    }

    @media (max-width: 1200px) {
        .resumen-dashboard {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .resumen-item:nth-child(2) {
            border-right: 0;
        }

        .resumen-item:nth-child(1),
        .resumen-item:nth-child(2) {
            border-bottom: 1px solid #e0e3e7;
        }

        .modulos-dashboard {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 700px) {
        .saludo-dashboard {
            min-height: 165px;
            padding: 25px 22px;
            border-radius: 16px;
            background-position: center;
        }

        .saludo-dashboard h2 {
            font-size: 24px;
        }

        .saludo-dashboard p {
            font-size: 14px;
        }

        .panel-dashboard {
            padding: 22px 18px;
            border-radius: 16px;
        }

        .encabezado-panel {
            align-items: flex-start;
            flex-direction: column;
            gap: 6px;
        }

        .resumen-dashboard {
            grid-template-columns: 1fr;
        }

        .resumen-item {
            min-height: 90px;
            border-right: 0;
            border-bottom: 1px solid #e0e3e7;
        }

        .resumen-item:nth-child(3) {
            border-bottom: 1px solid #e0e3e7;
        }

        .resumen-item:last-child {
            border-bottom: 0;
        }

        .modulos-dashboard {
            grid-template-columns: 1fr;
        }

        .modulo-dashboard {
            min-height: 175px;
        }
    }
</style>
@endpush

@section('contenido')
    <section class="saludo-dashboard">
        <h2>¡Bienvenido/a, Administrador</h2>
        <p>
            Consulta el resumen general y selecciona el módulo que deseas administrar.
        </p>
    </section>

    <section class="panel-dashboard">
        <div class="encabezado-panel">
            <div>
                <h2>Resumen del sistema</h2>
                <p>Información general registrada en el sistema.</p>
            </div>
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
                        <rect x="4" y="3" width="16" height="18" rx="2"></rect>
                        <path d="M8 8h8"></path>
                        <path d="M8 12h8"></path>
                        <path d="M8 16h4"></path>
                        <path d="M16 15v4"></path>
                        <path d="M14 17h4"></path>
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
                        <rect x="3" y="5" width="18" height="14" rx="2"></rect>
                        <path d="M3 10h18"></path>
                        <path d="M7 15h4"></path>
                    </svg>
                </div>

                <div class="resumen-informacion">
                    <strong>Bs 0,00</strong>
                    <span>Pagos registrados</span>
                </div>
            </article>

            <article class="resumen-item">
                <div class="resumen-icono">
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <rect x="3" y="5" width="18" height="16" rx="2"></rect>
                        <path d="M8 3v4"></path>
                        <path d="M16 3v4"></path>
                        <path d="M3 10h18"></path>
                        <path d="m8 15 2 2 5-5"></path>
                    </svg>
                </div>

                <div class="resumen-informacion">
                    <strong>0</strong>
                    <span>Reuniones programadas</span>
                </div>
            </article>
        </div>
    </section>

    <section class="panel-dashboard">
        <div class="encabezado-panel">
            <div>
                <h2>Módulos del sistema</h2>
                <p>Selecciona el módulo que deseas administrar.</p>
            </div>
        </div>

        <div class="modulos-dashboard">
            <a
                href="{{ route('comunidades.index') }}"
                class="modulo-dashboard"
            >
                <div class="modulo-cabecera">
                    <div class="modulo-icono">
                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M3 21V9l5-4 4 3 4-3 5 4v12"></path>
                            <path d="M8 5v16"></path>
                            <path d="M16 5v16"></path>
                            <path d="M5 12h1"></path>
                            <path d="M10 12h4"></path>
                            <path d="M18 12h1"></path>
                        </svg>
                    </div>

                    <h3>Comunidades</h3>
                </div>

                <div class="modulo-contenido">
                    <p>
                        Registro y administración de las comunidades pertenecientes
                        al Cantón Bengal Vinto.
                    </p>

                    <span class="modulo-accion">Abrir módulo</span>
                </div>
            </a>

            

            <a
                href="{{ route('aportes.index') }}"
                class="modulo-dashboard"
            >
                <div class="modulo-cabecera">
                    <div class="modulo-icono">
                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <rect x="4" y="3" width="16" height="18" rx="2"></rect>
                            <path d="M8 8h8"></path>
                            <path d="M8 12h8"></path>
                            <path d="M8 16h4"></path>
                        </svg>
                    </div>

                    <h3>Aportes</h3>
                </div>

                <div class="modulo-contenido">
                    <p>
                        Creación, asignación y seguimiento de los aportes
                        comunitarios.
                    </p>

                    <span class="modulo-accion">Abrir módulo</span>
                </div>
            </a>

            <article class="modulo-dashboard modulo-proximamente">
                <div class="modulo-cabecera">
                    <div class="modulo-icono">
                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <rect x="3" y="5" width="18" height="14" rx="2"></rect>
                            <path d="M3 10h18"></path>
                            <path d="M7 15h4"></path>
                        </svg>
                    </div>

                    <h3>Pagos</h3>
                </div>

                <div class="modulo-contenido">
                    <p>
                        Registro de pagos y consulta de los saldos pendientes.
                    </p>

                    <span class="modulo-accion">Próximamente</span>
                </div>
            </article>

            <article class="modulo-dashboard modulo-proximamente">
                <div class="modulo-cabecera">
                    <div class="modulo-icono">
                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <rect x="3" y="5" width="18" height="16" rx="2"></rect>
                            <path d="M8 3v4"></path>
                            <path d="M16 3v4"></path>
                            <path d="M3 10h18"></path>
                            <path d="m8 15 2 2 5-5"></path>
                        </svg>
                    </div>

                    <h3>Reuniones</h3>
                </div>

                <div class="modulo-contenido">
                    <p>
                        Programación de reuniones y control de asistencia de los
                        comunarios.
                    </p>

                    <span class="modulo-accion">Próximamente</span>
                </div>
            </article>

            <article class="modulo-dashboard modulo-proximamente">
                <div class="modulo-cabecera">
                    <div class="modulo-icono">
                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M4 20V11"></path>
                            <path d="M10 20V4"></path>
                            <path d="M16 20v-7"></path>
                            <path d="M22 20V8"></path>
                            <path d="M2 20h21"></path>
                        </svg>
                    </div>

                    <h3>Reportes</h3>
                </div>

                <div class="modulo-contenido">
                    <p>
                        Consulta de información económica y actividad comunitaria.
                    </p>

                    <span class="modulo-accion">Próximamente</span>
                </div>
            </article>
        </div>
    </section>
@endsection