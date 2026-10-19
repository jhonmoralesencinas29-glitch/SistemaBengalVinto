@extends('layouts.comunario')

@section('titulo', 'Panel principal')

@section('contenido')
<style>
    .panel-comunario {
        width: 100%;
        color: #202124;
    }

    .encabezado-comunario {
        min-height: 260px;
        margin-bottom: 24px;
        padding: 35px 40px;
        display: flex;
        align-items: center;
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

    .encabezado-comunario h1 {
        margin: 0 0 8px;
        color: #ffffff;
        font-size: 30px;
        font-weight: 600;
        text-shadow: 0 2px 5px rgba(0, 0, 0, 0.45);
    }

    .encabezado-comunario p {
        margin: 0;
        color: #ffffff;
        font-size: 16px;
        line-height: 1.5;
        text-shadow: 0 2px 5px rgba(0, 0, 0, 0.45);
    }

    .seccion-panel {
        margin-bottom: 24px;
        padding: 28px 30px;
        border: 1px solid #d8e3ef;
        border-radius: 14px;
        background: #ffffff;
    }

    .titulo-seccion {
        margin-bottom: 22px;
    }

    .titulo-seccion h2 {
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

    .resumen-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        overflow: hidden;
        border: 1px solid #d8e3ef;
        border-radius: 12px;
        background: #ffffff;
    }

    .resumen-item {
        min-height: 118px;
        padding: 22px;
        display: flex;
        align-items: center;
        gap: 16px;
        border-right: 1px solid #d8e3ef;
    }

    .resumen-item:last-child {
        border-right: none;
    }

    .resumen-icono {
        width: 34px;
        height: 34px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        color: #202124;
    }

    .resumen-icono svg {
        width: 27px;
        height: 27px;
        fill: none;
        stroke: currentColor;
        stroke-width: 1.8;
        stroke-linecap: round;
        stroke-linejoin: round;
    }

    .resumen-datos strong {
        display: block;
        margin-bottom: 6px;
        color: #202124;
        font-size: 23px;
        font-weight: 500;
    }

    .resumen-datos span {
        display: block;
        color: #202124;
        font-size: 14px;
    }

    .opciones-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 16px;
    }

    .opcion-panel {
        min-height: 105px;
        padding: 18px 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 18px;
        border: 1px solid #d8e3ef;
        border-radius: 12px;
        color: #202124;
        background: #ffffff;
        transition:
            border-color 0.2s,
            background 0.2s;
    }

    .opcion-panel:hover {
        border-color: #9fb4ca;
        color: #202124;
        background: #f8fafc;
    }

    .opcion-contenido {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .opcion-icono {
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        border-radius: 10px;
        color: #202124;
        background: #f1f3f4;
    }

    .opcion-icono svg {
        width: 25px;
        height: 25px;
        fill: none;
        stroke: currentColor;
        stroke-width: 1.8;
        stroke-linecap: round;
        stroke-linejoin: round;
    }

    .opcion-texto strong {
        display: block;
        margin-bottom: 6px;
        color: #202124;
        font-size: 16px;
        font-weight: 600;
    }

    .opcion-texto span {
        display: block;
        color: #5f6368;
        font-size: 14px;
        line-height: 1.4;
    }

    .opcion-flecha {
        flex-shrink: 0;
        color: #202124;
    }

    .opcion-flecha svg {
        width: 20px;
        height: 20px;
        fill: none;
        stroke: currentColor;
        stroke-width: 2;
        stroke-linecap: round;
        stroke-linejoin: round;
    }

    @media (max-width: 1050px) {
        .resumen-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .resumen-item:nth-child(2) {
            border-right: none;
        }

        .resumen-item:nth-child(-n+2) {
            border-bottom: 1px solid #d8e3ef;
        }
    }

    @media (max-width: 750px) {
        .opciones-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 600px) {
        .encabezado-comunario {
            min-height: 170px;
            padding: 26px 22px;
            border-radius: 16px;
        }

        .encabezado-comunario h1 {
            font-size: 25px;
        }

        .encabezado-comunario p {
            font-size: 14px;
        }

        .seccion-panel {
            padding: 22px 18px;
        }

        .resumen-grid {
            grid-template-columns: 1fr;
        }

        .resumen-item {
            border-right: none;
            border-bottom: 1px solid #d8e3ef;
        }

        .resumen-item:nth-child(2) {
            border-bottom: 1px solid #d8e3ef;
        }

        .resumen-item:last-child {
            border-bottom: none;
        }

        .opcion-panel {
            padding: 16px;
        }
    }
</style>

<div class="panel-comunario">
    <section class="encabezado-comunario">
        <div>
            <h1>
                Bienvenido, {{ $comunario->nombres }}
            </h1>

            <p>
                Consulta de manera sencilla tu información
                comunitaria.
            </p>
        </div>
    </section>

    <section class="seccion-panel">
        <div class="titulo-seccion">
            <h2>Resumen general de mis aportes</h2>

            <p>
                Información registrada actualmente en el sistema.
            </p>
        </div>

        <div class="resumen-grid">
            <div class="resumen-item">
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

                <div class="resumen-datos">
                    <strong>{{ $totalAportes }}</strong>
                    <span>Aportes asignados</span>
                </div>
            </div>

            <div class="resumen-item">
                <div class="resumen-icono">
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <rect
                            x="3"
                            y="5"
                            width="18"
                            height="14"
                            rx="2"
                        ></rect>

                        <path d="M3 10h18"></path>
                        <path d="M7 15h4"></path>
                    </svg>
                </div>

                <div class="resumen-datos">
                    <strong>
                        Bs {{ number_format($totalAsignado, 2, ',', '.') }}
                    </strong>

                    <span>Monto asignado</span>
                </div>
            </div>

            <div class="resumen-item">
                <div class="resumen-icono">
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M20 7 9 18l-5-5"></path>
                    </svg>
                </div>

                <div class="resumen-datos">
                    <strong>
                        Bs {{ number_format($totalPagado, 2, ',', '.') }}
                    </strong>

                    <span>Total pagado</span>
                </div>
            </div>

            <div class="resumen-item">
                <div class="resumen-icono">
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <circle cx="12" cy="12" r="9"></circle>
                        <path d="M12 7v5l3 2"></path>
                    </svg>
                </div>

                <div class="resumen-datos">
                    <strong>
                        Bs {{ number_format($saldoPendiente, 2, ',', '.') }}
                    </strong>

                    <span>Saldo pendiente</span>
                </div>
            </div>
        </div>
    </section>

    <section class="seccion-panel">
        <div class="titulo-seccion">
            <h2>¿Qué deseas consultar?</h2>

            <p>
                Selecciona una de las opciones disponibles.
            </p>
        </div>

        <div class="opciones-grid">
            <a
                href="{{ route('comunario.aportes') }}"
                class="opcion-panel"
            >
                <div class="opcion-contenido">
                    <div class="opcion-icono">
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

                    <div class="opcion-texto">
                        <strong>Mis aportes</strong>
                        <span>
                            Revisa tus aportes, montos y saldos.
                        </span>
                    </div>
                </div>

                <div class="opcion-flecha">
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <path d="m9 18 6-6-6-6"></path>
                    </svg>
                </div>
            </a>

            <a
                href="{{ route('comunario.pagos') }}"
                class="opcion-panel"
            >
                <div class="opcion-contenido">
                    <div class="opcion-icono">
                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <rect
                                x="3"
                                y="5"
                                width="18"
                                height="14"
                                rx="2"
                            ></rect>

                            <path d="M3 10h18"></path>
                            <path d="M7 15h4"></path>
                        </svg>
                    </div>

                    <div class="opcion-texto">
                        <strong>Mis pagos</strong>
                        <span>
                            Consulta los pagos que realizaste.
                        </span>
                    </div>
                </div>

                <div class="opcion-flecha">
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <path d="m9 18 6-6-6-6"></path>
                    </svg>
                </div>
            </a>

            <a
                href="{{ route('comunario.comprobantes') }}"
                class="opcion-panel"
            >
                <div class="opcion-contenido">
                    <div class="opcion-icono">
                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M6 3h12v18l-3-2-3 2-3-2-3 2z"></path>
                            <path d="M9 8h6"></path>
                            <path d="M9 12h6"></path>
                        </svg>
                    </div>

                    <div class="opcion-texto">
                        <strong>Mis comprobantes</strong>
                        <span>
                            Abre e imprime tus comprobantes.
                        </span>
                    </div>
                </div>

                <div class="opcion-flecha">
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <path d="m9 18 6-6-6-6"></path>
                    </svg>
                </div>
            </a>

            <a
                href="{{ route('comunario.reuniones') }}"
                class="opcion-panel"
            >
                <div class="opcion-contenido">
                    <div class="opcion-icono">
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
                        </svg>
                    </div>

                    <div class="opcion-texto">
                        <strong>Mis reuniones</strong>
                        <span>
                            Consulta tus reuniones y asistencias.
                        </span>
                    </div>
                </div>

                <div class="opcion-flecha">
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <path d="m9 18 6-6-6-6"></path>
                    </svg>
                </div>
            </a>

            <a
                href="{{ route('comunario.datos') }}"
                class="opcion-panel"
            >
                <div class="opcion-contenido">
                    <div class="opcion-icono">
                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <circle cx="12" cy="8" r="4"></circle>
                            <path d="M4 21a8 8 0 0 1 16 0"></path>
                        </svg>
                    </div>

                    <div class="opcion-texto">
                        <strong>Mis datos personales</strong>
                        <span>
                            Revisa tu información registrada.
                        </span>
                    </div>
                </div>

                <div class="opcion-flecha">
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <path d="m9 18 6-6-6-6"></path>
                    </svg>
                </div>
            </a>
        </div>
    </section>
</div>
@endsection