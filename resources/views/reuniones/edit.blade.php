@extends('layouts.app')

@section('titulo', 'Editar reunión')
@section('encabezado', 'Editar reunión')

@section('contenido')
<style>
    .editar-reunion {
        width: 100%;
        max-width: 1150px;
        margin: 0 auto;
        color: #202124;
    }

    .encabezado-formulario {
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
    }

    .encabezado-formulario h2 {
        margin: 0 0 6px;
        color: #202124;
        font-size: 28px;
        font-weight: normal;
    }

    .encabezado-formulario p {
        margin: 0;
        color: #4b5563;
        font-size: 14px;
    }

    .acciones-superiores {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .boton-volver {
        min-height: 43px;
        padding: 0 17px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #cbd8e6;
        border-radius: 7px;
        color: #202124;
        background: #ffffff;
        font-size: 14px;
        font-weight: normal;
        text-decoration: none;
    }

    .boton-volver:hover {
        background: #f1f5f9;
    }

    .errores-formulario {
        margin-bottom: 20px;
        padding: 16px 18px;
        border: 1px solid #e9b8b8;
        border-radius: 8px;
        color: #202124;
        background: #fff5f5;
    }

    .errores-formulario p {
        margin: 0 0 8px;
        font-size: 14px;
    }

    .errores-formulario ul {
        margin: 0;
        padding-left: 20px;
    }

    .errores-formulario li {
        margin-bottom: 4px;
        font-size: 13px;
    }

    .tarjeta-formulario {
        overflow: hidden;
        border: 1px solid #d8e3ef;
        border-radius: 14px;
        background: #ffffff;
    }

    .titulo-seccion {
        padding: 24px 28px;
        border-bottom: 1px solid #e5edf5;
        background: #f8fafc;
    }

    .titulo-seccion h3 {
        margin: 0 0 6px;
        color: #202124;
        font-size: 21px;
        font-weight: normal;
    }

    .titulo-seccion p {
        margin: 0;
        color: #4b5563;
        font-size: 14px;
    }

    .formulario-cuerpo {
        padding: 28px;
    }

    .campos-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 22px;
    }

    .campo-formulario {
        min-width: 0;
    }

    .campo-completo {
        grid-column: 1 / -1;
    }

    .campo-formulario label {
        margin-bottom: 8px;
        display: block;
        color: #202124;
        font-size: 14px;
        font-weight: normal;
    }

    .campo-formulario input,
    .campo-formulario textarea,
    .campo-formulario select {
        width: 100%;
        padding: 11px 13px;
        border: 1px solid #cbd8e6;
        border-radius: 7px;
        color: #202124;
        background: #ffffff;
        font-family: inherit;
        font-size: 14px;
        outline: none;
        box-sizing: border-box;
    }

    .campo-formulario input,
    .campo-formulario select {
        min-height: 46px;
    }

    .campo-formulario textarea {
        min-height: 130px;
        resize: vertical;
    }

    .campo-formulario input:focus,
    .campo-formulario textarea:focus,
    .campo-formulario select:focus {
        border-color: #1769c2;
    }

    .campo-error input,
    .campo-error textarea,
    .campo-error select {
        border-color: #c94b4b;
    }

    .mensaje-error {
        margin-top: 6px;
        display: block;
        color: #a52727;
        font-size: 12px;
    }

    .texto-ayuda {
        margin: 7px 0 0;
        color: #64748b;
        font-size: 12px;
        line-height: 1.5;
    }

    .aviso-bloqueado {
        margin-bottom: 16px;
        padding: 13px 15px;
        border: 1px solid #e7d7a5;
        border-radius: 8px;
        color: #202124;
        background: #fffbea;
        font-size: 13px;
        line-height: 1.5;
    }

    .seccion-comunidades {
        margin-top: 30px;
        padding-top: 26px;
        border-top: 1px solid #e5edf5;
    }

    .encabezado-comunidades {
        margin-bottom: 18px;
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        gap: 16px;
    }

    .encabezado-comunidades h3 {
        margin: 0 0 5px;
        color: #202124;
        font-size: 19px;
        font-weight: normal;
    }

    .encabezado-comunidades p {
        margin: 0;
        color: #4b5563;
        font-size: 13px;
    }

    .boton-seleccionar {
        min-height: 38px;
        padding: 0 14px;
        border: 1px solid #cbd8e6;
        border-radius: 7px;
        color: #202124;
        background: #ffffff;
        font-size: 13px;
        font-weight: normal;
        cursor: pointer;
    }

    .boton-seleccionar:hover {
        background: #f1f5f9;
    }

    .contador-seleccionadas {
        margin-bottom: 14px;
        padding: 10px 13px;
        border: 1px solid #d8e3ef;
        border-radius: 7px;
        color: #202124;
        background: #f8fafc;
        font-size: 13px;
    }

    .comunidades-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 12px;
    }

    .opcion-comunidad {
        position: relative;
        display: block;
        cursor: pointer;
    }

    .opcion-comunidad input[type="checkbox"] {
        position: absolute;
        opacity: 0;
        pointer-events: none;
    }

    .contenido-comunidad {
        min-height: 82px;
        padding: 15px;
        display: flex;
        align-items: center;
        gap: 12px;
        border: 1px solid #d8e3ef;
        border-radius: 9px;
        background: #ffffff;
        box-sizing: border-box;
    }

    .opcion-comunidad:hover .contenido-comunidad {
        background: #f8fafc;
    }

    .opcion-comunidad input:checked + .contenido-comunidad {
        border-color: #1769c2;
        background: #edf5ff;
    }

    .opcion-comunidad input:disabled + .contenido-comunidad {
        cursor: not-allowed;
        opacity: 0.75;
    }

    .marca-seleccion {
        width: 21px;
        height: 21px;
        flex: 0 0 21px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #9eabb9;
        border-radius: 5px;
        color: transparent;
        background: #ffffff;
        font-size: 14px;
    }

    .opcion-comunidad input:checked
    + .contenido-comunidad
    .marca-seleccion {
        border-color: #1769c2;
        color: #ffffff;
        background: #1769c2;
    }

    .informacion-comunidad strong {
        margin-bottom: 4px;
        display: block;
        color: #202124;
        font-size: 14px;
        font-weight: normal;
    }

    .informacion-comunidad span {
        color: #64748b;
        font-size: 12px;
    }

    .acciones-formulario {
        padding: 20px 28px;
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 12px;
        border-top: 1px solid #e5edf5;
        background: #f8fafc;
    }

    .boton-cancelar,
    .boton-guardar {
        min-height: 44px;
        padding: 0 20px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 7px;
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
        background: #f1f5f9;
    }

    .boton-guardar {
        border: 1px solid #1769c2;
        color: #ffffff;
        background: #1769c2;
        cursor: pointer;
    }

    .boton-guardar:hover {
        background: #12569e;
    }

    @media (max-width: 900px) {
        .comunidades-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 700px) {
        .encabezado-formulario,
        .encabezado-comunidades {
            align-items: flex-start;
            flex-direction: column;
        }

        .acciones-superiores,
        .boton-volver,
        .boton-seleccionar {
            width: 100%;
        }

        .campos-grid,
        .comunidades-grid {
            grid-template-columns: 1fr;
        }

        .campo-completo {
            grid-column: auto;
        }

        .formulario-cuerpo {
            padding: 20px;
        }

        .acciones-formulario {
            padding: 18px 20px;
            align-items: stretch;
            flex-direction: column-reverse;
        }

        .boton-cancelar,
        .boton-guardar {
            width: 100%;
        }
    }
