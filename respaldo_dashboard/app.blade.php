<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <meta
        name="csrf-token"
        content="{{ csrf_token() }}"
    >

    <title>@yield('titulo', 'Sistema Bengal Vinto')</title>

    <style>
        :root {
            --azul: #0b57d0;
            --azul-oscuro: #17365d;
            --azul-claro: #d3e8ff;
            --fondo: #f6f8fc;
            --blanco: #ffffff;
            --texto: #202124;
            --texto-suave: #5f6368;
            --borde: #dadce0;
            --alto-barra: 64px;
            --ancho-menu: 275px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html,
        body {
            width: 100%;
            min-height: 100%;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            color: var(--texto);
            background: var(--fondo);
        }

        button,
        input,
        select,
        textarea {
            font-family: inherit;
        }

        button {
            cursor: pointer;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        .aplicacion {
            min-height: 100vh;
        }

        .barra-superior {
            position: fixed;
            top: 0;
            right: 0;
            left: 0;
            z-index: 1100;
            height: var(--alto-barra);
            padding: 0 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid var(--borde);
            background: var(--blanco);
        }

        .barra-izquierda {
            display: flex;
            align-items: center;
            gap: 18px;
        }

        .boton-menu {
            width: 42px;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 0;
            border-radius: 50%;
            color: var(--texto-suave);
            background: transparent;
        }

        .boton-menu:hover {
            background: #f1f3f4;
        }

        .boton-menu svg {
            width: 25px;
            height: 25px;
            fill: none;
            stroke: currentColor;
            stroke-width: 2;
            stroke-linecap: round;
        }

        .marca-superior {
            display: flex;
            align-items: center;
            gap: 11px;
        }

        .marca-superior img {
            width: 43px;
            height: 43px;
            object-fit: contain;
        }

        .marca-superior span {
            color: #3c4043;
            font-size: 21px;
        }

        .barra-derecha {
            margin-left: auto;
            display: flex;
            align-items: center;
            gap: 13px;
        }

        .datos-usuario-superior {
            text-align: right;
        }

        .datos-usuario-superior strong {
            display: block;
            color: var(--texto);
            font-size: 14px;
            white-space: nowrap;
        }

        .usuario-circulo {
            width: 42px;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            color: var(--azul-oscuro);
            background: #e8eaed;
            font-size: 16px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .barra-lateral {
            position: fixed;
            top: var(--alto-barra);
            bottom: 0;
            left: 0;
            z-index: 1000;
            width: var(--ancho-menu);
            padding: 18px 12px;
            overflow-y: auto;
            background: var(--fondo);
            transition: transform 0.25s ease;
        }

        .menu {
            min-height: 100%;
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .menu-enlace {
            min-height: 48px;
            padding: 0 18px;
            display: flex;
            align-items: center;
            gap: 17px;
            border-radius: 25px;
            color: #3c4043;
            background: transparent;
            font-size: 15px;
            transition: background 0.2s, color 0.2s;
        }

        .menu-enlace:hover {
            background: #e9eef6;
        }

        .menu-enlace.activo {
            color: #0b4778;
            background: var(--azul-claro);
            font-weight: bold;
        }

        .menu-icono {
            width: 25px;
            height: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .menu-icono svg {
            width: 23px;
            height: 23px;
            fill: none;
            stroke: currentColor;
            stroke-width: 1.8;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .separador-menu {
            height: 1px;
            margin: 14px 8px;
            background: var(--borde);
        }

        .informacion-lateral {
            padding: 10px 18px;
        }

        .informacion-lateral strong {
            display: block;
            color: var(--texto);
            font-size: 13px;
        }

        .informacion-lateral span {
            display: block;
            margin-top: 4px;
            color: var(--texto-suave);
            font-size: 12px;
        }

        .formulario-salir {
            margin-top: auto;
        }

        .boton-salir-lateral {
            width: 100%;
            border: 0;
            text-align: left;
        }

        .contenido-aplicacion {
            min-height: 100vh;
            margin-left: var(--ancho-menu);
            padding-top: var(--alto-barra);
            background: var(--fondo);
            transition: margin-left 0.25s ease;
        }

        .encabezado-pagina {
            padding: 28px 40px 10px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .titulo-pagina {
            color: var(--texto);
            font-size: 28px;
            font-weight: normal;
        }

        .encabezado-usuario {
            color: var(--texto-suave);
            font-size: 13px;
            text-transform: capitalize;
        }

        .contenido-principal {
            width: 100%;
            max-width: 1500px;
            margin: 0 auto;
            padding: 22px 40px 45px;
        }

        .fondo-menu-movil {
            position: fixed;
            inset: var(--alto-barra) 0 0;
            z-index: 950;
            visibility: hidden;
            background: rgba(32, 33, 36, 0.35);
            opacity: 0;
            transition: opacity 0.25s, visibility 0.25s;
        }

        .fondo-menu-movil.visible {
            visibility: visible;
            opacity: 1;
        }

        @media (min-width: 901px) {
            .barra-lateral.oculto {
                transform: translateX(-100%);
            }

            .contenido-aplicacion.menu-oculto {
                margin-left: 0;
            }
        }

        @media (max-width: 900px) {
            .barra-superior {
                padding: 0 14px;
            }

            .barra-lateral {
                width: 280px;
                background: var(--blanco);
                transform: translateX(-100%);
                box-shadow: 5px 0 18px rgba(0, 0, 0, 0.15);
            }

            .barra-lateral.abierto {
                transform: translateX(0);
            }

            .contenido-aplicacion {
                margin-left: 0;
            }

            .encabezado-pagina {
                padding: 24px 24px 8px;
            }

            .contenido-principal {
                padding: 20px 24px 35px;
            }
        }

        @media (max-width: 600px) {
            :root {
                --alto-barra: 60px;
            }

            .barra-superior {
                padding: 0 10px;
            }

            .marca-superior img {
                width: 36px;
                height: 36px;
            }

            .marca-superior span {
                font-size: 17px;
            }

            .barra-izquierda {
                gap: 8px;
            }

            .datos-usuario-superior {
                display: none;
            }

            .usuario-circulo {
                width: 38px;
                height: 38px;
                font-size: 14px;
            }

            .encabezado-pagina {
                padding: 22px 16px 7px;
                align-items: flex-start;
                flex-direction: column;
                gap: 5px;
            }

            .titulo-pagina {
                font-size: 24px;
            }

            .contenido-principal {
                padding: 18px 16px 30px;
            }
        }
    </style>

    @yield('estilos')
    @yield('styles')
    @stack('estilos')
    @stack('styles')
</head>

<body>
    <div class="aplicacion">
        <header class="barra-superior">
            <div class="barra-izquierda">
                <button
                    type="button"
                    class="boton-menu"
                    id="botonMenu"
                    aria-label="Abrir o cerrar menú"
                >
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M4 7h16"></path>
                        <path d="M4 12h16"></path>
                        <path d="M4 17h16"></path>
                    </svg>
                </button>

                <a
                    href="{{ route('dashboard') }}"
                    class="marca-superior"
                >
                    <img
                        src="{{ asset('images/logo.png') }}"
                        alt="Logo del Cantón Bengal Vinto"
                    >

                    <span>CANTÓN BENGAL VINTO</span>
                </a>
            </div>

            <div class="barra-derecha">
                <div class="datos-usuario-superior">
                    <strong>ADMINISTRADOR</strong>
                </div>

                <div class="usuario-circulo">
                    A
                </div>
            </div>
        </header>

        <div
            class="fondo-menu-movil"
            id="fondoMenuMovil"
        ></div>

        <aside
            class="barra-lateral"
            id="barraLateral"
        >
            <nav class="menu">
                <a
                    href="{{ route('dashboard') }}"
                    class="menu-enlace {{ request()->routeIs('dashboard') ? 'activo' : '' }}"
                >
                    <span class="menu-icono">
                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M3 11 12 4l9 7"></path>
                            <path d="M5 10v10h14V10"></path>
                            <path d="M9 20v-6h6v6"></path>
                        </svg>
                    </span>

                    <span>Panel principal</span>
                </a>

                <a
                    href="{{ route('comunidades.index') }}"
                    class="menu-enlace {{ request()->routeIs('comunidades.*') ? 'activo' : '' }}"
                >
                    <span class="menu-icono">
                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M3 21V9l5-4 4 3 4-3 5 4v12"></path>
                            <path d="M8 5v16"></path>
                            <path d="M16 5v16"></path>
                            <path d="M5 12h1"></path>
                            <path d="M10 12h4"></path>
                            <path d="M18 12h1"></path>
                            <path d="M10 16h4"></path>
                        </svg>
                    </span>

                    <span>Comunidades</span>
                </a>

                <a
                    href="{{ route('aportes.index') }}"
                    class="menu-enlace {{ request()->routeIs('aportes.*') ? 'activo' : '' }}"
                >
                    <span class="menu-icono">
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
                    </span>

                    <span>Aportes</span>
                </a>

                <a
                    href="#"
                    class="menu-enlace {{ request()->routeIs('pagos.*') ? 'activo' : '' }}"
                >
                    <span class="menu-icono">
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
                    </span>

                    <span>Pagos</span>
                </a>

                <a
                    href="#"
                    class="menu-enlace {{ request()->routeIs('reuniones.*') ? 'activo' : '' }}"
                >
                    <span class="menu-icono">
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
                    </span>

                    <span>Reuniones</span>
                </a>

                <a
                    href="#"
                    class="menu-enlace {{ request()->routeIs('reportes.*') ? 'activo' : '' }}"
                >
                    <span class="menu-icono">
                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M4 20V11"></path>
                            <path d="M10 20V4"></path>
                            <path d="M16 20v-7"></path>
                            <path d="M22 20V8"></path>
                            <path d="M2 20h21"></path>
                        </svg>
                    </span>

                    <span>Reportes</span>
                </a>

                <form
                    action="{{ route('logout') }}"
                    method="POST"
                    class="formulario-salir"
                >
                    @csrf

                    <button
                        type="submit"
                        class="menu-enlace boton-salir-lateral"
                    >
                        <span class="menu-icono">
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M10 17l5-5-5-5"></path>
                                <path d="M15 12H3"></path>

                                <path
                                    d="M15 4h4a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2h-4"
                                ></path>
                            </svg>
                        </span>

                        <span>Cerrar sesión</span>
                    </button>
                </form>
            </nav>
        </aside>

        <div
            class="contenido-aplicacion"
            id="contenidoAplicacion"
        >
            <header class="encabezado-pagina">
                <h1 class="titulo-pagina">
                    @yield('encabezado', 'Panel principal')
                </h1>

                <span class="encabezado-usuario">
                    {{ auth()->user()->rol ?? 'Administrador' }}
                </span>
            </header>

            <main class="contenido-principal">
                @yield('contenido')
            </main>
        </div>
    </div>

    <script>
        const botonMenu = document.getElementById('botonMenu');
        const barraLateral = document.getElementById('barraLateral');
        const fondoMenuMovil = document.getElementById('fondoMenuMovil');
        const contenidoAplicacion =
            document.getElementById('contenidoAplicacion');

        botonMenu.addEventListener('click', function () {
            if (window.innerWidth <= 900) {
                barraLateral.classList.toggle('abierto');
                fondoMenuMovil.classList.toggle('visible');

                if (barraLateral.classList.contains('abierto')) {
                    document.body.style.overflow = 'hidden';
                } else {
                    document.body.style.overflow = '';
                }
            } else {
                barraLateral.classList.toggle('oculto');
                contenidoAplicacion.classList.toggle('menu-oculto');
            }
        });

        fondoMenuMovil.addEventListener('click', function () {
            cerrarMenuMovil();
        });

        function cerrarMenuMovil() {
            barraLateral.classList.remove('abierto');
            fondoMenuMovil.classList.remove('visible');
            document.body.style.overflow = '';
        }

        document
            .querySelectorAll('.menu-enlace')
            .forEach(function (enlace) {
                enlace.addEventListener('click', function () {
                    if (window.innerWidth <= 900) {
                        cerrarMenuMovil();
                    }
                });
            });

        window.addEventListener('resize', function () {
            if (window.innerWidth > 900) {
                cerrarMenuMovil();
            }
        });
    </script>

    @yield('scripts')
    @stack('scripts')
</body>
</html>