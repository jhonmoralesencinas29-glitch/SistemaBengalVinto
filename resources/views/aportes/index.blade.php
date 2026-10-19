@extends('layouts.app')

@section('titulo', 'Aportes')
@section('encabezado', 'Aportes')

@push('estilos')
<style>
    .pagina-aportes {
        width: 100%;
        max-width: 1400px;
        margin: 0 auto;
        color: #202124;
    }

    .encabezado-aportes {
        min-height: 235px;
        margin-bottom: 26px;
        padding: 42px 46px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 25px;
        border-radius: 22px;
        background-color: #4b4b4b;
        background-image:
            linear-gradient(
                 rgba(0, 0, 0, 0.45),
                 rgba(0, 0, 0, 0.10)
            ),
            url('{{ asset('images/comunarios.jpg') }}');
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        overflow: hidden;

    }

    .encabezado-aportes h2 {
        margin: 0 0 8px;
        color: #ffffff;
        font-size: 29px;
        font-weight: 600;
        text-shadow: 0 2px 5px rgba(0, 0, 0, 0.45);
    }

    .encabezado-aportes p {
        margin: 0;
        color: #ffffff;
        font-size: 15px;
        font-weight: normal;
        line-height: 1.5;
        text-shadow: 0 2px 5px rgba(0, 0, 0, 0.45);
    }

    .boton-nuevo {
        min-height: 46px;
        padding: 0 19px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        border: 1px solid #ffffff;
        border-radius: 7px;
        color: #202124;
        background: #ffffff;
        font-size: 14px;
        font-weight: normal;
        text-decoration: none;
    }

    .boton-nuevo:hover {
        color: #ffffff;
        background: transparent;
    }

    .mensaje-exito {
        margin-bottom: 20px;
        padding: 14px 17px;
        border: 1px solid #b7d1bf;
        border-radius: 7px;
        color: #245c34;
        background: #f4faf6;
        font-size: 14px;
        font-weight: normal;
    }

    .contenedor-aportes {
        overflow: hidden;
        border: 1px solid #d7dce2;
        border-radius: 10px;
        background: #ffffff;
    }

    .filtros-aportes {
        padding: 18px;
        display: grid;
        grid-template-columns: minmax(260px, 1fr) 190px auto auto;
        gap: 10px;
        border-bottom: 1px solid #d7dce2;
    }

    .campo-busqueda input,
    .filtro-estado {
        width: 100%;
        min-height: 45px;
        padding: 0 13px;
        border: 1px solid #bfc7d1;
        border-radius: 7px;
        outline: none;
        color: #202124;
        background: #ffffff;
        font-family: inherit;
        font-size: 14px;
        font-weight: normal;
        box-sizing: border-box;
    }

    .campo-busqueda input:hover,
    .filtro-estado:hover {
        border-color: #9ca3af;
    }

    .campo-busqueda input:focus,
    .filtro-estado:focus {
        border-color: #1669c1;
        box-shadow: 0 0 0 3px rgba(22, 105, 193, 0.08);
    }

    .campo-busqueda input::placeholder {
        color: #737b87;
        opacity: 1;
    }

    .boton-buscar,
    .boton-limpiar {
        min-height: 45px;
        padding: 0 17px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 7px;
        font-family: inherit;
        font-size: 14px;
        font-weight: normal;
        text-decoration: none;
        box-sizing: border-box;
    }

    .boton-buscar {
        border: 1px solid #1669c1;
        color: #ffffff;
        background: #1669c1;
        cursor: pointer;
    }

    .boton-buscar:hover {
        border-color: #1259a6;
        background: #1259a6;
    }

    .boton-limpiar {
        border: 1px solid #bfc7d1;
        color: #202124;
        background: #ffffff;
    }

    .boton-limpiar:hover {
        background: #f3f4f6;
    }

    .tabla-responsive {
        width: 100%;
        overflow-x: auto;
    }

    .tabla-aportes {
        width: 100%;
        min-width: 1050px;
        border-collapse: collapse;
    }

    .tabla-aportes th {
        padding: 14px 16px;
        border-bottom: 1px solid #d7dce2;
        color: #202124;
        background: #f7f8fa;
        font-size: 12px;
        font-weight: normal;
        text-align: left;
        text-transform: uppercase;
    }

    .tabla-aportes td {
        padding: 17px 16px;
        border-bottom: 1px solid #e2e5e9;
        color: #202124;
        font-size: 14px;
        font-weight: normal;
        vertical-align: middle;
    }

    .tabla-aportes tbody tr:last-child td {
        border-bottom: none;
    }

    .tabla-aportes tbody tr:hover {
        background: #fafafa;
    }

    .aporte-concepto {
        display: block;
        margin-bottom: 5px;
        color: #202124;
        font-size: 14px;
        font-weight: normal;
    }

    .aporte-codigo {
        color: #5f6368;
        font-size: 12px;
        font-weight: normal;
    }

    .aporte-monto {
        display: block;
        color: #202124;
        font-size: 15px;
        font-weight: normal;
        white-space: nowrap;
    }

    .monto-pendiente {
        display: block;
        margin-top: 5px;
        color: #5f6368;
        font-size: 12px;
        font-weight: normal;
        white-space: nowrap;
    }

    .periodo-aporte {
        min-width: 145px;
        line-height: 1.6;
    }

    .periodo-aporte span {
        display: block;
        color: #202124;
        font-weight: normal;
        white-space: nowrap;
    }

    .periodo-aporte strong {
        color: #5f6368;
        font-size: 12px;
        font-weight: normal;
    }

    .columna-centrada {
        text-align: center !important;
    }

    .cantidad {
        display: inline-flex;
        min-width: 35px;
        height: 30px;
        align-items: center;
        justify-content: center;
        border: 1px solid #d7dce2;
        border-radius: 6px;
        color: #202124;
        background: #ffffff;
        font-weight: normal;
    }

    .estado-aporte {
        display: inline-block;
        padding: 6px 11px;
        border: 1px solid #c8cdd3;
        border-radius: 20px;
        color: #202124;
        background: #f7f8fa;
        font-size: 12px;
        font-weight: normal;
    }

    .estado-activo {
        border-color: #b9d8c2;
        color: #245c34;
        background: #f4faf6;
    }

    .estado-inactivo {
        border-color: #d1d5db;
        color: #4b5563;
        background: #f7f8fa;
    }

    .acciones {
        display: flex;
        align-items: center;
        gap: 7px;
        white-space: nowrap;
    }

    .acciones form {
        margin: 0;
    }

    .accion {
        min-height: 36px;
        padding: 0 11px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #bfc7d1;
        border-radius: 7px;
        color: #202124;
        background: #ffffff;
        font-family: inherit;
        font-size: 12px;
        font-weight: normal;
        text-decoration: none;
        cursor: pointer;
        box-sizing: border-box;
    }

    .accion:hover {
        background: #f1f3f4;
    }

    .accion-desactivar {
        border-color: #d9a6a6;
        color: #8b1e1e;
    }

    .accion-desactivar:hover {
        background: #fff5f5;
    }

    .accion-activar {
        border-color: #9fc8aa;
        color: #245c34;
    }

    .accion-activar:hover {
        background: #f3faf5;
    }

    .sin-registros {
        padding: 50px 20px;
        color: #202124;
        text-align: center;
    }

    .sin-registros h3 {
        margin: 0 0 7px;
        color: #202124;
        font-size: 18px;
        font-weight: normal;
    }

    .sin-registros p {
        margin: 0;
        color: #5f6368;
        font-size: 14px;
        font-weight: normal;
    }

    .paginacion-aportes {
        padding: 17px 19px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        border-top: 1px solid #d7dce2;
        color: #202124;
        background: #fafafa;
        font-size: 13px;
        font-weight: normal;
    }

    .paginacion-enlaces {
        display: flex;
        gap: 8px;
    }

    .pagina-boton {
        min-height: 38px;
        padding: 0 13px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #bfc7d1;
        border-radius: 7px;
        color: #202124;
        background: #ffffff;
        font-size: 13px;
        font-weight: normal;
        text-decoration: none;
    }

    .pagina-boton:hover {
        background: #f1f3f4;
    }

    .pagina-boton.deshabilitado {
        color: #8a8a8a;
        background: #f5f5f5;
        pointer-events: none;
    }

    @media (max-width: 850px) {
        .filtros-aportes {
            grid-template-columns: 1fr 190px;
        }
    }

    @media (max-width: 650px) {
        .encabezado-aportes {
            min-height: 265px;
            padding: 30px 24px;
            align-items: flex-start;
            justify-content: center;
            flex-direction: column;
            border-radius: 22px;
        }

        .encabezado-aportes h2 {
            font-size: 24px;
        }

        .boton-nuevo {
            width: 100%;
        }

        .filtros-aportes {
            grid-template-columns: 1fr;
        }

        .boton-buscar,
        .boton-limpiar {
            width: 100%;
        }

        .paginacion-aportes {
            align-items: stretch;
            flex-direction: column;
        }

        .paginacion-enlaces {
            justify-content: space-between;
        }
    }
