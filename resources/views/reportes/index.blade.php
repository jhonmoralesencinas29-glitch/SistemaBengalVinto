@extends('layouts.app')

@section('titulo', 'Reportes | Bengal Vinto')
@section('encabezado', 'Reportes')

@push('estilos')
<style>
    .reportes-contenedor {
        color: #111;
    }

    .cabecera-reportes {
        min-height: 235px;
        margin-bottom: 26px;
        padding: 40px;
        display: flex;
        align-items: center;
        position: relative;
        overflow: hidden;
        border-radius: 20px;
        background-image:
            linear-gradient(90deg, rgba(0, 0, 0, .45), rgba(0, 0, 0, .12)),
            url('{{ asset('images/reporte.jpg') }}');
        background-size: cover;
        background-position: center;
    }

    .cabecera-contenido {
        max-width: 720px;
        position: relative;
        z-index: 1;
    }

    .cabecera-reportes h2 {
        margin: 0 0 8px;
        color: #fff;
        font-size: 29px;
        font-weight: 500;
    }

    .cabecera-reportes p {
        margin: 0;
        color: #fff;
        font-size: 16px;
        line-height: 1.5;
    }

    .panel-reportes {
        margin-bottom: 26px;
        padding: 26px 28px;
        border: 1px solid #d7dfe9;
        border-radius: 16px;
        background: #fff;
    }

    .titulo-panel {
        margin-bottom: 20px;
    }

    .titulo-panel-flex {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
    }

    .titulo-panel h2 {
        margin: 0;
        color: #111;
        font-size: 21px;
        font-weight: 500;
    }

    .titulo-panel p {
        margin: 5px 0 0;
        color: #444;
        font-size: 14px;
    }

    .volver-tipos {
        color: #1769c2;
        font-size: 14px;
        text-decoration: none;
    }

    .volver-tipos:hover {
        text-decoration: underline;
    }

    .opciones-reportes {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 16px;
    }

    .opcion-reporte {
        min-height: 95px;
        padding: 18px 20px;
        display: flex;
        align-items: center;
        gap: 16px;
        border: 1px solid #d7dfe9;
        border-radius: 13px;
        color: #111;
        background: #fff;
        text-decoration: none;
    }

    .opcion-reporte:hover {
        border-color: #1769c2;
        background: #fafcff;
    }

    .opcion-icono {
        width: 42px;
        height: 42px;
        flex: 0 0 42px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .opcion-icono svg {
        width: 25px;
        height: 25px;
        fill: none;
        stroke: currentColor;
        stroke-width: 1.6;
        stroke-linecap: round;
        stroke-linejoin: round;
    }

    .opcion-informacion {
        min-width: 0;
        flex: 1;
    }

    .opcion-informacion h3 {
        margin: 0 0 5px;
        font-size: 17px;
        font-weight: 500;
    }

    .opcion-informacion p {
        margin: 0;
        color: #444;
        font-size: 13px;
        line-height: 1.4;
    }

    .opcion-flecha {
        font-size: 22px;
    }

    .errores {
        margin-bottom: 20px;
        padding: 14px 17px;
        border: 1px solid #e2b8b8;
        border-radius: 9px;
        color: #8a1c1c;
        background: #fff7f7;
        font-size: 14px;
    }

    .errores ul {
        margin: 0;
        padding-left: 20px;
    }

    .campos-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 16px;
    }

    .campo {
        min-width: 0;
    }

    .campo-completo {
        grid-column: 1 / -1;
    }

    .campo label {
        display: block;
        margin-bottom: 7px;
        font-size: 14px;
    }

    .campo input,
    .campo select {
        width: 100%;
        min-height: 46px;
        padding: 10px 12px;
        border: 1px solid #cbd8e6;
        border-radius: 8px;
        color: #111;
        background: #fff;
        font-size: 14px;
    }

    .campo input:focus,
    .campo select:focus {
        border-color: #1769c2;
        outline: none;
    }

    .acciones {
        margin-top: 20px;
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .boton {
        min-height: 44px;
        padding: 0 18px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        font-size: 14px;
        text-decoration: none;
        cursor: pointer;
    }

    .boton-principal,
    .boton-imprimir {
        border: 1px solid #1769c2;
        color: #fff;
        background: #1769c2;
    }

    .boton-principal:hover,
    .boton-imprimir:hover {
        border-color: #1258a5;
        color: #fff;
        background: #1258a5;
    }

    .boton-secundario {
        border: 1px solid #cbd8e6;
        color: #111;
        background: #fff;
    }

    .boton-secundario:hover {
        background: #f5f7fa;
    }

    .boton-imprimir {
        margin-left: auto;
    }

    .resumen-reporte {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
        overflow: hidden;
        border: 1px solid #d7dfe9;
        border-radius: 13px;
    }

    .resumen-item {
        min-height: 90px;
        padding: 18px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        border-right: 1px solid #d7dfe9;
    }

    .resumen-item:last-child {
        border-right: 0;
    }

    .resumen-item span {
        margin-bottom: 7px;
        color: #444;
        font-size: 13px;
    }

    .resumen-item strong {
        font-size: 21px;
        font-weight: 500;
    }

    .datos-comunario {
        margin-bottom: 20px;
        padding: 18px;
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 16px;
        border: 1px solid #d7dfe9;
        border-radius: 13px;
    }

    .dato span {
        display: block;
        margin-bottom: 6px;
        color: #444;
        font-size: 12px;
    }

    .dato strong {
        font-size: 14px;
        font-weight: 500;
    }

    .subtitulo-tabla {
        margin: 24px 0 12px;
        font-size: 18px;
        font-weight: 500;
    }

    .tabla-responsive {
        width: 100%;
        overflow-x: auto;
        border: 1px solid #d7dfe9;
        border-radius: 13px;
    }

    .tabla {
        width: 100%;
        min-width: 760px;
        border-collapse: collapse;
    }

    .tabla th {
        padding: 12px 13px;
        border-bottom: 1px solid #d7dfe9;
        background: #f7f9fc;
        font-size: 12px;
        font-weight: 500;
        text-align: left;
        white-space: nowrap;
    }

    .tabla td {
        padding: 13px;
        border-bottom: 1px solid #edf1f5;
        font-size: 13px;
        vertical-align: middle;
    }

    .tabla tbody tr:last-child td {
        border-bottom: 0;
    }

    .texto-centro {
        text-align: center !important;
    }

    .texto-derecha {
        text-align: right !important;
    }

    .estado {
        min-width: 80px;
        padding: 5px 10px;
        display: inline-flex;
        justify-content: center;
        border-radius: 15px;
        font-size: 12px;
        text-transform: capitalize;
    }

    .estado-presente,
    .estado-pagado {
        color: #166534;
        background: #dcfce7;
    }

    .estado-retraso,
    .estado-parcial {
        color: #92400e;
        background: #fef3c7;
    }

    .estado-falta,
    .estado-pendiente {
        color: #991b1b;
        background: #fee2e2;
    }

    .estado-licencia {
        color: #1e40af;
        background: #dbeafe;
    }

    .sin-resultados {
        padding: 35px 20px !important;
        color: #555;
        text-align: center;
    }

    @media (max-width: 900px) {
        .datos-comunario {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 700px) {
        .cabecera-reportes {
            min-height: 240px;
            padding: 28px 22px;
        }

        .cabecera-reportes h2 {
            font-size: 23px;
        }

        .cabecera-reportes p {
            font-size: 14px;
        }

        .panel-reportes {
            padding: 21px 17px;
        }

        .opciones-reportes,
        .campos-grid,
        .datos-comunario {
            grid-template-columns: 1fr;
        }

        .campo-completo {
            grid-column: auto;
        }

        .titulo-panel-flex,
        .acciones {
            align-items: stretch;
            flex-direction: column;
        }

        .boton,
        .boton-imprimir {
            width: 100%;
            margin-left: 0;
        }

        .resumen-reporte {
            grid-template-columns: 1fr;
        }

        .resumen-item {
            border-right: 0;
            border-bottom: 1px solid #d7dfe9;
        }

        .resumen-item:last-child {
            border-bottom: 0;
        }
    }
</style>
@endpush

@section('contenido')
<div class="reportes-contenedor">

    <section class="cabecera-reportes">
        <div class="cabecera-contenido">
            <h2>Reportes del sistema</h2>
            <p>
                Consulta e imprime información de asistencias,
                aportes, pagos y saldos pendientes.
            </p>
        </div>
    </section>

    @if ($errors->any())
        <div class="errores">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (!$tipo)
        <section class="panel-reportes">
            <div class="titulo-panel">
                <h2>¿Qué reporte deseas generar?</h2>
                <p>Selecciona una de las opciones disponibles.</p>
            </div>

            <div class="opciones-reportes">
                <a
                    href="{{ route('reportes.index', ['tipo' => 'asistencias']) }}"
                    class="opcion-reporte"
                >
                    <div class="opcion-icono">
                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <rect x="4" y="3" width="16" height="18" rx="2"></rect>
                            <path d="M8 8h8"></path>
                            <path d="M8 12h8"></path>
                            <path d="m8 16 2 2 4-4"></path>
                        </svg>
                    </div>

                    <div class="opcion-informacion">
                        <h3>Reporte de asistencias</h3>
                        <p>Consulta asistencias por reunión o periodo.</p>
                    </div>

                    <span class="opcion-flecha">›</span>
                </a>

                <a
                    href="{{ route('reportes.index', ['tipo' => 'estado_cuenta']) }}"
                    class="opcion-reporte"
                >
                    <div class="opcion-icono">
                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M3 21v-2a6 6 0 0 1 12 0v2"></path>
                            <rect x="14" y="12" width="8" height="7" rx="1"></rect>
                            <path d="M16 15h4"></path>
                        </svg>
                    </div>

                    <div class="opcion-informacion">
                        <h3>Estado de cuenta</h3>
                        <p>
                            Consulta aportes, pagos y saldos pendientes
                            de un comunario.
                        </p>
                    </div>

                    <span class="opcion-flecha">›</span>
                </a>
            </div>
        </section>
    @endif

    @if ($tipo === 'asistencias')
        <section class="panel-reportes">
            <div class="titulo-panel titulo-panel-flex">
                <div>
                    <h2>Reporte de asistencias</h2>
                    <p>Selecciona la información que deseas consultar.</p>
                </div>

                <a href="{{ route('reportes.index') }}" class="volver-tipos">
                    Cambiar tipo de reporte
                </a>
            </div>

            <form action="{{ route('reportes.index') }}" method="GET">
                <input type="hidden" name="tipo" value="asistencias">
                <input type="hidden" name="generar" value="1">

                <div class="campos-grid">
                    <div class="campo">
                        <label for="periodo">Periodo</label>
                        <select name="periodo" id="periodo">
                            <option value="reunion" {{ $periodo === 'reunion' ? 'selected' : '' }}>
                                Una reunión
                            </option>
                            <option value="dia" {{ $periodo === 'dia' ? 'selected' : '' }}>
                                Un día
                            </option>
                            <option value="mes" {{ $periodo === 'mes' ? 'selected' : '' }}>
                                Un mes
                            </option>
                            <option value="semestre" {{ $periodo === 'semestre' ? 'selected' : '' }}>
                                Un semestre
                            </option>
                            <option value="anio" {{ $periodo === 'anio' ? 'selected' : '' }}>
                                Un año
                            </option>
                            <option value="personalizado" {{ $periodo === 'personalizado' ? 'selected' : '' }}>
                                Rango de fechas
                            </option>
                        </select>
                    </div>

                    <div class="campo">
                        <label for="id_comunidad">Comunidad</label>
                        <select name="id_comunidad" id="id_comunidad">
                            <option value="">Todas las comunidades</option>

                            @foreach ($comunidades as $comunidad)
                                <option
                                    value="{{ $comunidad->id_comunidad }}"
                                    {{ (string) $idComunidad === (string) $comunidad->id_comunidad ? 'selected' : '' }}
                                >
                                    {{ $comunidad->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div
                        class="campo campo-completo periodo-campo"
                        data-periodo="reunion"
                    >
                        <label for="id_reunion">Reunión</label>
                        <select name="id_reunion" id="id_reunion">
                            <option value="">Selecciona una reunión</option>

                            @foreach ($reuniones as $reunion)
                                <option
                                    value="{{ $reunion->id_reunion }}"
                                    {{ (string) $idReunion === (string) $reunion->id_reunion ? 'selected' : '' }}
                                >
                                    {{ $reunion->fecha->format('d/m/Y') }}
                                    - {{ $reunion->descripcion }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="campo periodo-campo" data-periodo="dia">
                        <label for="fecha_referencia">Fecha</label>
                        <input
                            type="date"
                            name="fecha_referencia"
                            id="fecha_referencia"
                            value="{{ $fechaReferencia }}"
                        >
                    </div>

                    <div class="campo periodo-campo" data-periodo="mes">
                        <label for="mes">Mes</label>
                        <input
                            type="month"
                            name="mes"
                            id="mes"
                            value="{{ $mes }}"
                        >
                    </div>

                    <div class="campo periodo-campo" data-periodo="semestre">
                        <label for="semestre">Semestre</label>
                        <select name="semestre" id="semestre">
                            <option value="1" {{ (int) $semestre === 1 ? 'selected' : '' }}>
                                Primer semestre
                            </option>
                            <option value="2" {{ (int) $semestre === 2 ? 'selected' : '' }}>
                                Segundo semestre
                            </option>
                        </select>
                    </div>

                    <div
                        class="campo periodo-campo"
                        data-periodo="semestre anio"
                    >
                        <label for="anio">Año</label>
                        <input
                            type="number"
                            name="anio"
                            id="anio"
                            min="2000"
                            max="2100"
                            value="{{ $anio }}"
                        >
                    </div>

                    <div class="campo periodo-campo" data-periodo="personalizado">
                        <label for="fecha_inicio">Desde</label>
                        <input
                            type="date"
                            name="fecha_inicio"
                            id="fecha_inicio"
                            value="{{ $fechaInicio }}"
                        >
                    </div>

                    <div class="campo periodo-campo" data-periodo="personalizado">
                        <label for="fecha_fin">Hasta</label>
                        <input
                            type="date"
                            name="fecha_fin"
                            id="fecha_fin"
                            value="{{ $fechaFin }}"
                        >
                    </div>
                </div>

                <div class="acciones">
                    <button type="submit" class="boton boton-principal">
                        Generar reporte
                    </button>

                    <a
                        href="{{ route('reportes.index', ['tipo' => 'asistencias']) }}"
                        class="boton boton-secundario"
                    >
                        Limpiar
                    </a>

                    @if ($generado)
                        <a
                            href="{{ route('reportes.imprimir', request()->query()) }}"
                            class="boton boton-imprimir"
                        >
                            Imprimir reporte
                        </a>
                    @endif
                </div>
            </form>
        </section>
    @endif

    @if ($tipo === 'estado_cuenta')
        <section class="panel-reportes">
            <div class="titulo-panel titulo-panel-flex">
                <div>
                    <h2>Estado de cuenta</h2>
                    <p>Selecciona la comunidad y el comunario.</p>
                </div>

                <a href="{{ route('reportes.index') }}" class="volver-tipos">
                    Cambiar tipo de reporte
                </a>
            </div>

            <form action="{{ route('reportes.index') }}" method="GET">
                <input type="hidden" name="tipo" value="estado_cuenta">
                <input type="hidden" name="generar" value="1">

                <div class="campos-grid">
                    <div class="campo">
                        <label for="filtro_comunidad">Comunidad</label>
                        <select id="filtro_comunidad">
                            <option value="">Todas las comunidades</option>

                            @foreach ($comunidades as $comunidad)
                                <option value="{{ $comunidad->id_comunidad }}">
                                    {{ $comunidad->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="campo">
                        <label for="id_comunario">Comunario</label>
                        <select name="id_comunario" id="id_comunario">
                            <option value="">Selecciona un comunario</option>

                            @foreach ($comunarios as $comunario)
                                <option
                                    value="{{ $comunario->id_comunario }}"
                                    data-comunidad="{{ $comunario->id_comunidad }}"
                                    {{ (string) $idComunario === (string) $comunario->id_comunario ? 'selected' : '' }}
                                >
                                    {{ $comunario->apellidos }}
                                    {{ $comunario->nombres }}
                                    - CI {{ $comunario->ci }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="acciones">
                    <button type="submit" class="boton boton-principal">
                        Consultar estado de cuenta
                    </button>

                    <a
                        href="{{ route('reportes.index', ['tipo' => 'estado_cuenta']) }}"
                        class="boton boton-secundario"
                    >
                        Limpiar
                    </a>

                    @if ($generado && $comunarioSeleccionado)
                        <a
                            href="{{ route('reportes.imprimir', request()->query()) }}"
                            class="boton boton-imprimir"
                        >
                            Imprimir estado de cuenta
                        </a>
                    @endif
                </div>
            </form>
        </section>
    @endif

    @if ($generado && $tipo === 'asistencias')
        <section class="panel-reportes">
            <div class="titulo-panel">
                <h2>{{ $tituloReporte }}</h2>
                <p>{{ $descripcionPeriodo }}</p>
            </div>

            <div class="resumen-reporte">
                <div class="resumen-item">
                    <span>Total de registros</span>
                    <strong>{{ $resumen['total'] }}</strong>
                </div>

                <div class="resumen-item">
                    <span>Presentes</span>
                    <strong>{{ $resumen['presentes'] }}</strong>
                </div>

                <div class="resumen-item">
                    <span>Retrasos</span>
                    <strong>{{ $resumen['retrasos'] }}</strong>
                </div>

                <div class="resumen-item">
                    <span>Faltas</span>
                    <strong>{{ $resumen['faltas'] }}</strong>
                </div>

                <div class="resumen-item">
                    <span>Licencias</span>
                    <strong>{{ $resumen['licencias'] }}</strong>
                </div>
            </div>

            <h3 class="subtitulo-tabla">Detalle de asistencia</h3>

            <div class="tabla-responsive">
                <table class="tabla">
                    <thead>
                        <tr>
                            <th class="texto-centro">N.º</th>
                            <th>Fecha</th>
                            <th>Reunión</th>
                            <th>Comunidad</th>
                            <th>Comunario</th>
                            <th>CI</th>
                            <th class="texto-centro">Asistencia</th>
                            <th>Observación</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($asistencias as $asistencia)
                            <tr>
                                <td class="texto-centro">
                                    {{ $asistencia->comunario->numero_comunidad ?? $loop->iteration }}
                                </td>
                                <td>
                                    {{ $asistencia->reunion->fecha->format('d/m/Y') }}
                                </td>
                                <td>{{ $asistencia->reunion->descripcion }}</td>
                                <td>
                                    {{ $asistencia->comunario->comunidad?->nombre ?? 'Sin comunidad' }}
                                </td>
                                <td>
                                    {{ $asistencia->comunario->apellidos }}
                                    {{ $asistencia->comunario->nombres }}
                                </td>
                                <td>{{ $asistencia->comunario->ci }}</td>
                                <td class="texto-centro">
                                    <span class="estado estado-{{ strtolower($asistencia->estado_asistencia) }}">
                                        {{ strtolower($asistencia->estado_asistencia) }}
                                    </span>
                                </td>
                                <td>
                                    {{ $asistencia->observacion ?: 'Sin observación' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="sin-resultados">
                                    No se encontraron asistencias.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    @endif

    @if (
        $generado &&
        $tipo === 'estado_cuenta' &&
        $comunarioSeleccionado
    )
        <section class="panel-reportes">
            <div class="titulo-panel">
                <h2>Estado de cuenta del comunario</h2>
                <p>Información de aportes y pagos registrados.</p>
            </div>

            <div class="datos-comunario">
                <div class="dato">
                    <span>Nombre completo</span>
                    <strong>
                        {{ $comunarioSeleccionado->nombres }}
                        {{ $comunarioSeleccionado->apellidos }}
                    </strong>
                </div>

                <div class="dato">
                    <span>Cédula de identidad</span>
                    <strong>{{ $comunarioSeleccionado->ci }}</strong>
                </div>

                <div class="dato">
                    <span>Comunidad</span>
                    <strong>
                        {{ $comunarioSeleccionado->comunidad?->nombre ?? 'Sin comunidad' }}
                    </strong>
                </div>

                <div class="dato">
                    <span>Número de lista</span>
                    <strong>
                        {{ $comunarioSeleccionado->numero_comunidad ?? 'No asignado' }}
                    </strong>
                </div>
            </div>

            <div class="resumen-reporte">
                <div class="resumen-item">
                    <span>Total asignado</span>
                    <strong>
                        Bs {{ number_format($resumen['total_asignado'], 2, ',', '.') }}
                    </strong>
                </div>

                <div class="resumen-item">
                    <span>Total pagado</span>
                    <strong>
                        Bs {{ number_format($resumen['total_pagado'], 2, ',', '.') }}
                    </strong>
                </div>

                <div class="resumen-item">
                    <span>Saldo pendiente</span>
                    <strong>
                        Bs {{ number_format($resumen['saldo_pendiente'], 2, ',', '.') }}
                    </strong>
                </div>
            </div>

            <h3 class="subtitulo-tabla">Aportes asignados</h3>

            <div class="tabla-responsive">
                <table class="tabla">
                    <thead>
                        <tr>
                            <th>Aporte</th>
                            <th>Fecha</th>
                            <th class="texto-derecha">Asignado</th>
                            <th class="texto-derecha">Pagado</th>
                            <th class="texto-derecha">Saldo</th>
                            <th class="texto-centro">Estado</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($asignaciones as $asignacion)
                            <tr>
                                <td>{{ $asignacion->aporte->concepto }}</td>
                                <td>
                                    {{ $asignacion->aporte->fecha_creacion->format('d/m/Y') }}
                                </td>
                                <td class="texto-derecha">
                                    Bs {{ number_format((float) $asignacion->monto_asignado, 2, ',', '.') }}
                                </td>
                                <td class="texto-derecha">
                                    Bs {{ number_format((float) ($asignacion->total_pagado ?? 0), 2, ',', '.') }}
                                </td>
                                <td class="texto-derecha">
                                    Bs {{ number_format((float) $asignacion->saldo, 2, ',', '.') }}
                                </td>
                                <td class="texto-centro">
                                    <span class="estado estado-{{ strtolower($asignacion->estado_pago) }}">
                                        {{ $asignacion->estado_pago }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="sin-resultados">
                                    No tiene aportes asignados.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <h3 class="subtitulo-tabla">Historial de pagos</h3>

            <div class="tabla-responsive">
                <table class="tabla">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Comprobante</th>
                            <th>Aporte</th>
                            <th class="texto-derecha">Monto pagado</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($pagos as $pago)
                            <tr>
                                <td>{{ $pago->fecha_pago->format('d/m/Y') }}</td>
                                <td>
                                    {{ $pago->comprobante?->numero_comprobante ?? 'No generado' }}
                                </td>
                                <td>
                                    {{ $pago->aporteComunario->aporte->concepto }}
                                </td>
                                <td class="texto-derecha">
                                    Bs {{ number_format((float) $pago->monto_pagado, 2, ',', '.') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="sin-resultados">
                                    No tiene pagos registrados.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    @endif

</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const periodo = document.getElementById('periodo');

        function actualizarPeriodo() {
            if (!periodo) {
                return;
            }

            const seleccionado = periodo.value;

            document.querySelectorAll('.periodo-campo').forEach(function (campo) {
                const periodos = campo.dataset.periodo.split(' ');
                campo.style.display = periodos.includes(seleccionado)
                    ? 'block'
                    : 'none';
            });
        }

        if (periodo) {
            periodo.addEventListener('change', actualizarPeriodo);
            actualizarPeriodo();
        }

        const filtroComunidad = document.getElementById('filtro_comunidad');
        const comunario = document.getElementById('id_comunario');

        function filtrarComunarios() {
            if (!filtroComunidad || !comunario) {
                return;
            }

            const comunidadSeleccionada = filtroComunidad.value;

            Array.from(comunario.options).forEach(function (opcion) {
                if (opcion.value === '') {
                    opcion.hidden = false;
                    return;
                }

                opcion.hidden =
                    comunidadSeleccionada !== '' &&
                    opcion.dataset.comunidad !== comunidadSeleccionada;
            });

            const opcionActual = comunario.options[comunario.selectedIndex];

            if (opcionActual && opcionActual.hidden) {
                comunario.value = '';
            }
        }

        if (filtroComunidad && comunario) {
            const opcionSeleccionada =
                comunario.options[comunario.selectedIndex];

            if (opcionSeleccionada && opcionSeleccionada.value !== '') {
                filtroComunidad.value = opcionSeleccionada.dataset.comunidad;
            }

            filtroComunidad.addEventListener('change', filtrarComunarios);
            filtrarComunarios();
        }
    });
</script>
@endsection