@extends('layouts.app')

@section('titulo', 'Detalle del comunario')
@section('encabezado', 'Comunarios')

@push('estilos')
<style>
    .detalle-pagina {
        width: 100%;
        max-width: 1050px;
        margin: 0 auto;
        color: #202124;
    }

    .detalle-encabezado {
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
    }

    .detalle-encabezado h2 {
        margin: 0 0 6px;
        color: #202124;
        font-size: 27px;
        font-weight: normal;
    }

    .detalle-encabezado p {
        margin: 0;
        color: #4b5563;
        font-size: 15px;
        font-weight: normal;
        line-height: 1.5;
    }

    .detalle-acciones {
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

    .perfil-comunario {
        padding: 25px 28px;
        margin-bottom: 22px;
        display: flex;
        align-items: center;
        gap: 20px;
        border: 1px solid #d8e0e8;
        border-radius: 10px;
        background: #ffffff;
    }

    .perfil-avatar {
        width: 72px;
        height: 72px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #cbd5e1;
        border-radius: 50%;
        color: #202124;
        background: #f8fafc;
    }

    .perfil-avatar svg {
        width: 37px;
        height: 37px;
        fill: none;
        stroke: currentColor;
        stroke-width: 1.8;
        stroke-linecap: round;
        stroke-linejoin: round;
    }

    .perfil-informacion {
        flex: 1;
        min-width: 0;
    }

    .perfil-informacion h3 {
        margin: 0 0 6px;
        color: #202124;
        font-size: 24px;
        font-weight: normal;
        overflow-wrap: anywhere;
    }

    .perfil-informacion p {
        margin: 0 0 11px;
        color: #4b5563;
        font-size: 14px;
        font-weight: normal;
    }

    .perfil-comunidad,
    .estado {
        margin-right: 7px;
        padding: 6px 11px;
        display: inline-block;
        border: 1px solid #d1d5db;
        border-radius: 20px;
        color: #202124;
        background: #f8fafc;
        font-size: 12px;
        font-weight: normal;
    }

    .estado-activo {
        border-color: #b9d8c2;
        color: #1f5130;
        background: #f4fbf6;
    }

    .estado-inactivo {
        border-color: #e2b8b8;
        color: #7f1d1d;
        background: #fff7f7;
    }

    .detalle-cuadricula {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 20px;
    }

    .detalle-tarjeta {
        padding: 24px 26px;
        border: 1px solid #d8e0e8;
        border-radius: 10px;
        background: #ffffff;
    }

    .detalle-tarjeta-titulo {
        padding-bottom: 14px;
        margin-bottom: 18px;
        border-bottom: 1px solid #e4e9ef;
    }

    .detalle-tarjeta-titulo h3 {
        margin: 0;
        color: #202124;
        font-size: 18px;
        font-weight: normal;
    }

    .datos-lista {
        display: grid;
        gap: 17px;
    }

    .dato {
        display: grid;
        grid-template-columns: 145px minmax(0, 1fr);
        gap: 15px;
        align-items: start;
    }

    .dato-etiqueta {
        color: #5f6368;
        font-size: 14px;
        font-weight: normal;
    }

    .dato-valor {
        color: #202124;
        font-size: 14px;
        font-weight: normal;
        overflow-wrap: anywhere;
    }

    .sin-informacion {
        color: #737b87;
        font-style: italic;
    }

    .administrar-estado {
        margin-top: 20px;
        padding: 22px 25px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        border: 1px solid #d8e0e8;
        border-radius: 10px;
        background: #ffffff;
    }

    .administrar-estado h3 {
        margin: 0 0 5px;
        color: #202124;
        font-size: 17px;
        font-weight: normal;
    }

    .administrar-estado p {
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
        font-family: inherit;
        font-size: 14px;
        font-weight: normal;
        cursor: pointer;
        white-space: nowrap;
    }

    .boton-desactivar {
        border: 1px solid #d9a6a6;
        color: #8b1e1e;
        background: #ffffff;
    }

    .boton-desactivar:hover {
        background: #fff5f5;
    }

    .boton-activar {
        border: 1px solid #9fc8aa;
        color: #245c34;
        background: #ffffff;
    }

    .boton-activar:hover {
        background: #f3faf5;
    }

    @media (max-width: 850px) {
        .detalle-encabezado {
            align-items: flex-start;
            flex-direction: column;
        }

        .detalle-cuadricula {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 600px) {
        .detalle-acciones {
            width: 100%;
        }

        .detalle-acciones .boton {
            flex: 1;
        }

        .perfil-comunario {
            padding: 22px 18px;
            align-items: flex-start;
            flex-direction: column;
        }

        .detalle-tarjeta {
            padding: 21px 18px;
        }

        .dato {
            grid-template-columns: 1fr;
            gap: 4px;
        }

        .administrar-estado {
            padding: 20px 18px;
            align-items: stretch;
            flex-direction: column;
        }

        .administrar-estado form,
        .boton-estado {
            width: 100%;
        }
    }
</style>
@endpush

@section('contenido')
<div class="detalle-pagina">
    <div class="detalle-encabezado">
        <div>
            <h2>Información del comunario</h2>

            <p>
                Datos personales, comunidad y cuenta de acceso.
            </p>
        </div>

        <div class="detalle-acciones">
            <a
                href="{{ route('comunarios.index', ['id_comunidad' => $comunario->id_comunidad]) }}"
                class="boton boton-volver"
            >
                Volver
            </a>

            <a
                href="{{ route('comunarios.edit', $comunario) }}"
                class="boton boton-editar"
            >
                Editar
            </a>
        </div>
    </div>

    <section class="perfil-comunario">
        <div class="perfil-avatar">
            <svg viewBox="0 0 24 24" aria-hidden="true">
                <circle cx="12" cy="8" r="4"></circle>
                <path d="M4 21v-2a8 8 0 0 1 16 0v2"></path>
            </svg>
        </div>

        <div class="perfil-informacion">
            <h3>
                {{ $comunario->nombres }}
                {{ $comunario->apellidos }}
            </h3>

            <p>
                Comunario registrado con código
                {{ $comunario->id_comunario }}
            </p>

            <span class="perfil-comunidad">
                {{ $comunario->comunidad?->nombre ?? 'Sin comunidad' }}
            </span>

            @if ($comunario->estado)
                <span class="estado estado-activo">
                    Activo
                </span>
            @else
                <span class="estado estado-inactivo">
                    Inactivo
                </span>
            @endif
        </div>
    </section>

    <div class="detalle-cuadricula">
        <section class="detalle-tarjeta">
            <div class="detalle-tarjeta-titulo">
                <h3>Datos personales</h3>
            </div>

            <div class="datos-lista">
                <div class="dato">
                    <span class="dato-etiqueta">
                        Comunidad
                    </span>

                    <span class="dato-valor">
                        {{ $comunario->comunidad?->nombre ?? 'Sin comunidad' }}
                    </span>
                </div>

                <div class="dato">
                    <span class="dato-etiqueta">
                        Cédula de identidad
                    </span>

                    <span class="dato-valor">
                        {{ $comunario->ci }}
                    </span>
                </div>

                <div class="dato">
                    <span class="dato-etiqueta">
                        Nombres
                    </span>

                    <span class="dato-valor">
                        {{ $comunario->nombres }}
                    </span>
                </div>

                <div class="dato">
                    <span class="dato-etiqueta">
                        Apellidos
                    </span>

                    <span class="dato-valor">
                        {{ $comunario->apellidos }}
                    </span>
                </div>

                <div class="dato">
                    <span class="dato-etiqueta">
                        Teléfono
                    </span>

                    @if ($comunario->telefono)
                        <span class="dato-valor">
                            {{ $comunario->telefono }}
                        </span>
                    @else
                        <span class="dato-valor sin-informacion">
                            No registrado
                        </span>
                    @endif
                </div>

                <div class="dato">
                    <span class="dato-etiqueta">
                        Dirección
                    </span>

                    @if ($comunario->direccion)
                        <span class="dato-valor">
                            {{ $comunario->direccion }}
                        </span>
                    @else
                        <span class="dato-valor sin-informacion">
                            No registrada
                        </span>
                    @endif
                </div>
            </div>
        </section>

        <section class="detalle-tarjeta">
            <div class="detalle-tarjeta-titulo">
                <h3>Datos de acceso</h3>
            </div>

            <div class="datos-lista">
                <div class="dato">
                    <span class="dato-etiqueta">
                        Nombre completo
                    </span>

                    <span class="dato-valor">
                        {{ $comunario->usuario?->nombre_completo ?? 'No registrado' }}
                    </span>
                </div>

                <div class="dato">
                    <span class="dato-etiqueta">
                        Usuario
                    </span>

                    <span class="dato-valor">
                        {{ $comunario->usuario?->usuario ?? 'No registrado' }}
                    </span>
                </div>

                <div class="dato">
                    <span class="dato-etiqueta">
                        Rol
                    </span>

                    <span class="dato-valor">
                        {{ $comunario->usuario?->rol
                            ? ucfirst($comunario->usuario->rol)
                            : 'No registrado' }}
                    </span>
                </div>

                <div class="dato">
                    <span class="dato-etiqueta">
                        Estado de la cuenta
                    </span>

                    <span class="dato-valor">
                        @if ($comunario->usuario)
                            {{ $comunario->usuario->estado
                                ? 'Activa'
                                : 'Inactiva' }}
                        @else
                            No registrada
                        @endif
                    </span>
                </div>

                <div class="dato">
                    <span class="dato-etiqueta">
                        Contraseña
                    </span>

                    <span class="dato-valor">
                        @if ($comunario->usuario)
                            Protegida y cifrada
                        @else
                            No registrada
                        @endif
                    </span>
                </div>
            </div>
        </section>
    </div>

    <section class="administrar-estado">
        <div>
            <h3>Estado del comunario</h3>

            <p>
                @if ($comunario->estado)
                    Al desactivarlo, no podrá ingresar al sistema ni recibir
                    nuevas asignaciones de aportes.
                @else
                    Al activarlo, podrá volver a ingresar al sistema y recibir
                    nuevas asignaciones de aportes.
                @endif
            </p>
        </div>

        <form
            action="{{ route('comunarios.estado', $comunario) }}"
            method="POST"
        >
            @csrf
            @method('PATCH')

            @if ($comunario->estado)
                <button
                    type="submit"
                    class="boton-estado boton-desactivar"
                    onclick="return confirm('¿Está seguro de desactivar este comunario?')"
                >
                    Desactivar comunario
                </button>
            @else
                <button
                    type="submit"
                    class="boton-estado boton-activar"
                    onclick="return confirm('¿Está seguro de activar este comunario?')"
                >
                    Activar comunario
                </button>
            @endif
        </form>
    </section>
</div>
@endsection