</style>
@endpush

@section('contenido')
@php
    $aportes->getCollection()->loadSum(
        'aportesComunarios as monto_total_esperado',
        'monto_asignado'
    );

    $aportes->getCollection()->loadSum(
        'aportesComunarios as saldo_total_pendiente',
        'saldo'
    );
@endphp

<div class="pagina-aportes">
    <div class="encabezado-aportes">
        <div>
            <h2>Gestión de aportes</h2>

            <p>
                Consulta y administra los aportes de la comunidad.
            </p>
        </div>

        <a
            href="{{ route('aportes.create') }}"
            class="boton-nuevo"
        >
            Nuevo aporte
        </a>
    </div>

    @if (session('exito'))
        <div class="mensaje-exito">
            {{ session('exito') }}
        </div>
    @endif

    <section class="contenedor-aportes">
        <form
            action="{{ route('aportes.index') }}"
            method="GET"
            class="filtros-aportes"
        >
            <div class="campo-busqueda">
                <input
                    type="search"
                    name="buscar"
                    value="{{ $buscar }}"
                    placeholder="Buscar por concepto o tipo de aporte"
                >
            </div>

            <select name="estado" class="filtro-estado">
                <option value="">
                    Todos los estados
                </option>

                <option
                    value="activo"
                    @selected($estado === 'activo')
                >
                    Activos
                </option>

                <option
                    value="inactivo"
                    @selected($estado === 'inactivo')
                >
                    Inactivos
                </option>
            </select>

            <button type="submit" class="boton-buscar">
                Buscar
            </button>

            @if ($buscar || $estado)
                <a
                    href="{{ route('aportes.index') }}"
                    class="boton-limpiar"
                >
                    Limpiar
                </a>
            @endif
        </form>

        @if ($aportes->count())
            <div class="tabla-responsive">
                <table class="tabla-aportes">
                    <thead>
                        <tr>
                            <th>Aporte</th>
                            <th>Tipo</th>
                            <th>Total esperado</th>
                            <th>Periodo</th>

                            <th class="columna-centrada">
                                Comunarios asignados
                            </th>

                            <th class="columna-centrada">
                                Estado
                            </th>

                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($aportes as $aporte)
                            <tr>
                                <td>
                                    <span class="aporte-concepto">
                                        {{ $aporte->concepto }}
                                    </span>

                                    <span class="aporte-codigo">
                                        Código:
                                        {{ $aporte->id_aporte }}
                                    </span>
                                </td>

                                <td>
                                    {{ $aporte->tipoAporte?->nombre ?? 'Sin tipo' }}
                                </td>

                                <td>
                                    <span class="aporte-monto">
                                        Bs
                                        {{ number_format(
                                            $aporte->monto_total_esperado ?? 0,
                                            2,
                                            ',',
                                            '.'
                                        ) }}
                                    </span>

                                    <span class="monto-pendiente">
                                        Pendiente: Bs
                                        {{ number_format(
                                            $aporte->saldo_total_pendiente ?? 0,
                                            2,
                                            ',',
                                            '.'
                                        ) }}
                                    </span>
                                </td>

                                <td>
                                    <div class="periodo-aporte">
                                        <span>
                                            <strong>Inicio:</strong>

                                            {{ $aporte->fecha_creacion
                                                ? $aporte->fecha_creacion->format('d/m/Y')
                                                : 'Sin fecha' }}
                                        </span>

                                        <span>
                                            <strong>Vence:</strong>

                                            {{ $aporte->fecha_vencimiento
                                                ? $aporte->fecha_vencimiento->format('d/m/Y')
                                                : 'Sin fecha' }}
                                        </span>
                                    </div>
                                </td>

                                <td class="columna-centrada">
                                    <span class="cantidad">
                                        {{ $aporte->aportes_comunarios_count ?? 0 }}
                                    </span>
                                </td>

                                <td class="columna-centrada">
                                    <span
                                        class="estado-aporte {{ $aporte->estado === 'activo' ? 'estado-activo' : 'estado-inactivo' }}"
                                    >
                                        {{ $aporte->estado === 'activo'
                                            ? 'Activo'
                                            : 'Inactivo' }}
                                    </span>
                                </td>

                                <td>
                                    <div class="acciones">
                                        <a
                                            href="{{ route('aportes.show', $aporte) }}"
                                            class="accion"
                                        >
                                            Ver
                                        </a>

                                        <a
                                            href="{{ route('aportes.edit', $aporte) }}"
                                            class="accion"
                                        >
                                            Editar
                                        </a>

                                        <form
                                            action="{{ route('aportes.estado', $aporte) }}"
                                            method="POST"
                                        >
                                            @csrf
                                            @method('PATCH')

                                            @if ($aporte->estado === 'activo')
                                                <button
                                                    type="submit"
                                                    class="accion accion-desactivar"
                                                    onclick="return confirm('¿Desea desactivar este aporte?')"
                                                >
                                                    Desactivar
                                                </button>
                                            @else
                                                <button
                                                    type="submit"
                                                    class="accion accion-activar"
                                                    onclick="return confirm('¿Desea activar este aporte?')"
                                                >
                                                    Activar
                                                </button>
                                            @endif
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="paginacion-aportes">
                <span>
                    Mostrando
                    {{ $aportes->firstItem() }}
                    a
                    {{ $aportes->lastItem() }}
                    de
                    {{ $aportes->total() }}
                    registros
                </span>

                <div class="paginacion-enlaces">
                    @if ($aportes->onFirstPage())
                        <span class="pagina-boton deshabilitado">
                            Anterior
                        </span>
                    @else
                        <a
                            href="{{ $aportes->previousPageUrl() }}"
                            class="pagina-boton"
                        >
                            Anterior
                        </a>
                    @endif

                    @if ($aportes->hasMorePages())
                        <a
                            href="{{ $aportes->nextPageUrl() }}"
                            class="pagina-boton"
                        >
                            Siguiente
                        </a>
                    @else
                        <span class="pagina-boton deshabilitado">
                            Siguiente
                        </span>
                    @endif
                </div>
            </div>
        @else
            <div class="sin-registros">
                <h3>No se encontraron aportes</h3>

                <p>
                    @if ($buscar || $estado)
                        No existen resultados para los filtros seleccionados.
                    @else
                        Todavía no se registraron aportes comunitarios.
                    @endif
                </p>
            </div>
        @endif
    </section>
</div>
@endsection