</style>

@php
    $idsSeleccionados = collect(
        old('id_comunidades', $comunidadesSeleccionadas)
    )
        ->map(fn ($id) => (int) $id)
        ->all();

    $tieneAsistencias = $reunion->asistencias()->exists();
@endphp

<div class="editar-reunion">
    <div class="encabezado-formulario">
        <div>
            <h2>Editar reunión</h2>

            <p>
                Modifica la información de la reunión registrada.
            </p>
        </div>

        <div class="acciones-superiores">
            <a
                href="{{ route('reuniones.show', $reunion) }}"
                class="boton-volver"
            >
                Volver al detalle
            </a>
        </div>
    </div>

    @if ($errors->any())
        <div class="errores-formulario">
            <p>Revisa los siguientes datos:</p>

            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form
        action="{{ route('reuniones.update', $reunion) }}"
        method="POST"
        class="tarjeta-formulario"
    >
        @csrf
        @method('PUT')

        <div class="titulo-seccion">
            <h3>Datos de la reunión</h3>

            <p>
                Actualiza únicamente la información necesaria.
            </p>
        </div>

        <div class="formulario-cuerpo">
            <div class="campos-grid">
                <div
                    class="campo-formulario campo-completo
                    @error('descripcion') campo-error @enderror"
                >
                    <label for="descripcion">
                        Motivo o descripción *
                    </label>

                    <textarea
                        id="descripcion"
                        name="descripcion"
                        maxlength="20000"
                        required
                    >{{ old('descripcion', $reunion->descripcion) }}</textarea>

                    <p class="texto-ayuda">
                        Puedes escribir el motivo, los temas y los detalles.
                    </p>

                    @error('descripcion')
                        <span class="mensaje-error">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div
                    class="campo-formulario
                    @error('fecha') campo-error @enderror"
                >
                    <label for="fecha">
                        Fecha de la reunión *
                    </label>

                    <input
                        type="date"
                        id="fecha"
                        name="fecha"
                        value="{{
                            old(
                                'fecha',
                                $reunion->fecha->format('Y-m-d')
                            )
                        }}"
                        required
                    >

                    @error('fecha')
                        <span class="mensaje-error">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div
                    class="campo-formulario
                    @error('hora') campo-error @enderror"
                >
                    <label for="hora">
                        Hora de la reunión *
                    </label>

                    <input
                        type="time"
                        id="hora"
                        name="hora"
                        value="{{
                            old(
                                'hora',
                                $reunion->hora
                                    ? substr(
                                        (string) $reunion->hora,
                                        0,
                                        5
                                    )
                                    : ''
                            )
                        }}"
                        required
                    >

                    @error('hora')
                        <span class="mensaje-error">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div
                    class="campo-formulario
                    @error('lugar') campo-error @enderror"
                >
                    <label for="lugar">
                        Lugar de la reunión *
                    </label>

                    <input
                        type="text"
                        id="lugar"
                        name="lugar"
                        value="{{ old('lugar', $reunion->lugar) }}"
                        maxlength="150"
                        required
                    >

                    @error('lugar')
                        <span class="mensaje-error">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div
                    class="campo-formulario
                    @error('estado') campo-error @enderror"
                >
                    <label for="estado">
                        Estado de la reunión *
                    </label>

                    <select id="estado" name="estado" required>
                        <option
                            value="programada"
                            @selected(
                                old('estado', $reunion->estado)
                                === 'programada'
                            )
                        >
                            Programada
                        </option>

                        <option
                            value="realizada"
                            @selected(
                                old('estado', $reunion->estado)
                                === 'realizada'
                            )
                        >
                            Realizada
                        </option>

                        <option
                            value="cancelada"
                            @selected(
                                old('estado', $reunion->estado)
                                === 'cancelada'
                            )
                        >
                            Cancelada
                        </option>
                    </select>

                    @error('estado')
                        <span class="mensaje-error">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
            </div>

            <div class="seccion-comunidades">
                <div class="encabezado-comunidades">
                    <div>
                        <h3>Comunidades convocadas</h3>

                        <p>
                            Selecciona las comunidades participantes.
                        </p>
                    </div>

                    @if (!$tieneAsistencias)
                        <button
                            type="button"
                            class="boton-seleccionar"
                            id="boton-seleccionar-todas"
                        >
                            Seleccionar todas
                        </button>
                    @endif
                </div>

                @if ($tieneAsistencias)
                    <div class="aviso-bloqueado">
                        Las comunidades no pueden modificarse porque
                        esta reunión ya tiene asistencia registrada.
                    </div>

                    @foreach ($idsSeleccionados as $idComunidad)
                        <input
                            type="hidden"
                            name="id_comunidades[]"
                            value="{{ $idComunidad }}"
                        >
                    @endforeach
                @endif

                <div
                    class="contador-seleccionadas"
                    id="contador-seleccionadas"
                >
                    0 comunidades seleccionadas
                </div>

                <div class="comunidades-grid">
                    @foreach ($comunidades as $comunidad)
                        <label class="opcion-comunidad">
                            <input
                                type="checkbox"
                                name="id_comunidades[]"
                                value="{{ $comunidad->id_comunidad }}"
                                class="checkbox-comunidad"
                                @checked(
                                    in_array(
                                        (int) $comunidad->id_comunidad,
                                        $idsSeleccionados,
                                        true
                                    )
                                )
                                @disabled($tieneAsistencias)
                            >

                            <span class="contenido-comunidad">
                                <span class="marca-seleccion">
                                    ✓
                                </span>

                                <span class="informacion-comunidad">
                                    <strong>
                                        {{ $comunidad->nombre }}
                                    </strong>

                                    <span>
                                        {{
                                            $comunidad
                                                ->comunarios_activos_count
                                        }}
                                        comunarios activos
                                    </span>
                                </span>
                            </span>
                        </label>
                    @endforeach
                </div>

                @error('id_comunidades')
                    <span class="mensaje-error">
                        {{ $message }}
                    </span>
                @enderror
            </div>
        </div>

        <div class="acciones-formulario">
            <a
                href="{{ route('reuniones.show', $reunion) }}"
                class="boton-cancelar"
            >
                Cancelar
            </a>

            <button type="submit" class="boton-guardar">
                Guardar cambios
            </button>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const casillas = Array.from(
            document.querySelectorAll('.checkbox-comunidad')
        );

        const editables = casillas.filter(
            casilla => !casilla.disabled
        );

        const botonSeleccionar = document.getElementById(
            'boton-seleccionar-todas'
        );

        const contador = document.getElementById(
            'contador-seleccionadas'
        );

        function actualizarEstado() {
            const seleccionadas = casillas.filter(
                casilla => casilla.checked
            ).length;

            if (contador) {
                contador.textContent =
                    seleccionadas === 1
                        ? '1 comunidad seleccionada'
                        : seleccionadas
                            + ' comunidades seleccionadas';
            }

            if (
                botonSeleccionar &&
                editables.length > 0
            ) {
                botonSeleccionar.textContent =
                    editables.every(casilla => casilla.checked)
                        ? 'Quitar selección'
                        : 'Seleccionar todas';
            }
        }

        editables.forEach(function (casilla) {
            casilla.addEventListener(
                'change',
                actualizarEstado
            );
        });

        if (botonSeleccionar) {
            botonSeleccionar.addEventListener(
                'click',
                function () {
                    const todasSeleccionadas =
                        editables.every(
                            casilla => casilla.checked
                        );

                    editables.forEach(function (casilla) {
                        casilla.checked = !todasSeleccionadas;
                    });

                    actualizarEstado();
                }
            );
        }

        actualizarEstado();
    });
</script>
@endsection