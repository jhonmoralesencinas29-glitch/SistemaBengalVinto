@extends('layouts.app')

@section('titulo', 'Comunidades')
@section('encabezado', 'Comunidades')

@section('contenido')
<style>
    .comunidades {
        color: #111111;
        font-weight: 400;
    }

    .encabezado-comunidades {
        min-height: 235px;
        margin-bottom: 26px;
        padding: 42px 46px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        border-radius: 22px;
        background-image:
            linear-gradient(
                 rgba(0, 5, 5, 0.45),
                 rgba(0, 5, 5, 0.10)
            ),
            url('{{ asset('images/plaza.png') }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;

    }

    .encabezado-comunidades h2 {
        margin: 0 0 8px;
        color: #ffffff;
        font-size: 30px;
        font-weight: 500;
        text-shadow: 0 2px 5px rgba(0, 0, 0, 0.45);
    }

    .encabezado-comunidades p {
        margin: 0;
        color: #ffffff;
        font-size: 16px;
        font-weight: 400;
        line-height: 1.5;
        text-shadow: 0 2px 5px rgba(0, 0, 0, 0.45);
    }

    .contenedor-tabla {
        overflow: hidden;
        border: 1px solid #d7dfe9;
        border-radius: 16px;
        background: #ffffff;
    }

    .barra-busqueda {
        padding: 22px 24px;
        display: flex;
        gap: 11px;
        border-bottom: 1px solid #dfe5ec;
    }

    .barra-busqueda input {
        width: 100%;
        max-width: 600px;
        height: 54px;
        padding: 0 16px;
        border: 1px solid #c7d1de;
        border-radius: 9px;
        background: #ffffff;
        color: #111111;
        font-size: 15px;
        font-weight: 400;
        outline: none;
    }

    .barra-busqueda input:focus {
        border-color: #1f6fc4;
        box-shadow: 0 0 0 3px rgba(31, 111, 196, 0.1);
    }

    .boton-buscar,
    .boton-limpiar {
        min-height: 54px;
        padding: 0 21px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 9px;
        font-size: 15px;
        font-weight: 400;
        text-decoration: none;
        cursor: pointer;
    }

    .boton-buscar {
        border: 1px solid #1f6fc4;
        background: #1f6fc4;
        color: #ffffff;
    }

    .boton-buscar:hover {
        border-color: #185da6;
        background: #185da6;
        color: #ffffff;
    }

    .boton-limpiar {
        border: 1px solid #c7d1de;
        background: #ffffff;
        color: #111111;
    }

    .boton-limpiar:hover {
        background: #f3f4f6;
        color: #111111;
        text-decoration: none;
    }

    .tabla-responsive {
        width: 100%;
        overflow-x: auto;
    }

    .tabla-comunidades {
        width: 100%;
        min-width: 850px;
        margin: 0;
        border-collapse: collapse;
    }

    .tabla-comunidades th {
        padding: 16px 20px;
        border-bottom: 1px solid #d7dfe9;
        background: #f3f5f8;
        color: #111111;
        font-size: 13px;
        font-weight: 500;
        text-align: left;
        white-space: nowrap;
    }

    .tabla-comunidades td {
        padding: 19px 20px;
        border-bottom: 1px solid #e1e6ed;
        background: #ffffff;
        color: #111111;
        font-size: 15px;
        font-weight: 400;
        vertical-align: middle;
    }

    .tabla-comunidades th:nth-child(3),
    .tabla-comunidades th:nth-child(4),
    .tabla-comunidades th:nth-child(5),
    .tabla-comunidades td:nth-child(3),
    .tabla-comunidades td:nth-child(4),
    .tabla-comunidades td:nth-child(5) {
        text-align: center;
    }

    .tabla-comunidades tbody tr:hover td {
        background: #fafbfd;
    }

    .tabla-comunidades tbody tr:last-child td {
        border-bottom: none;
    }

    .nombre-comunidad {
        color: #111111;
        font-size: 15px;
        font-weight: 400;
        text-decoration: none;
    }

    .nombre-comunidad:hover {
        color: #111111;
        text-decoration: underline;
    }

    .cantidad {
        display: inline;
        color: #111111;
        background: transparent;
        font-size: 15px;
        font-weight: 400;
    }

    .boton-comunarios {
        min-height: 40px;
        padding: 0 16px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #1f6fc4;
        border-radius: 8px;
        background: #1f6fc4;
        color: #ffffff;
        font-size: 14px;
        font-weight: 400;
        text-decoration: none;
        white-space: nowrap;
    }

    .boton-comunarios:hover {
        border-color: #185da6;
        background: #185da6;
        color: #ffffff;
        text-decoration: none;
    }

    .sin-registros {
        padding: 45px 20px !important;
        color: #111111 !important;
        font-weight: 400;
        text-align: center;
    }

    @media (max-width: 700px) {
        .encabezado-comunidades {
            min-height: 265px;
            padding: 30px 24px;
            border-radius: 22px;
            background-position: center;
        }

        .encabezado-comunidades h2 {
            font-size: 24px;
        }

        .encabezado-comunidades p {
            font-size: 14px;
        }

        .contenedor-tabla {
            border-radius: 14px;
        }

        .barra-busqueda {
            padding: 18px;
            flex-direction: column;
        }

        .barra-busqueda input {
            max-width: none;
        }

        .boton-buscar,
        .boton-limpiar {
            width: 100%;
        }
    }
</style>

<div class="comunidades">
    <div class="encabezado-comunidades">
        <h2>Comunidades del Cantón Bengal Vinto</h2>

        <p>
            Selecciona una comunidad para consultar y administrar sus comunarios.
        </p>
    </div>

    <div class="contenedor-tabla">
        <form
            action="{{ route('comunidades.index') }}"
            method="GET"
            class="barra-busqueda"
        >
            <input
                type="text"
                name="buscar"
                value="{{ $buscar }}"
                placeholder="Buscar comunidad"
            >

            <button type="submit" class="boton-buscar">
                Buscar
            </button>

            @if ($buscar)
                <a
                    href="{{ route('comunidades.index') }}"
                    class="boton-limpiar"
                >
                    Limpiar
                </a>
            @endif
        </form>

        <div class="tabla-responsive">
            <table class="tabla-comunidades">
                <thead>
                    <tr>
                        <th>COMUNIDAD</th>
                        <th>DESCRIPCIÓN</th>
                        <th>TOTAL DE COMUNARIOS</th>
                        <th>CONTRIBUYENTES ACTIVOS</th>
                        <th>ACCIONES</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($comunidades as $comunidad)
                        <tr>
                            <td>
                                <a
                                    href="{{ route(
                                        'comunarios.index',
                                        [
                                            'id_comunidad' =>
                                                $comunidad->id_comunidad
                                        ]
                                    ) }}"
                                    class="nombre-comunidad"
                                >
                                    {{ $comunidad->nombre }}
                                </a>
                            </td>

                            <td>
                                {{ $comunidad->descripcion
                                    ?: 'Comunidad perteneciente al Cantón Bengal Vinto' }}
                            </td>

                            <td>
                                <span class="cantidad">
                                    {{ $comunidad->comunarios_count }}
                                </span>
                            </td>

                            <td>
                                <span class="cantidad">
                                    {{ $comunidad->comunarios_activos_count }}
                                </span>
                            </td>

                            <td>
                                <a
                                    href="{{ route(
                                        'comunarios.index',
                                        [
                                            'id_comunidad' =>
                                                $comunidad->id_comunidad
                                        ]
                                    ) }}"
                                    class="boton-comunarios"
                                >
                                    Ver comunarios
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="sin-registros">
                                No se encontraron comunidades.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection