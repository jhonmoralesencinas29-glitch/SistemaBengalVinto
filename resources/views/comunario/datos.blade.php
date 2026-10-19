@extends('layouts.comunario')

@section('titulo', 'Mis datos personales')
@section('encabezado', 'Mis datos personales')

@section('contenido')
<style>
    .pagina-datos {
        width: 100%;
        max-width: 1400px;
        margin: 0 auto;
        color: #202124;
    }

    .encabezado-datos {
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

    .encabezado-datos h2 {
        margin: 0 0 8px;
        color: #ffffff;
        font-size: 30px;
        font-weight: 600;
        text-shadow: 0 2px 5px rgba(0, 0, 0, 0.45);
    }

    .encabezado-datos p {
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

    .contenedor-datos {
        overflow: hidden;
        border: 1px solid #d8e0e8;
        border-radius: 14px;
        background: #ffffff;
    }

    .perfil-superior {
        padding: 26px;
        display: flex;
        align-items: center;
        gap: 18px;
        border-bottom: 1px solid #e6ebf0;
        background: #fafbfc;
    }

    .avatar-comunario {
        width: 64px;
        height: 64px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        border-radius: 50%;
        color: #ffffff;
        background: #202124;
        font-size: 25px;
        font-weight: 700;
        text-transform: uppercase;
    }

    .perfil-nombre h3 {
        margin: 0 0 5px;
        color: #202124;
        font-size: 22px;
        font-weight: 600;
    }

    .perfil-nombre p {
        margin: 0;
        color: #5f6368;
        font-size: 14px;
    }

    .contenido-datos {
        padding: 26px;
    }

    .seccion-datos {
        margin-bottom: 28px;
    }

    .seccion-datos:last-child {
        margin-bottom: 0;
    }

    .seccion-datos h4 {
        margin: 0 0 16px;
        padding-bottom: 10px;
        border-bottom: 1px solid #e6ebf0;
        color: #202124;
        font-size: 18px;
        font-weight: 600;
    }

    .datos-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 16px;
    }

    .dato-personal {
        min-width: 0;
        padding: 17px;
        border: 1px solid #dfe5eb;
        border-radius: 9px;
        background: #ffffff;
    }

    .dato-personal span {
        display: block;
        margin-bottom: 7px;
        color: #6b7280;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
    }

    .dato-personal strong {
        display: block;
        color: #202124;
        font-size: 15px;
        font-weight: 600;
        overflow-wrap: anywhere;
    }

    .estado-cuenta {
        display: inline-flex !important;
        width: auto;
        padding: 6px 12px;
        border-radius: 20px;
        color: #ffffff !important;
        background: #202124;
        font-size: 12px !important;
        text-transform: uppercase;
    }

    .mensaje-informativo {
        margin-top: 24px;
        padding: 16px 18px;
        border-left: 4px solid #202124;
        border-radius: 7px;
        color: #4b5563;
        background: #f7f8fa;
        font-size: 14px;
        line-height: 1.5;
    }

    .mensaje-informativo strong {
        color: #202124;
    }

    @media (max-width: 900px) {
        .datos-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 650px) {
        .encabezado-datos {
            min-height: 180px;
            padding: 26px 22px;
            align-items: flex-start;
            flex-direction: column;
            justify-content: center;
            border-radius: 16px;
        }

        .encabezado-datos h2 {
            font-size: 25px;
        }

        .encabezado-datos p {
            font-size: 14px;
        }

        .boton-volver {
            width: 100%;
        }

        .perfil-superior {
            align-items: flex-start;
            padding: 20px;
        }

        .contenido-datos {
            padding: 20px;
        }

        .datos-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="pagina-datos">
    <div class="encabezado-datos">
        <div>
            <h2>Mis datos personales</h2>

            <p>
                Consulta la información registrada en tu cuenta.
            </p>
        </div>

        <a
            href="{{ route('comunario.panel') }}"
            class="boton-volver"
        >
            Volver al panel
        </a>
    </div>

    <div class="contenedor-datos">
        <div class="perfil-superior">
            <div class="avatar-comunario">
                {{ strtoupper(substr($comunario->nombres, 0, 1)) }}
            </div>

            <div class="perfil-nombre">
                <h3>
                    {{ $comunario->nombres }}
                    {{ $comunario->apellidos }}
                </h3>

                <p>
                    Comunario de
                    {{ $comunario->comunidad->nombre ?? 'comunidad no registrada' }}
                </p>
            </div>
        </div>

        <div class="contenido-datos">
            <div class="seccion-datos">
                <h4>Información personal</h4>

                <div class="datos-grid">
                    @if (!empty($comunario->numero_comunidad))
                        <div class="dato-personal">
                            <span>Número en la comunidad</span>

                            <strong>
                                {{ $comunario->numero_comunidad }}
                            </strong>
                        </div>
                    @endif

                    <div class="dato-personal">
                        <span>Nombres</span>

                        <strong>
                            {{ $comunario->nombres }}
                        </strong>
                    </div>

                    <div class="dato-personal">
                        <span>Apellidos</span>

                        <strong>
                            {{ $comunario->apellidos }}
                        </strong>
                    </div>

                    <div class="dato-personal">
                        <span>Cédula de identidad</span>

                        <strong>
                            {{ $comunario->ci }}
                        </strong>
                    </div>

                    <div class="dato-personal">
                        <span>Comunidad</span>

                        <strong>
                            {{ $comunario->comunidad->nombre ?? 'Sin comunidad' }}
                        </strong>
                    </div>

                    <div class="dato-personal">
                        <span>Teléfono</span>

                        <strong>
                            {{ $comunario->telefono ?: 'No registrado' }}
                        </strong>
                    </div>

                    <div class="dato-personal">
                        <span>Dirección</span>

                        <strong>
                            {{ $comunario->direccion ?: 'No registrada' }}
                        </strong>
                    </div>

                    <div class="dato-personal">
                        <span>Estado</span>

                        <strong class="estado-cuenta">
                            {{ $comunario->estado ? 'Activo' : 'Inactivo' }}
                        </strong>
                    </div>
                </div>
            </div>

            <div class="seccion-datos">
                <h4>Información de acceso</h4>

                <div class="datos-grid">
                    <div class="dato-personal">
                        <span>Usuario</span>

                        <strong>
                            {{ $comunario->usuario->usuario }}
                        </strong>
                    </div>

                    <div class="dato-personal">
                        <span>Rol</span>

                        <strong>
                            Comunario
                        </strong>
                    </div>

                    <div class="dato-personal">
                        <span>Estado de la cuenta</span>

                        <strong class="estado-cuenta">
                            {{ $comunario->usuario->estado ? 'Activa' : 'Inactiva' }}
                        </strong>
                    </div>
                </div>
            </div>

            <div class="mensaje-informativo">
                <strong>Importante:</strong>
                si alguno de tus datos personales es incorrecto, comunícate con
                la autoridad encargada para solicitar su actualización.
            </div>
        </div>
    </div>
</div>
@endsection