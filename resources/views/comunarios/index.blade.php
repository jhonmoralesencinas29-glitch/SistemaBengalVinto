@extends('layouts.app')

@section('titulo', 'Comunarios')
@section('encabezado', 'Comunarios')

@push('estilos')
<style>
    .comunarios-contenedor {
        color: #111111;
        font-weight: 400;
    }

    .cabecera-listado {
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
    }

    .cabecera-listado h2 {
        margin: 0 0 7px;
        color: #111111;
        font-size: 27px;
        font-weight: 500;
    }

    .cabecera-listado p {
        margin: 0;
        color: #333333;
        font-size: 15px;
        font-weight: 400;
    }

    .acciones-cabecera {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .boton-nuevo,
    .boton-volver {
        min-height: 48px;
        padding: 0 20px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 9px;
        color: #111111;
        font-size: 15px;
        font-weight: 400;
        text-decoration: none;
        white-space: nowrap;
    }

    .boton-nuevo {
        border: 1px solid #1f6fc4;
        background: #1f6fc4;
        color: #ffffff;
    }

    .boton-nuevo:hover {
        border-color: #185da6;
        background: #185da6;
        color: #ffffff;
    }

    .boton-volver {
        border: 1px solid #c7d1de;
        background: #ffffff;
    }

    .boton-volver:hover {
        background: #f3f4f6;
        color: #111111;
    }

    .mensaje-exito {
        margin-bottom: 20px;
        padding: 14px 17px;
        border: 1px solid #b8d8c1;
        border-radius: 9px;
        background: #f4faf6;
        color: #111111;
        font-size: 14px;
        font-weight: 400;
    }

    .panel {
        overflow: hidden;
        border: 1px solid #d7dfe9;
        border-radius: 16px;
        background: #ffffff;
    }

    .barra {
        padding: 22px 24px;
        border-bottom: 1px solid #dfe5ec;
    }

    .buscador {
        display: grid;
        grid-template-columns: minmax(250px, 1fr) auto auto;
        gap: 10px;
    }

    .buscador input {
        width: 100%;
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

    .buscador input:focus {
        border-color: #1f6fc4;
        box-shadow: 0 0 0 3px rgba(31, 111, 196, 0.1);
    }

    .boton-buscar,
    .boton-limpiar {
        height: 54px;
        padding: 0 21px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 9px;
        font-size: 15px;
        font-weight: 400;
        cursor: pointer;
        text-decoration: none;
    }

    .boton-buscar {
        border: 1px solid #1f6fc4;
        background: #1f6fc4;
        color: #ffffff;
    }

    .boton-buscar:hover {
        border-color: #185da6;
        background: #185da6;
    }

    .boton-limpiar {
        border: 1px solid #c7d1de;
        background: #ffffff;
        color: #111111;
    }

    .boton-limpiar:hover {
        background: #f3f4f6;
        color: #111111;
    }

    .tabla-contenedor {
        width: 100%;
        overflow-x: auto;
    }

    .tabla-comunarios {
        width: 100%;
        min-width: 1000px;
        margin: 0;
        border-collapse: collapse;
    }

    .tabla-comunarios th {
        padding: 16px 18px;
        border-bottom: 1px solid #d7dfe9;
        background: #f3f5f8;
        color: #111111;
        font-size: 13px;
        font-weight: 500;
        text-align: left;
        white-space: nowrap;
    }

    .tabla-comunarios td {
        padding: 19px 18px;
        border-bottom: 1px solid #e1e6ed;
        background: #ffffff;
        color: #111111;
        font-size: 14px;
        font-weight: 400;
        vertical-align: middle;
    }

    .tabla-comunarios tbody tr:hover td {
        background: #fafbfd;
    }

    .tabla-comunarios tbody tr:last-child td {
        border-bottom: none;
    }

    .nombre {
        color: #111111;
        font-size: 14px;
        font-weight: 400;
    }

    .dato-secundario {
        margin-top: 5px;
        color: #333333;
        font-size: 12px;
        font-weight: 400;
    }

    .estado {
        display: inline-block;
        padding: 6px 11px;
        border: 1px solid #c7d1de;
        border-radius: 20px;
        background: #ffffff;
        color: #111111;
        font-size: 12px;
        font-weight: 400;
    }

    .estado-inactivo {
        color: #555555;
        background: #f5f5f5;
    }

    .acciones-tabla {
        display: flex;
        align-items: center;
        gap: 7px;
    }

    .acciones-tabla form {
        margin: 0;
    }

    .accion {
        min-height: 38px;
        padding: 0 13px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #c7d1de;
        border-radius: 8px;
        background: #ffffff;
        color: #111111;
        font-size: 13px;
        font-weight: 400;
        text-decoration: none;
        cursor: pointer;
        white-space: nowrap;
    }

    .accion:hover {
        border-color: #1f6fc4;
        background: #f4f8fd;
        color: #111111;
    }

    .accion-desactivar {
        border-color: #d9aaaa;
        color: #9b2525;
    }

    .accion-desactivar:hover {
        border-color: #bd7373;
        background: #fff7f7;
        color: #861d1d;
    }

    .accion-activar {
        border-color: #a8cdb3;
        color: #226b37;
    }

    .accion-activar:hover {
        border-color: #78ad88;
        background: #f6fbf7;
        color: #18582b;
    }

    .sin-registros {
        padding: 50px 20px;
        color: #111111;
        font-size: 14px;
        font-weight: 400;
        text-align: center;
    }

    .sin-registros strong {
        display: block;
        margin-bottom: 8px;
        font-size: 18px;
        font-weight: 500;
    }

    .paginacion {
        padding: 18px 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        border-top: 1px solid #dfe5ec;
        color: #111111;
        font-size: 13px;
        font-weight: 400;
    }

    .paginacion-botones {
        display: flex;
        gap: 8px;
    }

    .pagina-boton {
        padding: 9px 14px;
        border: 1px solid #c7d1de;
        border-radius: 7px;
        background: #ffffff;
        color: #111111;
        font-weight: 400;
        text-decoration: none;
    }

    .pagina-boton:hover {
        border-color: #1f6fc4;
        background: #f4f8fd;
        color: #111111;
    }

    .pagina-deshabilitada {
        opacity: 0.45;
        pointer-events: none;
    }

    @media (max-width: 750px) {
        .cabecera-listado {
            align-items: flex-start;
            flex-direction: column;
        }

        .acciones-cabecera {
            width: 100%;
        }

        .boton-volver,
        .boton-nuevo {
            flex: 1;
        }

        .buscador {
            grid-template-columns: 1fr;
        }

        .boton-buscar,
        .boton-limpiar {
            width: 100%;
        }

        .paginacion {
            align-items: flex-start;
            flex-direction: column;
        }
    }

    @media (max-width: 450px) {
        .acciones-cabecera {
            align-items: stretch;
            flex-direction: column;
        }
    }
</style>
@endpush

@section('contenido')
<div class="comunarios-contenedor">
    @if (session('exito'))
        <div class="mensaje-exito">
            {{ session('exito') }}
        </div>
    @endif

    <div class="cabecera-listado">
        <div>
            <h2>
                Comunarios de {{ $comunidadSeleccionada->nombre }}
            </h2>

            <p>
                Consulta y administra los comunarios pertenecientes
                a esta comunidad.
            </p>
        </div>

        <div class="acciones-cabecera">
            <a
                href="{{ route('comunidades.index') }}"
                class="boton-volver"
            >
                Volver a comunidades
            </a>

            <a
                href="{{ route('comunarios.create', [
                    'id_comunidad' =>
                        $comunidadSeleccionada->id_comunidad
                ]) }}"
                class="boton-nuevo"
            >
                Nuevo comunario
            </a>
        </div>
    </div>

    <section class="panel">
        <div class="barra">
            <form
                method="GET"
                action="{{ route('comunarios.index') }}"
                class="buscador"
            >
                <input
                    type="hidden"
                    name="id_comunidad"
                    value="{{ $comunidadSeleccionada->id_comunidad }}"
                >

                <input
                    type="search"
                    name="buscar"
                    value="{{ $buscar }}"
                    placeholder="Buscar por nombre, apellido, CI o usuario"
                >

                <button type="submit" class="boton-buscar">
                    Buscar
                </button>

                @if ($buscar)
                    <a
                        href="{{ route('comunarios.index', [
                            'id_comunidad' =>
                                $comunidadSeleccionada->id_comunidad
                        ]) }}"
                        class="boton-limpiar"
                    >
                        Limpiar
                    </a>
                @endif
            </form>
        </div>

        @if ($comunarios->count())
            <div class="tabla-contenedor">
                <table class="tabla-comunarios">
                    <thead>
                        <tr>
                            <th>COMUNARIO</th>
                            <th>CI</th>
                            <th>USUARIO</th>
                            <th>TELÉFONO</th>
                            <th>DIRECCIÓN</th>
                            <th>ESTADO</th>
                            <th>ACCIONES</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($comunarios as $comunario)
                            <tr>
                                <td>
                                    <div class="nombre">
                                        {{ $comunario->nombres }}
                                        {{ $comunario->apellidos }}
                                    </div>

                                    <div class="dato-secundario">
                                        N.º:
                                        {{ $comunario->numero_comunidad }}
                                    </div>
                                </td>

                                <td>
                                    {{ $comunario->ci }}
                                </td>

                                <td>
                                    {{ $comunario->usuario?->usuario
                                        ?? 'Sin usuario' }}
                                </td>

                                <td>
                                    {{ $comunario->telefono
                                        ?: 'Sin teléfono' }}
                                </td>

                                <td>
                                    {{ $comunario->direccion
                                        ?: 'Sin dirección' }}
                                </td>

                                <td>
                                    @if ($comunario->estado)
                                        <span class="estado">
                                            Activo
                                        </span>
                                    @else
                                        <span class="estado estado-inactivo">
                                            Inactivo
                                        </span>
                                    @endif
                                </td>

                                <td>
                                    <div class="acciones-tabla">
                                        <a
                                            href="{{ route(
                                                'comunarios.show',
                                                $comunario
                                            ) }}"
                                            class="accion"
                                        >
                                            Ver
                                        </a>

                                        <a
                                            href="{{ route(
                                                'comunarios.edit',
                                                $comunario
                                            ) }}"
                                            class="accion"
                                        >
                                            Editar
                                        </a>

                                        <form
                                            method="POST"
                                            action="{{ route(
                                                'comunarios.estado',
                                                $comunario
                                            ) }}"
                                            onsubmit="return confirm('¿Desea cambiar el estado de este comunario?')"
                                        >
                                            @csrf
                                            @method('PATCH')

                                            <button
                                                type="submit"
                                                class="accion {{ $comunario->estado
                                                    ? 'accion-desactivar'
                                                    : 'accion-activar' }}"
                                            >
                                                {{ $comunario->estado
                                                    ? 'Desactivar'
                                                    : 'Activar' }}
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="paginacion">
                <span>
                    Mostrando {{ $comunarios->firstItem() }}
                    a {{ $comunarios->lastItem() }}
                    de {{ $comunarios->total() }} registros
                </span>

                <div class="paginacion-botones">
                    <a
                        href="{{ $comunarios->previousPageUrl() ?: '#' }}"
                        class="pagina-boton {{ $comunarios->onFirstPage()
                            ? 'pagina-deshabilitada'
                            : '' }}"
                    >
                        Anterior
                    </a>

                    <a
                        href="{{ $comunarios->nextPageUrl() ?: '#' }}"
                        class="pagina-boton {{ !$comunarios->hasMorePages()
                            ? 'pagina-deshabilitada'
                            : '' }}"
                    >
                        Siguiente
                    </a>
                </div>
            </div>
        @else
            <div class="sin-registros">
                <strong>No se encontraron comunarios</strong>

                @if ($buscar)
                    No existen resultados para la búsqueda realizada.
                @else
                    Esta comunidad todavía no tiene comunarios registrados.
                @endif
            </div>
        @endif
    </section>
</div>
@endsection