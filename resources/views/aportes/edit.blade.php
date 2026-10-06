@extends('layouts.app')

@section('titulo', 'Editar aporte')
@section('encabezado', 'Aportes')

@push('estilos')
<style>
    .pagina-formulario {
        width: 100%;
        max-width: 1100px;
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
        font-size: 27px;
        font-weight: normal;
    }

    .encabezado-formulario p {
        margin: 0;
        color: #4b5563;
        font-size: 15px;
        font-weight: normal;
        line-height: 1.5;
    }

    .boton-volver {
        min-height: 44px;
        padding: 0 18px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        border: 1px solid #cbd5e1;
        border-radius: 7px;
        color: #202124;
        background: #ffffff;
        font-size: 14px;
        font-weight: normal;
        text-decoration: none;
    }

    .boton-volver:hover {
        background: #f3f4f6;
    }

    .mensaje-error {
        padding: 15px 18px;
        margin-bottom: 20px;
        border: 1px solid #e5a7a7;
        border-radius: 7px;
        color: #7f1d1d;
        background: #fff5f5;
        font-size: 14px;
        font-weight: normal;
    }

    .mensaje-error p {
        margin: 0 0 7px;
    }

    .mensaje-error ul {
        margin: 0;
        padding-left: 20px;
        line-height: 1.6;
    }

    .formulario {
        overflow: hidden;
        border: 1px solid #d8e0e8;
        border-radius: 10px;
        background: #ffffff;
    }

    .formulario-encabezado {
        padding: 20px 24px;
        border-bottom: 1px solid #dce3ea;
        background: #f8fafc;
    }

    .formulario-encabezado h3 {
        margin: 0 0 4px;
        color: #202124;
        font-size: 18px;
        font-weight: normal;
    }

    .formulario-encabezado p {
        margin: 0;
        color: #4b5563;
        font-size: 13px;
        font-weight: normal;
        line-height: 1.5;
    }

    .formulario-contenido {
        padding: 24px;
    }

    .aviso {
        padding: 14px 16px;
        margin-bottom: 22px;
        border: 1px solid #d8e0e8;
        border-radius: 7px;
        color: #202124;
        background: #f8fafc;
        font-size: 13px;
        font-weight: normal;
        line-height: 1.5;
    }

    .cuadricula-campos {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 20px 24px;
    }

    .grupo-campo label {
        display: block;
        margin-bottom: 7px;
        color: #202124;
        font-size: 14px;
        font-weight: normal;
    }

    .obligatorio {
        color: #b42318;
    }

    .control {
        width: 100%;
        min-height: 48px;
        padding: 0 13px;
        border: 1px solid #cbd5e1;
        border-radius: 7px;
        outline: none;
        color: #202124;
        background: #ffffff;
        font-family: inherit;
        font-size: 14px;
        font-weight: normal;
        box-sizing: border-box;
    }

    .control:hover {
        border-color: #9ca3af;
    }

    .control:focus {
        border-color: #1669c1;
        box-shadow: 0 0 0 3px rgba(22, 105, 193, 0.08);
    }

    .control-error {
        border-color: #b42318;
    }

    .control-error:focus {
        border-color: #b42318;
        box-shadow: 0 0 0 3px rgba(180, 35, 24, 0.08);
    }

    .texto-error {
        display: block;
        margin-top: 6px;
        color: #b42318;
        font-size: 12px;
        font-weight: normal;
    }

    .seccion-montos {
        border-top: 1px solid #dce3ea;
    }

    .tabla-responsive {
        width: 100%;
        overflow-x: auto;
    }

    .tabla-montos {
        width: 100%;
        min-width: 690px;
        border-collapse: collapse;
    }

    .tabla-montos th,
    .tabla-montos td {
        padding: 14px 16px;
        border-bottom: 1px solid #e4e9ef;
        text-align: left;
        vertical-align: middle;
    }

    .tabla-montos th {
        color: #202124;
        background: #f8fafc;
        font-size: 13px;
        font-weight: normal;
    }

    .tabla-montos td {
        color: #202124;
        font-size: 14px;
        font-weight: normal;
    }

    .tabla-montos tbody tr:last-child td {
        border-bottom: none;
    }

    .tabla-montos tbody tr:hover {
        background: #fafafa;
    }

    .nombre-comunidad {
        color: #202124;
        font-weight: normal;
    }

    .cantidad {
        display: inline-flex;
        min-width: 35px;
        height: 29px;
        align-items: center;
        justify-content: center;
        border: 1px solid #d7dce2;
        border-radius: 6px;
        color: #202124;
        background: #ffffff;
        font-weight: normal;
    }

    .campo-monto {
        width: 170px;
        height: 42px;
        padding: 0 11px;
        border: 1px solid #cbd5e1;
        border-radius: 7px;
        outline: none;
        color: #202124;
        background: #ffffff;
        font-family: inherit;
        font-size: 14px;
        font-weight: normal;
        box-sizing: border-box;
    }

    .campo-monto:hover {
        border-color: #9ca3af;
    }

    .campo-monto:focus {
        border-color: #1669c1;
        box-shadow: 0 0 0 3px rgba(22, 105, 193, 0.08);
    }

    .resumen-asignaciones {
        padding: 18px 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        border-top: 1px solid #dce3ea;
        background: #f8fafc;
    }

    .resumen-asignaciones h4 {
        margin: 0 0 4px;
        color: #202124;
        font-size: 14px;
        font-weight: normal;
    }

    .resumen-asignaciones p {
        margin: 0;
        color: #4b5563;
        font-size: 13px;
        font-weight: normal;
        line-height: 1.5;
    }

    .total-asignados {
        min-width: 42px;
        height: 38px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #d7dce2;
        border-radius: 7px;
        color: #202124;
        background: #ffffff;
        font-size: 15px;
        font-weight: normal;
    }

    .acciones {
        padding: 20px 24px;
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 11px;
        border-top: 1px solid #dce3ea;
        background: #f8fafc;
    }

    .boton-cancelar,
    .boton-guardar {
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
        box-sizing: border-box;
    }

    .boton-cancelar {
        border: 1px solid #cbd5e1;
        color: #202124;
        background: #ffffff;
    }

    .boton-cancelar:hover {
        background: #f3f4f6;
    }

    .boton-guardar {
        border: 1px solid #1669c1;
        color: #ffffff;
        background: #1669c1;
        cursor: pointer;
    }

    .boton-guardar:hover {
        border-color: #1259a6;
        background: #1259a6;
    }

    @media (max-width: 700px) {
        .encabezado-formulario {
            align-items: stretch;
            flex-direction: column;
        }

        .cuadricula-campos {
            grid-template-columns: 1fr;
        }

        .formulario-contenido {
            padding: 20px 17px;
        }

        .resumen-asignaciones {
            align-items: flex-start;
            flex-direction: column;
        }

        .acciones {
            padding: 18px;
            flex-direction: column-reverse;
        }

        .boton-volver,
        .boton-cancelar,
        .boton-guardar {
            width: 100%;
        }
    }
