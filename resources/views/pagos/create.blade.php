@extends('layouts.app')

@section('titulo', 'Registrar pago')
@section('encabezado', 'Registrar pago')

@section('contenido')
<style>
    .pago-contenedor {
        width: 100%;
    }

    .pago-acciones-superiores {
        margin-bottom: 20px;
        display: flex;
        justify-content: flex-end;
    }

    .boton-volver {
        min-height: 42px;
        padding: 0 18px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #cbd5e1;
        border-radius: 7px;
        color: #202124;
        background: #ffffff;
        font-size: 14px;
        font-weight: normal;
        text-decoration: none;
    }

    .boton-volver:hover {
        background: #f8fafc;
    }

    .tarjeta-pago {
        overflow: hidden;
        border: 1px solid #d8e3ef;
        border-radius: 10px;
        background: #ffffff;
    }

    .tarjeta-cabecera {
        padding: 22px 28px;
        border-bottom: 1px solid #e5edf5;
        background: #ffffff;
    }

    .tarjeta-cabecera h2 {
        margin: 0 0 6px;
        color: #202124;
        font-size: 23px;
        font-weight: normal;
    }

    .tarjeta-cabecera p {
        margin: 0;
        color: #5f6368;
        font-size: 14px;
        font-weight: normal;
    }

    .tarjeta-cuerpo {
        padding: 28px;
    }

    .alerta-errores {
        margin-bottom: 24px;
        padding: 15px 18px;
        border: 1px solid #f1b8b8;
        border-radius: 7px;
        color: #9f1c1c;
        background: #fff7f7;
        font-size: 14px;
    }

    .alerta-errores strong {
        display: block;
        margin-bottom: 7px;
        font-weight: 600;
    }

    .alerta-errores ul {
        margin: 0;
        padding-left: 20px;
    }

    .paso {
        margin-bottom: 25px;
    }

    .paso-titulo {
        margin-bottom: 11px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .paso-numero {
        width: 28px;
        height: 28px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        border-radius: 50%;
        color: #ffffff !important;
        background: #1769c2;
        font-size: 13px !important;
        font-weight: 600 !important;
    }

    .paso-titulo label,
    .paso-titulo > span:not(.paso-numero) {
        color: #202124;
        font-size: 16px;
        font-weight: normal;
    }

    .campo {
        width: 100%;
        min-height: 48px;
        padding: 10px 14px;
        border: 1px solid #cbd8e6;
        border-radius: 7px;
        color: #202124;
        background: #ffffff;
        font-family: inherit;
        font-size: 15px;
        font-weight: normal;
        outline: none;
    }

    .campo:focus {
        border-color: #1769c2;
        box-shadow: 0 0 0 2px rgba(23, 105, 194, 0.10);
    }

    .campo:disabled {
        color: #8b949e;
        background: #f3f6f9;
        cursor: not-allowed;
    }

    .campo-error {
        margin-top: 7px;
        color: #c62828;
        font-size: 13px;
    }

    .ayuda-campo {
        margin-top: 7px;
        color: #5f6368;
        font-size: 13px;
    }

    .resultados-comunarios {
        display: none;
        max-height: 280px;
        margin-top: 10px;
        overflow-y: auto;
        border: 1px solid #d8e3ef;
        border-radius: 7px;
        background: #ffffff;
    }

    .resultados-comunarios.visible {
        display: block;
    }

    .comunario-opcion {
        width: 100%;
        padding: 13px 15px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        border: none;
        border-bottom: 1px solid #edf1f5;
        color: #202124;
        background: #ffffff;
        font-family: inherit;
        text-align: left;
        cursor: pointer;
    }

    .comunario-opcion:last-child {
        border-bottom: none;
    }

    .comunario-opcion:hover {
        background: #f7f9fc;
    }

    .comunario-nombre {
        display: block;
        margin-bottom: 4px;
        color: #202124;
        font-size: 14px;
        font-weight: normal;
    }

    .comunario-ci {
        color: #5f6368;
        font-size: 13px;
        font-weight: normal;
    }

    .comunario-cantidad {
        flex-shrink: 0;
        padding: 5px 9px;
        border-radius: 5px;
        color: #202124;
        background: #edf3f8;
        font-size: 12px;
        font-weight: normal;
    }

    .sin-resultados {
        padding: 20px;
        color: #5f6368;
        font-size: 14px;
        text-align: center;
    }

    .comunario-seleccionado {
        display: none;
        margin-top: 11px;
        padding: 15px 17px;
        border: 1px solid #d8e3ef;
        border-radius: 7px;
        background: #f8fafc;
    }

    .comunario-seleccionado.visible {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
    }

    .comunario-seleccionado span {
        display: block;
        margin-bottom: 4px;
        color: #5f6368;
        font-size: 12px;
        font-weight: normal;
        text-transform: uppercase;
    }

    .comunario-seleccionado strong {
        color: #202124;
        font-size: 15px;
        font-weight: normal;
    }

    .boton-cambiar {
        padding: 7px 12px;
        border: 1px solid #cbd8e6;
        border-radius: 6px;
        color: #202124;
        background: #ffffff;
        font-family: inherit;
        font-size: 13px;
        font-weight: normal;
        cursor: pointer;
    }

    .boton-cambiar:hover {
        background: #f1f5f9;
    }

    .detalle-aporte {
        display: none;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 0;
        margin-top: 12px;
        overflow: hidden;
        border: 1px solid #d8e3ef;
        border-radius: 7px;
        background: #ffffff;
    }

    .detalle-aporte.visible {
        display: grid;
    }

    .detalle-dato {
        min-height: 82px;
        padding: 15px;
        border-right: 1px solid #e5edf5;
    }

    .detalle-dato:last-child {
        border-right: none;
    }

    .detalle-dato span {
        display: block;
        margin-bottom: 7px;
        color: #5f6368;
        font-size: 12px;
        font-weight: normal;
        text-transform: uppercase;
    }

    .detalle-dato strong,
    .detalle-dato .saldo {
        color: #202124;
        font-size: 16px;
        font-weight: normal;
    }

    .fila-pago {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 20px;
    }

    .grupo-campo label {
        display: block;
        margin-bottom: 8px;
        color: #202124;
        font-size: 14px;
        font-weight: normal;
    }

    .acciones {
        display: flex;
        justify-content: flex-end;
        gap: 11px;
        padding-top: 4px;
    }

    .boton-cancelar,
    .boton-registrar {
        min-width: 140px;
        min-height: 46px;
        padding: 0 20px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 7px;
        font-family: inherit;
        font-size: 14px;
        font-weight: normal;
        text-decoration: none;
    }

    .boton-cancelar {
        border: 1px solid #cbd8e6;
        color: #202124;
        background: #ffffff;
    }

    .boton-cancelar:hover {
        background: #f8fafc;
    }

    .boton-registrar {
        border: 1px solid #1769c2;
        color: #ffffff;
        background: #1769c2;
        cursor: pointer;
    }

    .boton-registrar:hover {
        background: #125aa8;
    }

    .boton-registrar:disabled {
        border-color: #b5c1cf;
        color: #ffffff;
        background: #b5c1cf;
        cursor: not-allowed;
    }

    @media (max-width: 750px) {
        .fila-pago,
        .detalle-aporte {
            grid-template-columns: 1fr;
        }

        .detalle-dato {
            border-right: none;
            border-bottom: 1px solid #e5edf5;
        }

        .detalle-dato:last-child {
            border-bottom: none;
        }

        .comunario-seleccionado {
            align-items: flex-start;
            flex-direction: column;
        }

        .tarjeta-cabecera,
        .tarjeta-cuerpo {
            padding: 21px;
        }
    }

    @media (max-width: 500px) {
        .pago-acciones-superiores {
            justify-content: stretch;
        }

        .boton-volver {
            width: 100%;
        }

        .acciones {
            flex-direction: column-reverse;
        }

        .boton-cancelar,
        .boton-registrar {
            width: 100%;
        }
    }
</style>

<div class="pago-contenedor">
    <div class="pago-acciones-superiores">
        <a
            href="{{ route('pagos.index') }}"
            class="boton-volver"
        >
            Volver a pagos
        </a>
    </div>

    <div class="tarjeta-pago">
        <div class="tarjeta-cabecera">
            <h2>Nuevo pago</h2>

            <p>
                Busca al comunario y selecciona el aporte que desea pagar.
            </p>
        </div>

        <div class="tarjeta-cuerpo">
            @if ($errors->any())
                <div class="alerta-errores">
                    <strong>Revisa los siguientes datos:</strong>

                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form
                action="{{ route('pagos.store') }}"
                method="POST"
            >
                @csrf

                <div class="paso">
                    <div class="paso-titulo">
                        <span class="paso-numero">1</span>

                        <label for="id_comunidad">
                            Selecciona la comunidad
                        </label>
                    </div>

                    <select
                        id="id_comunidad"
                        class="campo"
                    >
                        <option value="">
                            Selecciona una comunidad
                        </option>

                        @foreach ($comunidades as $comunidad)
                            <option
                                value="{{ $comunidad->id_comunidad }}"
                            >
                                {{ $comunidad->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="paso">
                    <div class="paso-titulo">
                        <span class="paso-numero">2</span>

                        <label for="buscar_comunario">
                            Busca al comunario
                        </label>
                    </div>

                    <input
                        type="text"
                        id="buscar_comunario"
                        class="campo"
                        placeholder="Escribe el nombre, apellido o CI"
                        autocomplete="off"
                        disabled
                    >

                    <div class="ayuda-campo">
                        Primero selecciona una comunidad y luego escribe
                        el nombre o CI.
                    </div>

                    <div
                        class="resultados-comunarios"
                        id="resultadosComunarios"
                    ></div>

                    <div
                        class="comunario-seleccionado"
                        id="comunarioSeleccionado"
                    >
                        <div>
                            <span>Comunario seleccionado</span>

                            <strong
                                id="nombreComunarioSeleccionado"
                            ></strong>

                            <div
                                class="comunario-ci"
                                id="ciComunarioSeleccionado"
                            ></div>
                        </div>

                        <button
                            type="button"
                            class="boton-cambiar"
                            id="botonCambiarComunario"
                        >
                            Cambiar comunario
                        </button>
                    </div>
                </div>

                <div class="paso">
                    <div class="paso-titulo">
                        <span class="paso-numero">3</span>

                        <label for="id_aporte_comunario">
                            Selecciona el aporte pendiente
                        </label>
                    </div>

                    <select
                        name="id_aporte_comunario"
                        id="id_aporte_comunario"
                        class="campo"
                        required
                        disabled
                    >
                        <option value="">
                            Selecciona un aporte pendiente
                        </option>
                    </select>

                    @error('id_aporte_comunario')
                        <div class="campo-error">
                            {{ $message }}
                        </div>
                    @enderror

                    <div
                        class="detalle-aporte"
                        id="detalleAporte"
                    >
                        <div class="detalle-dato">
                            <span>Aporte</span>

                            <strong id="detalleConcepto">
                                —
                            </strong>
                        </div>

                        <div class="detalle-dato">
                            <span>Monto asignado</span>

                            <strong id="detalleMonto">
                                Bs 0,00
                            </strong>
                        </div>

                        <div class="detalle-dato">
                            <span>Saldo pendiente</span>

                            <strong
                                class="saldo"
                                id="detalleSaldo"
                            >
                                Bs 0,00
                            </strong>
                        </div>
                    </div>
                </div>

                <div class="paso">
                    <div class="paso-titulo">
                        <span class="paso-numero">4</span>

                        <span>
                            Registra el monto recibido
                        </span>
                    </div>

                    <div class="fila-pago">
                        <div class="grupo-campo">
                            <label for="monto_pagado">
                                Monto pagado
                            </label>

                            <input
                                type="number"
                                name="monto_pagado"
                                id="monto_pagado"
                                class="campo"
                                value="{{ old('monto_pagado') }}"
                                min="0.01"
                                step="0.01"
                                placeholder="0,00"
                                required
                                disabled
                            >

                            @error('monto_pagado')
                                <div class="campo-error">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="grupo-campo">
                            <label for="fecha_pago">
                                Fecha y hora del pago
                            </label>

                            <input
                                type="datetime-local"
                                name="fecha_pago"
                                id="fecha_pago"
                                class="campo"
                                value="{{ old(
                                    'fecha_pago',
                                    now()->format('Y-m-d\TH:i')
                                ) }}"
                                max="{{ now()->format('Y-m-d\TH:i') }}"
                                required
                            >

                            @error('fecha_pago')
                                <div class="campo-error">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="acciones">
                    <a
                        href="{{ route('pagos.index') }}"
                        class="boton-cancelar"
                    >
                        Cancelar
                    </a>

                    <button
                        type="submit"
                        class="boton-registrar"
                        id="botonRegistrar"
                        disabled
                    >
                        Registrar pago
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@php
    $datosAsignaciones = $asignaciones->map(function ($asignacion) {
        return [
            'id' => $asignacion->id_aporte_comunario,
            'id_comunidad' => $asignacion->comunario->id_comunidad,
            'comunidad' =>
                $asignacion->comunario->comunidad->nombre ?? '',
            'id_comunario' =>
                $asignacion->comunario->id_comunario,
            'nombre' => trim(
                $asignacion->comunario->nombres.' '.
                $asignacion->comunario->apellidos
            ),
            'apellidos' =>
                $asignacion->comunario->apellidos,
            'nombres' =>
                $asignacion->comunario->nombres,
            'ci' =>
                $asignacion->comunario->ci,
            'aporte' =>
                $asignacion->aporte->concepto,
            'monto' =>
                (float) $asignacion->monto_asignado,
            'saldo' =>
                (float) $asignacion->saldo,
        ];
    })->values();

    $asignacionInicialFormulario = (int) old(
        'id_aporte_comunario',
        $idAporteComunario ?? 0
    );
@endphp

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const asignaciones = @json($datosAsignaciones);
        const asignacionInicial = @json(
            $asignacionInicialFormulario
        );

        const comunidad = document.getElementById(
            'id_comunidad'
        );

        const buscador = document.getElementById(
            'buscar_comunario'
        );

        const resultados = document.getElementById(
            'resultadosComunarios'
        );

        const comunarioSeleccionado = document.getElementById(
            'comunarioSeleccionado'
        );

        const nombreSeleccionado = document.getElementById(
            'nombreComunarioSeleccionado'
        );

        const ciSeleccionado = document.getElementById(
            'ciComunarioSeleccionado'
        );

        const botonCambiar = document.getElementById(
            'botonCambiarComunario'
        );

        const aporte = document.getElementById(
            'id_aporte_comunario'
        );

        const detalle = document.getElementById(
            'detalleAporte'
        );

        const detalleConcepto = document.getElementById(
            'detalleConcepto'
        );

        const detalleMonto = document.getElementById(
            'detalleMonto'
        );

        const detalleSaldo = document.getElementById(
            'detalleSaldo'
        );

        const montoPagado = document.getElementById(
            'monto_pagado'
        );

        const botonRegistrar = document.getElementById(
            'botonRegistrar'
        );

        let idComunarioSeleccionado = null;

        function normalizar(texto) {
            return String(texto || '')
                .normalize('NFD')
                .replace(/[\u0300-\u036f]/g, '')
                .toLowerCase()
                .trim();
        }

        function dinero(valor) {
            return 'Bs ' + Number(valor).toLocaleString(
                'es-BO',
                {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                }
            );
        }

        function comunariosDeComunidad() {
            const idComunidad = Number(comunidad.value);
            const unicos = new Map();

            asignaciones
                .filter(function (item) {
                    return Number(item.id_comunidad) ===
                        idComunidad;
                })
                .forEach(function (item) {
                    if (!unicos.has(item.id_comunario)) {
                        unicos.set(
                            item.id_comunario,
                            {
                                id: item.id_comunario,
                                nombre: item.nombre,
                                apellidos: item.apellidos,
                                nombres: item.nombres,
                                ci: item.ci,
                                cantidad: 0
                            }
                        );
                    }

                    unicos.get(
                        item.id_comunario
                    ).cantidad++;
                });

            return Array.from(unicos.values()).sort(
                function (a, b) {
                    return normalizar(
                        a.apellidos + ' ' + a.nombres
                    ).localeCompare(
                        normalizar(
                            b.apellidos + ' ' + b.nombres
                        )
                    );
                }
            );
        }

        function mostrarComunarios() {
            if (
                !comunidad.value ||
                idComunarioSeleccionado
            ) {
                resultados.classList.remove('visible');
                resultados.innerHTML = '';
                return;
            }

            const texto = normalizar(buscador.value);

            const comunarios = comunariosDeComunidad().filter(
                function (item) {
                    return normalizar(
                        item.nombre + ' ' + item.ci
                    ).includes(texto);
                }
            );

            resultados.innerHTML = '';

            if (comunarios.length === 0) {
                const sinResultados =
                    document.createElement('div');

                sinResultados.className = 'sin-resultados';

                sinResultados.textContent =
                    'No se encontraron comunarios pendientes.';

                resultados.appendChild(sinResultados);
                resultados.classList.add('visible');

                return;
            }

            comunarios.forEach(function (item) {
                const boton =
                    document.createElement('button');

                const datos =
                    document.createElement('div');

                const nombre =
                    document.createElement('span');

                const ci =
                    document.createElement('span');

                const cantidad =
                    document.createElement('span');

                boton.type = 'button';
                boton.className = 'comunario-opcion';

                nombre.className = 'comunario-nombre';
                nombre.textContent = item.nombre;

                ci.className = 'comunario-ci';
                ci.textContent = 'CI: ' + item.ci;

                cantidad.className = 'comunario-cantidad';

                cantidad.textContent =
                    item.cantidad === 1
                        ? '1 aporte pendiente'
                        : item.cantidad +
                            ' aportes pendientes';

                datos.appendChild(nombre);
                datos.appendChild(ci);

                boton.appendChild(datos);
                boton.appendChild(cantidad);

                boton.addEventListener(
                    'click',
                    function () {
                        seleccionarComunario(item);
                    }
                );

                resultados.appendChild(boton);
            });

            resultados.classList.add('visible');
        }

        function seleccionarComunario(item) {
            idComunarioSeleccionado = Number(item.id);

            nombreSeleccionado.textContent = item.nombre;
            ciSeleccionado.textContent = 'CI: ' + item.ci;

            comunarioSeleccionado.classList.add('visible');
            resultados.classList.remove('visible');

            buscador.value = item.nombre;
            buscador.disabled = true;

            cargarAportes();
        }

        function cargarAportes(idSeleccionado = 0) {
            aporte.innerHTML = '';

            const opcionInicial =
                document.createElement('option');

            opcionInicial.value = '';

            opcionInicial.textContent =
                'Selecciona un aporte pendiente';

            aporte.appendChild(opcionInicial);

            const aportesComunario = asignaciones.filter(
                function (item) {
                    return Number(item.id_comunario) ===
                        Number(idComunarioSeleccionado);
                }
            );

            aportesComunario.forEach(function (item) {
                const opcion =
                    document.createElement('option');

                opcion.value = item.id;

                opcion.textContent =
                    item.aporte +
                    ' — Saldo: ' +
                    dinero(item.saldo);

                if (
                    Number(item.id) ===
                    Number(idSeleccionado)
                ) {
                    opcion.selected = true;
                }

                aporte.appendChild(opcion);
            });

            aporte.disabled = false;

            if (idSeleccionado) {
                actualizarDetalleAporte();
            } else {
                limpiarDetalleAporte();
            }
        }

        function limpiarDetalleAporte() {
            detalle.classList.remove('visible');
            montoPagado.disabled = true;
            montoPagado.removeAttribute('max');
            botonRegistrar.disabled = true;
        }

        function actualizarDetalleAporte() {
            const seleccion = asignaciones.find(
                function (item) {
                    return Number(item.id) ===
                        Number(aporte.value);
                }
            );

            if (!seleccion) {
                limpiarDetalleAporte();
                return;
            }

            detalleConcepto.textContent =
                seleccion.aporte;

            detalleMonto.textContent =
                dinero(seleccion.monto);

            detalleSaldo.textContent =
                dinero(seleccion.saldo);

            detalle.classList.add('visible');

            montoPagado.disabled = false;

            montoPagado.max = Number(
                seleccion.saldo
            ).toFixed(2);

            botonRegistrar.disabled = false;

            if (
                montoPagado.value &&
                Number(montoPagado.value) >
                    Number(seleccion.saldo)
            ) {
                montoPagado.value = Number(
                    seleccion.saldo
                ).toFixed(2);
            }
        }

        function reiniciarComunario() {
            idComunarioSeleccionado = null;

            buscador.value = '';
            buscador.disabled = !comunidad.value;

            comunarioSeleccionado.classList.remove(
                'visible'
            );

            aporte.innerHTML = '';

            const opcionInicial =
                document.createElement('option');

            opcionInicial.value = '';

            opcionInicial.textContent =
                'Selecciona un aporte pendiente';

            aporte.appendChild(opcionInicial);
            aporte.disabled = true;

            limpiarDetalleAporte();

            if (comunidad.value) {
                mostrarComunarios();
                buscador.focus();
            }
        }

        comunidad.addEventListener(
            'change',
            function () {
                reiniciarComunario();

                if (comunidad.value) {
                    buscador.disabled = false;
                    mostrarComunarios();
                }
            }
        );

        buscador.addEventListener(
            'input',
            mostrarComunarios
        );

        buscador.addEventListener(
            'focus',
            mostrarComunarios
        );

        botonCambiar.addEventListener(
            'click',
            reiniciarComunario
        );

        aporte.addEventListener(
            'change',
            actualizarDetalleAporte
        );

        if (asignacionInicial) {
            const inicial = asignaciones.find(
                function (item) {
                    return Number(item.id) ===
                        Number(asignacionInicial);
                }
            );

            if (inicial) {
                comunidad.value = inicial.id_comunidad;
                buscador.disabled = false;

                seleccionarComunario({
                    id: inicial.id_comunario,
                    nombre: inicial.nombre,
                    ci: inicial.ci
                });

                cargarAportes(inicial.id);
            }
        }
    });
</script>
@endsection