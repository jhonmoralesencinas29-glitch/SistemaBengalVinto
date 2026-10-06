@extends('layouts.app')

@section('titulo', 'Registrar asistencia')
@section('encabezado', 'Registrar asistencia')

@section('contenido')
<style>
    .asistencia-contenedor {
        color: #202124;
    }

    .asistencia-encabezado {
        margin-bottom: 24px;
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 20px;
    }

    .asistencia-encabezado h2 {
        margin: 0 0 7px;
        font-size: 28px;
        font-weight: normal;
    }

    .asistencia-encabezado p {
        margin: 0;
        color: #5f6368;
        font-size: 15px;
    }

    .boton-volver {
        min-height: 44px;
        padding: 0 18px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #cbd8e6;
        border-radius: 8px;
        color: #202124;
        background: #ffffff;
        font-size: 14px;
        text-decoration: none;
        white-space: nowrap;
    }

    .boton-volver:hover {
        background: #f5f7fa;
    }

    .mensaje-error {
        margin-bottom: 20px;
        padding: 15px 18px;
        border: 1px solid #f1aeb5;
        border-radius: 8px;
        color: #842029;
        background: #f8d7da;
        font-size: 14px;
    }

    .mensaje-error p {
        margin: 0 0 8px;
    }

    .mensaje-error ul {
        margin: 0;
        padding-left: 20px;
    }

    .resumen-reunion {
        margin-bottom: 24px;
        padding: 22px;
        border: 1px solid #d8e3ef;
        border-radius: 12px;
        background: #ffffff;
    }

    .resumen-reunion h3 {
        margin: 0 0 17px;
        font-size: 20px;
        font-weight: normal;
    }

    .datos-reunion {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        border: 1px solid #d8e3ef;
        border-radius: 9px;
        overflow: hidden;
    }

    .dato-reunion {
        padding: 15px 17px;
        border-right: 1px solid #d8e3ef;
    }

    .dato-reunion:last-child {
        border-right: none;
    }

    .dato-reunion span {
        display: block;
        margin-bottom: 6px;
        color: #5f6368;
        font-size: 12px;
        text-transform: uppercase;
    }

    .dato-reunion strong {
        display: block;
        font-size: 15px;
        font-weight: normal;
        overflow-wrap: anywhere;
    }

    .tarjeta-asistencia {
        overflow: hidden;
        border: 1px solid #d8e3ef;
        border-radius: 12px;
        background: #ffffff;
    }

    .titulo-lista {
        padding: 22px 24px;
        border-bottom: 1px solid #e5edf5;
    }

    .titulo-lista h3 {
        margin: 0 0 6px;
        font-size: 21px;
        font-weight: normal;
    }

    .titulo-lista p {
        margin: 0;
        color: #5f6368;
        font-size: 14px;
        line-height: 1.5;
    }

    .contadores-generales {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        border-bottom: 1px solid #e5edf5;
        background: #fafbfd;
    }

    .contador-general {
        padding: 14px;
        border-right: 1px solid #e5edf5;
        text-align: center;
    }

    .contador-general:last-child {
        border-right: none;
    }

    .contador-general span {
        display: block;
        margin-bottom: 4px;
        color: #5f6368;
        font-size: 13px;
    }

    .contador-general strong {
        font-size: 21px;
        font-weight: normal;
    }

    .navegacion-comunidades {
        padding: 16px 20px;
        display: flex;
        gap: 9px;
        overflow-x: auto;
        border-bottom: 1px solid #e5edf5;
        background: #ffffff;
    }

    .boton-comunidad {
        min-height: 42px;
        padding: 0 16px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        flex: 0 0 auto;
        border: 1px solid #cbd8e6;
        border-radius: 8px;
        color: #202124;
        background: #ffffff;
        font-size: 14px;
        cursor: pointer;
    }

    .boton-comunidad:hover {
        background: #f5f7fa;
    }

    .boton-comunidad.activo {
        border-color: #1769c2;
        color: #ffffff;
        background: #1769c2;
    }

    .cantidad-comunidad {
        min-width: 24px;
        height: 24px;
        padding: 0 6px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        color: #202124;
        background: #edf2f7;
        font-size: 12px;
    }

    .boton-comunidad.activo .cantidad-comunidad {
        color: #1769c2;
        background: #ffffff;
    }

    .panel-comunidad {
        display: none;
    }

    .panel-comunidad.activo {
        display: block;
    }

    .encabezado-comunidad {
        padding: 20px 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 18px;
        border-bottom: 1px solid #e5edf5;
        background: #f8fafc;
    }

    .encabezado-comunidad h4 {
        margin: 0 0 5px;
        font-size: 20px;
        font-weight: normal;
    }

    .encabezado-comunidad p {
        margin: 0;
        color: #5f6368;
        font-size: 13px;
    }

    .boton-presentes-comunidad {
        min-height: 40px;
        padding: 0 15px;
        border: 1px solid #cbd8e6;
        border-radius: 7px;
        color: #202124;
        background: #ffffff;
        font-size: 13px;
        cursor: pointer;
        white-space: nowrap;
    }

    .boton-presentes-comunidad:hover {
        background: #f1f5f9;
    }

    .resumen-comunidad {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        border-bottom: 1px solid #e5edf5;
    }

    .resumen-comunidad div {
        padding: 11px;
        border-right: 1px solid #e5edf5;
        text-align: center;
    }

    .resumen-comunidad div:last-child {
        border-right: none;
    }

    .resumen-comunidad span {
        color: #5f6368;
        font-size: 12px;
    }

    .resumen-comunidad strong {
        margin-left: 5px;
        font-size: 14px;
        font-weight: normal;
    }

    .tabla-responsive {
        width: 100%;
        overflow-x: auto;
    }

    .tabla-asistencia {
        width: 100%;
        min-width: 900px;
        border-collapse: collapse;
    }

    .tabla-asistencia th {
        padding: 13px 15px;
        border-bottom: 1px solid #dfe7f0;
        color: #202124;
        background: #f7f9fc;
        font-size: 13px;
        font-weight: normal;
        text-align: left;
    }

    .tabla-asistencia td {
        padding: 14px 15px;
        border-bottom: 1px solid #edf1f5;
        font-size: 14px;
        vertical-align: middle;
    }

    .tabla-asistencia tbody tr:last-child td {
        border-bottom: none;
    }

    .tabla-asistencia tbody tr:hover {
        background: #fafcff;
    }

    .columna-numero {
        width: 60px;
        text-align: center !important;
    }

    .nombre-comunario {
        margin-bottom: 4px;
    }

    .ci-comunario {
        color: #5f6368;
        font-size: 13px;
    }

    .campo-estado,
    .campo-observacion {
        width: 100%;
        padding: 10px 11px;
        border: 1px solid #cbd8e6;
        border-radius: 7px;
        color: #202124;
        background: #ffffff;
        font-size: 14px;
        outline: none;
    }

    .campo-estado {
        min-width: 140px;
    }

    .campo-observacion {
        min-width: 240px;
    }

    .campo-estado:focus,
    .campo-observacion:focus {
        border-color: #1769c2;
    }

    .campo-con-error {
        border-color: #dc3545;
    }

    .error-campo {
        display: block;
        margin-top: 5px;
        color: #b42318;
        font-size: 12px;
    }

    .navegacion-inferior {
        padding: 18px 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        border-top: 1px solid #e5edf5;
        background: #fafbfd;
    }

    .progreso-comunidad {
        color: #5f6368;
        font-size: 13px;
        text-align: center;
    }

    .boton-anterior,
    .boton-siguiente {
        min-height: 40px;
        min-width: 120px;
        padding: 0 16px;
        border: 1px solid #cbd8e6;
        border-radius: 7px;
        color: #202124;
        background: #ffffff;
        font-size: 13px;
        cursor: pointer;
    }

    .boton-anterior:hover,
    .boton-siguiente:hover {
        background: #f1f5f9;
    }

    .boton-anterior:disabled,
    .boton-siguiente:disabled {
        color: #9ca3af;
        background: #f3f4f6;
        cursor: not-allowed;
    }

    .acciones-formulario {
        padding: 20px 24px;
        display: flex;
        justify-content: flex-end;
        gap: 12px;
        border-top: 1px solid #e5edf5;
    }

    .boton-cancelar,
    .boton-guardar {
        min-height: 44px;
        padding: 0 20px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        font-size: 14px;
        text-decoration: none;
    }

    .boton-cancelar {
        border: 1px solid #cbd8e6;
        color: #202124;
        background: #ffffff;
    }

    .boton-guardar {
        border: 1px solid #1769c2;
        color: #ffffff;
        background: #1769c2;
        cursor: pointer;
    }

    .boton-guardar:hover {
        background: #1059a6;
    }

    .boton-guardar:disabled {
        border-color: #9ca3af;
        background: #9ca3af;
        cursor: not-allowed;
    }

    .sin-comunarios {
        padding: 40px 20px;
        color: #5f6368;
        text-align: center;
    }

    @media (max-width: 900px) {
        .datos-reunion {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .dato-reunion:nth-child(2) {
            border-right: none;
        }

        .dato-reunion:nth-child(-n+2) {
            border-bottom: 1px solid #d8e3ef;
        }
    }

    @media (max-width: 700px) {
        .asistencia-encabezado,
        .encabezado-comunidad {
            flex-direction: column;
            align-items: stretch;
        }

        .boton-volver,
        .boton-presentes-comunidad {
            width: 100%;
        }

        .datos-reunion,
        .contadores-generales,
        .resumen-comunidad {
            grid-template-columns: 1fr;
        }

        .dato-reunion,
        .contador-general,
        .resumen-comunidad div {
            border-right: none;
            border-bottom: 1px solid #e5edf5;
        }

        .dato-reunion:last-child,
        .contador-general:last-child,
        .resumen-comunidad div:last-child {
            border-bottom: none;
        }

        .navegacion-inferior {
            flex-wrap: wrap;
        }

        .progreso-comunidad {
            width: 100%;
            order: -1;
        }

        .boton-anterior,
        .boton-siguiente {
            flex: 1;
        }

        .acciones-formulario {
            flex-direction: column-reverse;
        }

        .boton-cancelar,
        .boton-guardar {
            width: 100%;
        }
    }
</style>

@php
    $ordenComunidades = [
        'Bengal Vinto',
        'Loma',
        'Achuata',
        'Totorani',
        'Cilupata',
        'Peña Blanca',
        'Huaylla',
    ];

    $comunariosPorComunidad = $comunarios
        ->groupBy('id_comunidad')
        ->sortBy(function ($grupo) use ($ordenComunidades) {
            $nombre = $grupo->first()?->comunidad?->nombre ?? '';

            $posicion = array_search(
                $nombre,
                $ordenComunidades,
                true
            );

            return $posicion === false ? 999 : $posicion;
        });
@endphp

<div class="asistencia-contenedor">
    <div class="asistencia-encabezado">
        <div>
            <h2>Registrar asistencia</h2>

            <p>
                La lista está separada por comunidades para facilitar
                el llamado de asistencia.
            </p>
        </div>

        <a
            href="{{ route('reuniones.show', $reunion) }}"
            class="boton-volver"
        >
            Volver al detalle
        </a>
    </div>

    @if ($errors->any())
        <div class="mensaje-error">
            <p>No se pudo guardar la asistencia:</p>

            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="resumen-reunion">
        <h3>Información de la reunión</h3>

        <div class="datos-reunion">
            <div class="dato-reunion">
                <span>Fecha</span>

                <strong>
                    {{ $reunion->fecha->format('d/m/Y') }}
                </strong>
            </div>

            <div class="dato-reunion">
                <span>Hora</span>

                <strong>
                    @if ($reunion->hora)
                        {{ \Carbon\Carbon::parse(
                            $reunion->hora
                        )->format('H:i') }}
                    @else
                        No especificada
                    @endif
                </strong>
            </div>

            <div class="dato-reunion">
                <span>Lugar</span>

                <strong>{{ $reunion->lugar }}</strong>
            </div>

            <div class="dato-reunion">
                <span>Estado</span>

                <strong>{{ ucfirst($reunion->estado) }}</strong>
            </div>
        </div>
    </div>

    <form
        action="{{ route('reuniones.asistencia.guardar', $reunion) }}"
        method="POST"
        id="formulario-asistencia"
    >
        @csrf
        @method('PUT')

        <div class="tarjeta-asistencia">
            <div class="titulo-lista">
                <h3>Lista de comunarios</h3>

                <p>
                    Selecciona una comunidad y registra la asistencia de
                    sus comunarios. Inicialmente todos aparecen como presentes.
                </p>
            </div>

            @if ($comunarios->isNotEmpty())
                <div class="contadores-generales">
                    <div class="contador-general">
                        <span>Presentes</span>
                        <strong id="contador-presente">0</strong>
                    </div>

                    <div class="contador-general">
                        <span>Retrasos</span>
                        <strong id="contador-retraso">0</strong>
                    </div>

                    <div class="contador-general">
                        <span>Faltas</span>
                        <strong id="contador-falta">0</strong>
                    </div>

                    <div class="contador-general">
                        <span>Licencias</span>
                        <strong id="contador-licencia">0</strong>
                    </div>
                </div>

                <div class="navegacion-comunidades">
                    @foreach ($comunariosPorComunidad as $idComunidad => $grupo)
                        <button
                            type="button"
                            class="boton-comunidad
                                {{ $loop->first ? 'activo' : '' }}"
                            data-indice="{{ $loop->index }}"
                            data-panel="comunidad-{{ $idComunidad }}"
                        >
                            {{ $grupo->first()?->comunidad?->nombre
                                ?? 'Sin comunidad' }}

                            <span class="cantidad-comunidad">
                                {{ $grupo->count() }}
                            </span>
                        </button>
                    @endforeach
                </div>

                @foreach ($comunariosPorComunidad as $idComunidad => $grupo)
                    @php
                        $nombreComunidad =
                            $grupo->first()?->comunidad?->nombre
                            ?? 'Sin comunidad';
                    @endphp

                    <section
                        id="comunidad-{{ $idComunidad }}"
                        class="panel-comunidad
                            {{ $loop->first ? 'activo' : '' }}"
                        data-indice="{{ $loop->index }}"
                    >
                        <div class="encabezado-comunidad">
                            <div>
                                <h4>{{ $nombreComunidad }}</h4>

                                <p>
                                    {{ $grupo->count() }}
                                    {{ $grupo->count() === 1
                                        ? 'comunario convocado'
                                        : 'comunarios convocados' }}
                                </p>
                            </div>

                            <button
                                type="button"
                                class="boton-presentes-comunidad"
                                data-marcar-comunidad="{{ $idComunidad }}"
                            >
                                Marcar esta comunidad como presente
                            </button>
                        </div>

                        <div class="resumen-comunidad">
                            <div>
                                <span>Presentes:</span>

                                <strong
                                    data-contador-comunidad="{{ $idComunidad }}"
                                    data-estado="presente"
                                >
                                    0
                                </strong>
                            </div>

                            <div>
                                <span>Retrasos:</span>

                                <strong
                                    data-contador-comunidad="{{ $idComunidad }}"
                                    data-estado="retraso"
                                >
                                    0
                                </strong>
                            </div>

                            <div>
                                <span>Faltas:</span>

                                <strong
                                    data-contador-comunidad="{{ $idComunidad }}"
                                    data-estado="falta"
                                >
                                    0
                                </strong>
                            </div>

                            <div>
                                <span>Licencias:</span>

                                <strong
                                    data-contador-comunidad="{{ $idComunidad }}"
                                    data-estado="licencia"
                                >
                                    0
                                </strong>
                            </div>
                        </div>

                        <div class="tabla-responsive">
                            <table class="tabla-asistencia">
                                <thead>
                                    <tr>
                                        <th class="columna-numero">N.º</th>
                                        <th>Comunario</th>
                                        <th>Estado de asistencia</th>
                                        <th>Observación</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($grupo as $indice => $comunario)
                                        @php
                                            $idComunario =
                                                $comunario->id_comunario;

                                            $registro = $asistencias->get(
                                                $idComunario
                                            );

                                            $estadoActual = old(
                                                "asistencias.{$idComunario}.estado_asistencia",
                                                $registro?->estado_asistencia
                                                    ?? 'presente'
                                            );

                                            $observacionActual = old(
                                                "asistencias.{$idComunario}.observacion",
                                                $registro?->observacion ?? ''
                                            );
                                        @endphp

                                        <tr>
                                            <td class="columna-numero">
                                                {{ $loop->iteration }}
                                            </td>

                                            <td>
                                                <div class="nombre-comunario">
                                                    {{ $comunario->nombres }}
                                                    {{ $comunario->apellidos }}
                                                </div>

                                                <div class="ci-comunario">
                                                    CI: {{ $comunario->ci }}
                                                </div>
                                            </td>

                                            <td>
                                                <select
                                                    name="asistencias[{{ $idComunario }}][estado_asistencia]"
                                                    class="campo-estado asistencia-estado
                                                        @error("asistencias.{$idComunario}.estado_asistencia")
                                                            campo-con-error
                                                        @enderror"
                                                    data-comunidad="{{ $idComunidad }}"
                                                    required
                                                >
                                                    <option
                                                        value="presente"
                                                        @selected(
                                                            $estadoActual
                                                            === 'presente'
                                                        )
                                                    >
                                                        Presente
                                                    </option>

                                                    <option
                                                        value="retraso"
                                                        @selected(
                                                            $estadoActual
                                                            === 'retraso'
                                                        )
                                                    >
                                                        Retraso
                                                    </option>

                                                    <option
                                                        value="falta"
                                                        @selected(
                                                            $estadoActual
                                                            === 'falta'
                                                        )
                                                    >
                                                        Falta
                                                    </option>

                                                    <option
                                                        value="licencia"
                                                        @selected(
                                                            $estadoActual
                                                            === 'licencia'
                                                        )
                                                    >
                                                        Licencia
                                                    </option>
                                                </select>

                                                @error("asistencias.{$idComunario}.estado_asistencia")
                                                    <span class="error-campo">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </td>

                                            <td>
                                                <input
                                                    type="text"
                                                    name="asistencias[{{ $idComunario }}][observacion]"
                                                    value="{{ $observacionActual }}"
                                                    maxlength="200"
                                                    class="campo-observacion
                                                        @error("asistencias.{$idComunario}.observacion")
                                                            campo-con-error
                                                        @enderror"
                                                    placeholder="Observación opcional"
                                                >

                                                @error("asistencias.{$idComunario}.observacion")
                                                    <span class="error-campo">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </section>
                @endforeach

                <div class="navegacion-inferior">
                    <button
                        type="button"
                        class="boton-anterior"
                        id="boton-anterior"
                    >
                        Anterior
                    </button>

                    <div
                        class="progreso-comunidad"
                        id="progreso-comunidad"
                    ></div>

                    <button
                        type="button"
                        class="boton-siguiente"
                        id="boton-siguiente"
                    >
                        Siguiente
                    </button>
                </div>
            @else
                <div class="sin-comunarios">
                    No existen comunarios activos en las comunidades
                    seleccionadas.
                </div>
            @endif

            <div class="acciones-formulario">
                <a
                    href="{{ route('reuniones.show', $reunion) }}"
                    class="boton-cancelar"
                >
                    Cancelar
                </a>

                <button
                    type="submit"
                    class="boton-guardar"
                    id="boton-guardar"
                    @disabled($comunarios->isEmpty())
                >
                    Guardar asistencia
                </button>
            </div>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const pestanas = Array.from(
            document.querySelectorAll('.boton-comunidad')
        );

        const paneles = Array.from(
            document.querySelectorAll('.panel-comunidad')
        );

        const estados = Array.from(
            document.querySelectorAll('.asistencia-estado')
        );

        const botonAnterior = document.getElementById(
            'boton-anterior'
        );

        const botonSiguiente = document.getElementById(
            'boton-siguiente'
        );

        const progreso = document.getElementById(
            'progreso-comunidad'
        );

        const formulario = document.getElementById(
            'formulario-asistencia'
        );

        const botonGuardar = document.getElementById(
            'boton-guardar'
        );

        let indiceActual = 0;

        function mostrarComunidad(indice) {
            if (indice < 0 || indice >= paneles.length) {
                return;
            }

            indiceActual = indice;

            pestanas.forEach(function (pestana, posicion) {
                pestana.classList.toggle(
                    'activo',
                    posicion === indiceActual
                );
            });

            paneles.forEach(function (panel, posicion) {
                panel.classList.toggle(
                    'activo',
                    posicion === indiceActual
                );
            });

            if (botonAnterior) {
                botonAnterior.disabled = indiceActual === 0;
            }

            if (botonSiguiente) {
                botonSiguiente.disabled =
                    indiceActual === paneles.length - 1;
            }

            if (progreso && pestanas[indiceActual]) {
                const nombre = pestanas[indiceActual]
                    .childNodes[0]
                    .textContent
                    .trim();

                progreso.textContent =
                    'Comunidad '
                    + (indiceActual + 1)
                    + ' de '
                    + paneles.length
                    + ': '
                    + nombre;
            }

            if (pestanas[indiceActual]) {
                pestanas[indiceActual].scrollIntoView({
                    behavior: 'smooth',
                    block: 'nearest',
                    inline: 'center'
                });
            }
        }

        function actualizarContadores() {
            const totales = {
                presente: 0,
                retraso: 0,
                falta: 0,
                licencia: 0
            };

            estados.forEach(function (campo) {
                if (totales[campo.value] !== undefined) {
                    totales[campo.value]++;
                }
            });

            Object.keys(totales).forEach(function (estado) {
                const contador = document.getElementById(
                    'contador-' + estado
                );

                if (contador) {
                    contador.textContent = totales[estado];
                }
            });

            paneles.forEach(function (panel) {
                const camposPanel = Array.from(
                    panel.querySelectorAll('.asistencia-estado')
                );

                const idComunidad = camposPanel[0]
                    ? camposPanel[0].dataset.comunidad
                    : null;

                if (!idComunidad) {
                    return;
                }

                const cantidades = {
                    presente: 0,
                    retraso: 0,
                    falta: 0,
                    licencia: 0
                };

                camposPanel.forEach(function (campo) {
                    if (cantidades[campo.value] !== undefined) {
                        cantidades[campo.value]++;
                    }
                });

                Object.keys(cantidades).forEach(function (estado) {
                    const contador = document.querySelector(
                        '[data-contador-comunidad="'
                        + idComunidad
                        + '"][data-estado="'
                        + estado
                        + '"]'
                    );

                    if (contador) {
                        contador.textContent = cantidades[estado];
                    }
                });
            });
        }

        pestanas.forEach(function (pestana, indice) {
            pestana.addEventListener('click', function () {
                mostrarComunidad(indice);
            });
        });

        if (botonAnterior) {
            botonAnterior.addEventListener('click', function () {
                mostrarComunidad(indiceActual - 1);
            });
        }

        if (botonSiguiente) {
            botonSiguiente.addEventListener('click', function () {
                mostrarComunidad(indiceActual + 1);
            });
        }

        estados.forEach(function (campo) {
            campo.addEventListener(
                'change',
                actualizarContadores
            );
        });

        document
            .querySelectorAll('[data-marcar-comunidad]')
            .forEach(function (boton) {
                boton.addEventListener('click', function () {
                    const idComunidad =
                        boton.dataset.marcarComunidad;

                    estados.forEach(function (campo) {
                        if (
                            campo.dataset.comunidad
                            === idComunidad
                        ) {
                            campo.value = 'presente';
                        }
                    });

                    actualizarContadores();
                });
            });

        if (formulario && botonGuardar) {
            formulario.addEventListener('submit', function () {
                botonGuardar.disabled = true;
                botonGuardar.textContent = 'Guardando...';
            });
        }

        actualizarContadores();

        if (paneles.length > 0) {
            mostrarComunidad(0);
        }
    });
</script>
@endsection