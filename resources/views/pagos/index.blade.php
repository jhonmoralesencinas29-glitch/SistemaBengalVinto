@extends('layouts.app')

@section('titulo', 'Pagos')

@section('contenido')
<style>
    .pagos-contenedor {
        max-width: 1500px;
        margin: 0 auto;
        color: #111111;
        font-weight: 400;
    }

    .pagos-encabezado {
        min-height: 235px;
        margin-bottom: 26px;
        padding: 42px 46px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 25px;
        border-radius: 22px;
        background-image:
            linear-gradient(
                90deg,
                rgba(0, 0, 0, 0.45),
                rgba(0, 0, 0, 0.10)
            ),
            url('{{ asset('images/pagos.jpg') }}');
        background-position: center;
        background-size: cover;
        color: #ffffff;
        overflow: hidden;
    }

    .pagos-encabezado h2 {
        margin: 0 0 9px;
        color: #ffffff;
        font-size: 30px;
        font-weight: 600;
    }

    .pagos-encabezado p {
        margin: 0;
        color: #ffffff;
        font-size: 17px;
        font-weight: 400;
    }

    .boton-registrar {
        min-width: 165px;
        padding: 16px 22px;
        border: 1px solid #ffffff;
        border-radius: 9px;
        background: #ffffff;
        color: #111111;
        font-size: 15px;
        font-weight: 400;
        text-align: center;
        text-decoration: none;
        transition: 0.2s ease;
    }

    .boton-registrar:hover {
        border-color: #1f6fc4;
        background: #1f6fc4;
        color: #ffffff;
        text-decoration: none;
    }

    .resumen-pagos,
    .aportes-panel {
        margin-bottom: 26px;
        padding: 25px 28px 28px;
        border: 1px solid #d7dfe9;
        border-radius: 16px;
        background: #ffffff;
    }

    .resumen-cabecera,
    .aportes-cabecera {
        margin-bottom: 19px;
    }

    .resumen-cabecera h3,
    .aportes-cabecera h3 {
        margin: 0 0 5px;
        color: #111111;
        font-size: 20px;
        font-weight: 500;
    }

    .resumen-cabecera p,
    .aportes-cabecera p {
        margin: 0;
        color: #333333;
        font-size: 15px;
        font-weight: 400;
    }

    .resumen-cuadricula {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        border: 1px solid #d7dfe9;
        border-radius: 13px;
        overflow: hidden;
    }

    .resumen-tarjeta {
        min-height: 105px;
        padding: 22px 24px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        border-right: 1px solid #d7dfe9;
        background: #ffffff;
    }

    .resumen-tarjeta:last-child {
        border-right: none;
    }

    .resumen-etiqueta {
        margin-bottom: 9px;
        color: #222222;
        font-size: 15px;
        font-weight: 400;
    }

    .resumen-valor {
        color: #111111;
        font-size: 24px;
        font-weight: 400;
    }

    .gestion-bloque {
        margin-top: 25px;
    }

    .gestion-bloque:first-child {
        margin-top: 0;
    }

    .gestion-encabezado {
        margin-bottom: 14px;
        padding-bottom: 10px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        border-bottom: 1px solid #dfe5ec;
    }

    .gestion-encabezado h4 {
        margin: 0;
        color: #111111;
        font-size: 18px;
        font-weight: 500;
    }

    .gestion-encabezado span {
        color: #333333;
        font-size: 14px;
        font-weight: 400;
    }

    .aportes-cuadricula {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 18px;
    }

    .aporte-tarjeta {
        overflow: hidden;
        border: 1px solid #d7dfe9;
        border-radius: 12px;
        background: #ffffff;
    }

    .aporte-tarjeta-encabezado {
        padding: 19px 20px;
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 15px;
        border-bottom: 1px solid #e1e6ed;
        background: #f8fafc;
    }

    .aporte-tarjeta-encabezado h5 {
        margin: 0 0 7px;
        color: #111111;
        font-size: 18px;
        font-weight: 500;
    }

    .aporte-fechas {
        margin: 0;
        color: #333333;
        font-size: 13px;
        font-weight: 400;
        line-height: 1.6;
    }

    .aporte-estado {
        flex-shrink: 0;
        padding: 6px 11px;
        border: 1px solid #c7d1de;
        border-radius: 20px;
        background: #ffffff;
        color: #111111;
        font-size: 12px;
        font-weight: 400;
        text-transform: capitalize;
    }

    .aporte-tarjeta-cuerpo {
        padding: 20px;
    }

    .aporte-montos {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        border: 1px solid #dfe5ec;
        border-radius: 9px;
        overflow: hidden;
    }

    .aporte-monto {
        min-width: 0;
        padding: 14px;
        border-right: 1px solid #dfe5ec;
    }

    .aporte-monto:last-child {
        border-right: none;
    }

    .aporte-monto span,
    .aporte-cantidad span {
        display: block;
        margin-bottom: 6px;
        color: #333333;
        font-size: 12px;
        font-weight: 400;
    }

    .aporte-monto strong,
    .aporte-cantidad strong {
        display: block;
        color: #111111;
        font-size: 16px;
        font-weight: 400;
        overflow-wrap: anywhere;
    }

    .aporte-progreso {
        margin-top: 17px;
    }

    .aporte-progreso-texto {
        margin-bottom: 7px;
        display: flex;
        justify-content: space-between;
        gap: 10px;
        color: #333333;
        font-size: 13px;
        font-weight: 400;
    }

    .aporte-progreso-barra {
        width: 100%;
        height: 8px;
        overflow: hidden;
        border-radius: 20px;
        background: #e5e9ef;
    }

    .aporte-progreso-avance {
        height: 100%;
        border-radius: 20px;
        background: #1f6fc4;
    }

    .aporte-cantidades {
        margin-top: 17px;
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        border-top: 1px solid #e1e6ed;
        border-bottom: 1px solid #e1e6ed;
    }

    .aporte-cantidad {
        padding: 13px 10px;
        text-align: center;
        border-right: 1px solid #e1e6ed;
    }

    .aporte-cantidad:last-child {
        border-right: none;
    }

    .aporte-tarjeta-pie {
        margin-top: 17px;
        display: flex;
        justify-content: flex-end;
    }

    .boton-consultar-aporte {
        min-height: 40px;
        padding: 0 16px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #c7d1de;
        border-radius: 8px;
        background: #ffffff;
        color: #111111;
        font-size: 14px;
        font-weight: 400;
        text-decoration: none;
    }

    .boton-consultar-aporte:hover {
        border-color: #1f6fc4;
        background: #f2f7fd;
        color: #111111;
        text-decoration: none;
    }

    .sin-aportes {
        padding: 35px 20px;
        border: 1px solid #dfe5ec;
        border-radius: 10px;
        color: #333333;
        text-align: center;
    }

    .panel-busqueda {
        margin-bottom: 30px;
        overflow: hidden;
        border: 1px solid #d7dfe9;
        border-radius: 16px;
        background: #ffffff;
    }

    .busqueda-cabecera {
        padding: 25px 30px 0;
    }

    .busqueda-cabecera h3 {
        margin: 0 0 6px;
        color: #111111;
        font-size: 21px;
        font-weight: 500;
    }

    .busqueda-cabecera p {
        margin: 0;
        color: #333333;
        font-size: 15px;
        font-weight: 400;
    }

    .formulario-busqueda {
        padding: 22px 30px 28px;
        display: grid;
        grid-template-columns:
            minmax(260px, 2fr)
            minmax(210px, 1fr)
            minmax(155px, 0.7fr)
            minmax(155px, 0.7fr)
            auto;
        gap: 13px;
        align-items: end;
    }

    .campo-busqueda label {
        display: block;
        margin-bottom: 7px;
        color: #111111;
        font-size: 14px;
        font-weight: 400;
    }

    .campo-busqueda input,
    .campo-busqueda select {
        width: 100%;
        height: 55px;
        padding: 0 16px;
        border: 1px solid #c7d1de;
        border-radius: 9px;
        background: #ffffff;
        color: #111111;
        font-size: 15px;
        font-weight: 400;
        outline: none;
    }

    .campo-busqueda input:focus,
    .campo-busqueda select:focus {
        border-color: #1f6fc4;
        box-shadow: 0 0 0 3px rgba(31, 111, 196, 0.1);
    }

    .acciones-busqueda {
        height: 55px;
        display: flex;
        gap: 9px;
    }

    .boton-buscar,
    .boton-limpiar {
        height: 55px;
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

    .resultados-cabecera {
        padding: 19px 30px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-top: 1px solid #dfe5ec;
        border-bottom: 1px solid #dfe5ec;
        background: #f8fafc;
    }

    .resultados-cabecera h3 {
        margin: 0;
        color: #111111;
        font-size: 18px;
        font-weight: 500;
    }

    .resultados-cabecera span {
        color: #222222;
        font-size: 14px;
        font-weight: 400;
    }

    .tabla-contenedor {
        width: 100%;
        overflow-x: auto;
    }

    .tabla-pagos {
        width: 100%;
        margin: 0;
        border-collapse: collapse;
    }

    .tabla-pagos th {
        padding: 16px 20px;
        border-bottom: 1px solid #d7dfe9;
        background: #f3f5f8;
        color: #111111;
        font-size: 13px;
        font-weight: 500;
        text-align: left;
        white-space: nowrap;
    }

    .tabla-pagos td {
        padding: 19px 20px;
        border-bottom: 1px solid #e1e6ed;
        color: #111111;
        font-size: 15px;
        font-weight: 400;
        vertical-align: middle;
    }

    .tabla-pagos tbody tr:hover {
        background: #fafbfd;
    }

    .texto-principal {
        display: block;
        color: #111111;
        font-size: 15px;
        font-weight: 400;
    }

    .texto-secundario {
        display: block;
        margin-top: 5px;
        color: #333333;
        font-size: 13px;
        font-weight: 400;
    }

    .monto-pagado {
        color: #111111;
        font-size: 15px;
        font-weight: 400;
        white-space: nowrap;
    }

    .acciones-tabla {
        display: flex;
        gap: 8px;
    }

    .boton-tabla {
        padding: 9px 13px;
        border: 1px solid #c7d1de;
        border-radius: 8px;
        background: #ffffff;
        color: #111111;
        font-size: 14px;
        font-weight: 400;
        text-decoration: none;
        white-space: nowrap;
    }

    .boton-tabla:hover {
        border-color: #1f6fc4;
        background: #f2f7fd;
        color: #111111;
        text-decoration: none;
    }

    .sin-resultados {
        padding: 50px 25px;
        text-align: center;
    }

    .sin-resultados h4 {
        margin: 0 0 7px;
        color: #111111;
        font-size: 18px;
        font-weight: 500;
    }

    .sin-resultados p {
        margin: 0;
        color: #333333;
        font-size: 15px;
        font-weight: 400;
    }

    .paginacion-pagos {
        padding: 18px 24px;
        border-top: 1px solid #e1e6ed;
    }

    @media (max-width: 1200px) {
        .formulario-busqueda {
            grid-template-columns: repeat(2, 1fr);
        }

        .acciones-busqueda {
            grid-column: span 2;
        }
    }

    @media (max-width: 900px) {
        .resumen-cuadricula {
            grid-template-columns: 1fr;
        }

        .resumen-tarjeta {
            border-right: none;
            border-bottom: 1px solid #d7dfe9;
        }

        .resumen-tarjeta:last-child {
            border-bottom: none;
        }

        .aportes-cuadricula {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 700px) {
        .pagos-encabezado {
            min-height: 265px;
            padding: 30px 24px;
            flex-direction: column;
            align-items: flex-start;
            justify-content: center;
        }

        .pagos-encabezado h2 {
            font-size: 29px;
        }

        .boton-registrar {
            width: 100%;
        }

        .resumen-pagos,
        .aportes-panel {
            padding: 22px 18px;
        }

        .aporte-montos {
            grid-template-columns: 1fr;
        }

        .aporte-monto {
            border-right: none;
            border-bottom: 1px solid #dfe5ec;
        }

        .aporte-monto:last-child {
            border-bottom: none;
        }

        .aporte-cantidades {
            grid-template-columns: 1fr;
        }

        .aporte-cantidad {
            border-right: none;
            border-bottom: 1px solid #e1e6ed;
        }

        .aporte-cantidad:last-child {
            border-bottom: none;
        }

        .formulario-busqueda {
            grid-template-columns: 1fr;
        }

        .acciones-busqueda {
            height: auto;
            grid-column: auto;
            flex-direction: column;
        }

        .boton-buscar,
        .boton-limpiar {
            width: 100%;
        }

        .resultados-cabecera {
            align-items: flex-start;
            flex-direction: column;
            gap: 5px;
        }
    }
</style>

<div class="pagos-contenedor">
    <div class="pagos-encabezado">
        <div>
            <h2>Gestión de pagos</h2>

            <p>
                Registra y consulta los pagos de los aportes comunitarios.
            </p>
        </div>

        <a href="{{ route('pagos.create') }}" class="boton-registrar">
            Registrar pago
        </a>
    </div>

    <div class="resumen-pagos">
        <div class="resumen-cabecera">
            <h3>Resumen general</h3>

            <p>
                Información general de los pagos registrados en el sistema.
            </p>
        </div>

        <div class="resumen-cuadricula">
            <div class="resumen-tarjeta">
                <span class="resumen-etiqueta">
                    Pagos registrados
                </span>

                <span class="resumen-valor">
                    {{ number_format($totalPagos, 0, ',', '.') }}
                </span>
            </div>

            <div class="resumen-tarjeta">
                <span class="resumen-etiqueta">
                    Total recaudado
                </span>

                <span class="resumen-valor">
                    Bs {{ number_format(
                        $totalRecaudado,
                        2,
                        ',',
                        '.'
                    ) }}
                </span>
            </div>

            <div class="resumen-tarjeta">
                <span class="resumen-etiqueta">
                    Recaudado hoy
                </span>

                <span class="resumen-valor">
                    Bs {{ number_format(
                        $recaudadoHoy,
                        2,
                        ',',
                        '.'
                    ) }}
                </span>
            </div>
        </div>
    </div>

    <div class="aportes-panel">
        <div class="aportes-cabecera">
            <h3>Aportes creados por gestión</h3>

            <p>
                Cada aporte presenta su propia recaudación y saldo pendiente.
            </p>
        </div>

        @forelse ($aportesPorGestion as $gestion => $aportesGestion)
            <div class="gestion-bloque">
                <div class="gestion-encabezado">
                    <h4>Gestión {{ $gestion }}</h4>

                    <span>
                        {{ $aportesGestion->count() }}
                        {{ $aportesGestion->count() === 1
                            ? 'aporte'
                            : 'aportes' }}
                    </span>
                </div>

                <div class="aportes-cuadricula">
                    @foreach ($aportesGestion as $aporte)
                        <article class="aporte-tarjeta">
                            <div class="aporte-tarjeta-encabezado">
                                <div>
                                    <h5>{{ $aporte->concepto }}</h5>

                                    <p class="aporte-fechas">
                                        Creado:
                                        {{ $aporte->fecha_creacion
                                            ?->format('d/m/Y') }}

                                        <br>

                                        Vencimiento:
                                        {{ $aporte->fecha_vencimiento
                                            ?->format('d/m/Y')
                                            ?? 'Sin vencimiento' }}
                                    </p>
                                </div>

                                <span class="aporte-estado">
                                    {{ $aporte->estado }}
                                </span>
                            </div>

                            <div class="aporte-tarjeta-cuerpo">
                                <div class="aporte-montos">
                                    <div class="aporte-monto">
                                        <span>Monto esperado</span>

                                        <strong>
                                            Bs {{ number_format(
                                                (float) $aporte->monto_esperado,
                                                2,
                                                ',',
                                                '.'
                                            ) }}
                                        </strong>
                                    </div>

                                    <div class="aporte-monto">
                                        <span>Recaudado</span>

                                        <strong>
                                            Bs {{ number_format(
                                                (float) $aporte->monto_recaudado,
                                                2,
                                                ',',
                                                '.'
                                            ) }}
                                        </strong>
                                    </div>

                                    <div class="aporte-monto">
                                        <span>Pendiente</span>

                                        <strong>
                                            Bs {{ number_format(
                                                (float) $aporte->saldo_pendiente,
                                                2,
                                                ',',
                                                '.'
                                            ) }}
                                        </strong>
                                    </div>
                                </div>

                                <div class="aporte-progreso">
                                    <div class="aporte-progreso-texto">
                                        <span>Avance de recaudación</span>

                                        <span>
                                            {{ number_format(
                                                (float) $aporte
                                                    ->porcentaje_recaudado,
                                                1,
                                                ',',
                                                '.'
                                            ) }} %
                                        </span>
                                    </div>

                                    <div class="aporte-progreso-barra">
                                        <div
                                            class="aporte-progreso-avance"
                                            style="width: {{ $aporte->porcentaje_recaudado }}%;"
                                        ></div>
                                    </div>
                                </div>

                                <div class="aporte-cantidades">
                                    <div class="aporte-cantidad">
                                        <span>Asignados</span>

                                        <strong>
                                            {{ $aporte->total_asignados }}
                                        </strong>
                                    </div>

                                    <div class="aporte-cantidad">
                                        <span>Pagados</span>

                                        <strong>
                                            {{ $aporte->total_pagados }}
                                        </strong>
                                    </div>

                                    <div class="aporte-cantidad">
                                        <span>Pendientes</span>

                                        <strong>
                                            {{ $aporte->total_pendientes }}
                                        </strong>
                                    </div>
                                </div>

                                <div class="aporte-tarjeta-pie">
                                    <a
                                        href="{{ route('pagos.index', [
                                            'id_aporte' =>
                                                $aporte->id_aporte
                                        ]) }}#buscar-comprobantes"
                                        class="boton-consultar-aporte"
                                    >
                                        Consultar pagos
                                    </a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        @empty
            <div class="sin-aportes">
                Todavía no existen aportes asignados a comunarios.
            </div>
        @endforelse
    </div>

    <div class="panel-busqueda" id="buscar-comprobantes">
        <div class="busqueda-cabecera">
            <h3>Buscar comprobantes</h3>

            <p>
                Utiliza uno o varios filtros para encontrar un pago registrado.
            </p>
        </div>

        <form
            action="{{ route('pagos.index') }}#buscar-comprobantes"
            method="GET"
            class="formulario-busqueda"
        >
            <div class="campo-busqueda">
                <label for="buscar">
                    Comunario o comprobante
                </label>

                <input
                    type="text"
                    id="buscar"
                    name="buscar"
                    value="{{ $buscar }}"
                    placeholder="Nombre, CI o número de comprobante"
                >
            </div>

            <div class="campo-busqueda">
                <label for="id_aporte">
                    Aporte
                </label>

                <select id="id_aporte" name="id_aporte">
                    <option value="">
                        Todos los aportes
                    </option>

                    @foreach ($aportes as $aporte)
                        <option
                            value="{{ $aporte->id_aporte }}"
                            @selected(
                                (string) $idAporte ===
                                (string) $aporte->id_aporte
                            )
                        >
                            {{ $aporte->concepto }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="campo-busqueda">
                <label for="fecha_inicio">
                    Desde
                </label>

                <input
                    type="date"
                    id="fecha_inicio"
                    name="fecha_inicio"
                    value="{{ $fechaInicio }}"
                >
            </div>

            <div class="campo-busqueda">
                <label for="fecha_fin">
                    Hasta
                </label>

                <input
                    type="date"
                    id="fecha_fin"
                    name="fecha_fin"
                    value="{{ $fechaFin }}"
                >
            </div>

            <div class="acciones-busqueda">
                <button type="submit" class="boton-buscar">
                    Buscar
                </button>

                @if ($hayFiltros)
                    <a
                        href="{{ route('pagos.index') }}"
                        class="boton-limpiar"
                    >
                        Limpiar
                    </a>
                @endif
            </div>
        </form>

        @if ($hayFiltros)
            <div class="resultados-cabecera">
                <h3>Resultados de la búsqueda</h3>

                <span>
                    {{ $pagos->total() }}
                    {{ $pagos->total() === 1
                        ? 'pago encontrado'
                        : 'pagos encontrados' }}
                </span>
            </div>

            @if ($pagos->count() > 0)
                <div class="tabla-contenedor">
                    <table class="tabla-pagos">
                        <thead>
                            <tr>
                                <th>COMPROBANTE</th>
                                <th>COMUNARIO</th>
                                <th>COMUNIDAD</th>
                                <th>APORTE</th>
                                <th>MONTO PAGADO</th>
                                <th>FECHA</th>
                                <th>ACCIONES</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($pagos as $pago)
                                @php
                                    $asignacion =
                                        $pago->aporteComunario;

                                    $comunario =
                                        $asignacion?->comunario;

                                    $aportePago =
                                        $asignacion?->aporte;

                                    $comunidad =
                                        $comunario?->comunidad;
                                @endphp

                                <tr>
                                    <td>
                                        <span class="texto-principal">
                                            {{ $pago->comprobante
                                                ?->numero_comprobante
                                                ?? 'Sin comprobante' }}
                                        </span>

                                        <span class="texto-secundario">
                                            Pago: {{ $pago->id_pago }}
                                        </span>
                                    </td>

                                    <td>
                                        <span class="texto-principal">
                                            {{ $comunario?->nombres }}
                                            {{ $comunario?->apellidos }}
                                        </span>

                                        <span class="texto-secundario">
                                            CI:
                                            {{ $comunario?->ci
                                                ?? 'No registrado' }}
                                        </span>
                                    </td>

                                    <td>
                                        <span class="texto-principal">
                                            {{ $comunidad?->nombre
                                                ?? 'Sin comunidad' }}
                                        </span>
                                    </td>

                                    <td>
                                        <span class="texto-principal">
                                            {{ $aportePago?->concepto
                                                ?? 'Sin aporte' }}
                                        </span>

                                        <span class="texto-secundario">
                                            Saldo actual:
                                            Bs {{ number_format(
                                                (float) (
                                                    $asignacion?->saldo
                                                    ?? 0
                                                ),
                                                2,
                                                ',',
                                                '.'
                                            ) }}
                                        </span>
                                    </td>

                                    <td>
                                        <span class="monto-pagado">
                                            Bs {{ number_format(
                                                (float) $pago
                                                    ->monto_pagado,
                                                2,
                                                ',',
                                                '.'
                                            ) }}
                                        </span>
                                    </td>

                                    <td>
                                        <span class="texto-principal">
                                            {{ $pago->fecha_pago
                                                ->format('d/m/Y') }}
                                        </span>

                                        <span class="texto-secundario">
                                            {{ $pago->fecha_pago
                                                ->format('H:i') }}
                                        </span>
                                    </td>

                                    <td>
                                        <div class="acciones-tabla">
                                            <a
                                                href="{{ route(
                                                    'pagos.show',
                                                    $pago
                                                ) }}"
                                                class="boton-tabla"
                                            >
                                                Ver
                                            </a>

                                            <a
                                                href="{{ route(
                                                    'pagos.comprobante',
                                                    $pago
                                                ) }}"
                                                class="boton-tabla"
                                            >
                                                Imprimir
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @if ($pagos->hasPages())
                    <div class="paginacion-pagos">
                        {{ $pagos->links() }}
                    </div>
                @endif
            @else
                <div class="sin-resultados">
                    <h4>No se encontraron pagos</h4>

                    <p>
                        Revisa los datos ingresados o utiliza otros filtros.
                    </p>
                </div>
            @endif
        @endif
    </div>
</div>
@endsection