</style>
@endpush

@section('contenido')
<div class="pagina-formulario">
    <div class="encabezado-formulario">
        <div>
            <h2>Editar aporte</h2>

            <p>
                Modifique la información de
                {{ $aporte->concepto }}.
            </p>
        </div>

        <a
            href="{{ route('aportes.show', $aporte) }}"
            class="boton-volver"
        >
            Volver
        </a>
    </div>

    @if ($errors->any())
        <div class="mensaje-error" role="alert">
            <p>No se pudieron guardar los cambios:</p>

            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form
        action="{{ route('aportes.update', $aporte) }}"
        method="POST"
        class="formulario"
    >
        @csrf
        @method('PUT')

        <div class="formulario-encabezado">
            <h3>Información del aporte</h3>

            <p>
                Código de aporte:
                {{ $aporte->id_aporte }}
            </p>
        </div>

        <div class="formulario-contenido">
            <div class="aviso">
                Los cambios de monto se aplicarán únicamente a las
                asignaciones que todavía estén pendientes. Los pagos
                parciales o completados conservarán sus valores actuales.
            </div>

            <div class="cuadricula-campos">
                <div class="grupo-campo">
                    <label for="id_tipo_aporte">
                        Tipo de aporte
                        <span class="obligatorio">*</span>
                    </label>

                    <select
                        name="id_tipo_aporte"
                        id="id_tipo_aporte"
                        class="control @error('id_tipo_aporte') control-error @enderror"
                        required
                    >
                        <option value="">
                            Seleccione un tipo
                        </option>

                        @foreach ($tiposAportes as $tipo)
                            <option
                                value="{{ $tipo->id_tipo_aporte }}"
                                @selected(
                                    old(
                                        'id_tipo_aporte',
                                        $aporte->id_tipo_aporte
                                    ) == $tipo->id_tipo_aporte
                                )
                            >
                                {{ $tipo->nombre }}
                            </option>
                        @endforeach
                    </select>

                    @error('id_tipo_aporte')
                        <span class="texto-error">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="grupo-campo">
                    <label for="concepto">
                        Concepto
                        <span class="obligatorio">*</span>
                    </label>

                    <input
                        type="text"
                        name="concepto"
                        id="concepto"
                        value="{{ old(
                            'concepto',
                            $aporte->concepto
                        ) }}"
                        maxlength="150"
                        placeholder="Ingrese el concepto del aporte"
                        class="control @error('concepto') control-error @enderror"
                        required
                    >

                    @error('concepto')
                        <span class="texto-error">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="grupo-campo">
                    <label for="fecha_creacion">
                        Fecha de creación
                        <span class="obligatorio">*</span>
                    </label>

                    <input
                        type="date"
                        name="fecha_creacion"
                        id="fecha_creacion"
                        value="{{ old(
                            'fecha_creacion',
                            $aporte->fecha_creacion
                                ? $aporte->fecha_creacion->format('Y-m-d')
                                : ''
                        ) }}"
                        class="control @error('fecha_creacion') control-error @enderror"
                        required
                    >

                    @error('fecha_creacion')
                        <span class="texto-error">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="grupo-campo">
                    <label for="fecha_vencimiento">
                        Fecha de vencimiento
                        <span class="obligatorio">*</span>
                    </label>

                    <input
                        type="date"
                        name="fecha_vencimiento"
                        id="fecha_vencimiento"
                        value="{{ old(
                            'fecha_vencimiento',
                            $aporte->fecha_vencimiento
                                ? $aporte->fecha_vencimiento->format('Y-m-d')
                                : ''
                        ) }}"
                        class="control @error('fecha_vencimiento') control-error @enderror"
                        required
                    >

                    @error('fecha_vencimiento')
                        <span class="texto-error">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
            </div>
        </div>

        <section class="seccion-montos">
            <div class="formulario-encabezado">
                <h3>Montos por comunidad</h3>

                <p>
                    Valor individual que corresponde a cada contribuyente.
                </p>
            </div>

            <div class="tabla-responsive">
                <table class="tabla-montos">
                    <thead>
                        <tr>
                            <th>Comunidad</th>
                            <th>Contribuyentes activos actuales</th>
                            <th>Monto individual</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($comunidades as $comunidad)
                            @php
                                $montoGuardado =
                                    $montosComunidades->get(
                                        $comunidad->id_comunidad,
                                        $aporte->monto
                                    );
                            @endphp

                            <tr>
                                <td>
                                    <span class="nombre-comunidad">
                                        {{ $comunidad->nombre }}
                                    </span>
                                </td>

                                <td>
                                    <span class="cantidad">
                                        {{ $comunidad->comunarios_activos_count ?? 0 }}
                                    </span>
                                </td>

                                <td>
                                    <input
                                        type="number"
                                        name="montos[{{ $comunidad->id_comunidad }}]"
                                        value="{{ old(
                                            'montos.'.$comunidad->id_comunidad,
                                            $montoGuardado
                                        ) }}"
                                        min="0.01"
                                        max="99999999.99"
                                        step="0.01"
                                        class="campo-monto @error(
                                            'montos.'.$comunidad->id_comunidad
                                        ) control-error @enderror"
                                        required
                                    >

                                    @error('montos.'.$comunidad->id_comunidad)
                                        <span class="texto-error">
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

        <div class="resumen-asignaciones">
            <div>
                <h4>Comunarios asignados</h4>

                <p>
                    Las asignaciones existentes se conservarán después
                    de guardar los cambios.
                </p>
            </div>

            <div class="total-asignados">
                {{ $aporte->aportesComunarios()->count() }}
            </div>
        </div>

        <div class="acciones">
            <a
                href="{{ route('aportes.show', $aporte) }}"
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
@endsection