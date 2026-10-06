@extends('layouts.app')

@section('titulo', 'Nuevo aporte')
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

    .mensaje {
        padding: 14px 17px;
        margin-bottom: 20px;
        border-radius: 7px;
        font-size: 14px;
        font-weight: normal;
        line-height: 1.5;
    }

    .mensaje-exito {
        border: 1px solid #b7d1bf;
        color: #245c34;
        background: #f4faf6;
    }

    .mensaje-error {
        border: 1px solid #e5a7a7;
        color: #7f1d1d;
        background: #fff5f5;
    }

    .mensaje-error p {
        margin: 0 0 7px;
    }

    .mensaje-error ul {
        margin: 0;
        padding-left: 20px;
    }

    .tarjeta {
        margin-bottom: 22px;
        overflow: hidden;
        border: 1px solid #d8e0e8;
        border-radius: 10px;
        background: #ffffff;
    }

    .tarjeta-encabezado {
        padding: 18px 24px;
        border-bottom: 1px solid #e1e6ec;
        background: #f8fafc;
    }

    .tarjeta-encabezado h3 {
        margin: 0 0 4px;
        color: #202124;
        font-size: 18px;
        font-weight: normal;
    }

    .tarjeta-encabezado p {
        margin: 0;
        color: #4b5563;
        font-size: 13px;
        font-weight: normal;
        line-height: 1.5;
    }

    .tarjeta-contenido {
        padding: 24px;
    }

    .cuadricula-tipo {
        display: grid;
        grid-template-columns: 1fr 1.4fr auto;
        gap: 15px;
        align-items: end;
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

    .control::placeholder {
        color: #737b87;
        opacity: 1;
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

    .texto-ayuda {
        display: block;
        margin-top: 6px;
        color: #606975;
        font-size: 12px;
        font-weight: normal;
    }

    .boton-tipo {
        min-height: 48px;
        padding: 0 18px;
        border: 1px solid #cbd5e1;
        border-radius: 7px;
        color: #202124;
        background: #ffffff;
        font-family: inherit;
        font-size: 14px;
        font-weight: normal;
        cursor: pointer;
        white-space: nowrap;
    }

    .boton-tipo:hover {
        background: #f3f4f6;
    }

    .tabla-montos-contenedor {
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
        padding: 13px 15px;
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

    .cantidad-comunarios {
        display: inline-flex;
        min-width: 34px;
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
        width: 150px;
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

    .campo-monto:disabled {
        color: #737b87;
        background: #f3f4f6;
        cursor: not-allowed;
    }

    .monto-calculado {
        color: #202124;
        font-weight: normal;
        white-space: nowrap;
    }

    .resumen {
        padding: 18px 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        border-top: 1px solid #dce3ea;
        background: #f8fafc;
    }

    .resumen span {
        color: #202124;
        font-size: 14px;
        font-weight: normal;
    }

    .resumen-valor {
        margin-left: 5px;
        color: #202124;
        font-size: 18px;
        font-weight: normal;
    }

    .aviso-asignacion {
        padding: 14px 16px;
        border: 1px solid #d8e0e8;
        border-radius: 7px;
        color: #202124;
        background: #f8fafc;
        font-size: 13px;
        font-weight: normal;
        line-height: 1.5;
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

    .boton-guardar:disabled {
        border-color: #aab7c5;
        color: #ffffff;
        background: #aab7c5;
        cursor: not-allowed;
    }

    @media (max-width: 850px) {
        .cuadricula-tipo {
            grid-template-columns: 1fr;
        }

        .boton-tipo {
            width: 100%;
        }
    }

    @media (max-width: 700px) {
        .encabezado-formulario {
            align-items: stretch;
            flex-direction: column;
        }

        .cuadricula-campos {
            grid-template-columns: 1fr;
        }

        .tarjeta-contenido {
            padding: 20px 17px;
        }

        .resumen {
            align-items: flex-start;
            flex-direction: column;
        }

        .acciones {
            padding: 18px;
            flex-direction: column-reverse;
        }

        .boton-cancelar,
        .boton-guardar,
        .boton-volver {
            width: 100%;
        }
    }
</style>
@endpush

@section('contenido')
@php
    $totalComunariosActivos = $comunidades->sum(
        'comunarios_activos_count'
    );
@endphp

<div class="pagina-formulario">
    <div class="encabezado-formulario">
        <div>
            <h2>Crear nuevo aporte</h2>

            <p>
                Defina el aporte y el monto individual para cada comunidad.
            </p>
        </div>

        <a
            href="{{ route('aportes.index') }}"
            class="boton-volver"
        >
            Volver
        </a>
    </div>

    @if (session('exito'))
        <div class="mensaje mensaje-exito">
            {{ session('exito') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="mensaje mensaje-error" role="alert">
            <p>Revise los siguientes datos:</p>

            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <section class="tarjeta">
        <div class="tarjeta-encabezado">
            <h3>Registrar tipo de aporte</h3>

            <p>
                Registre una categoría solamente cuando todavía no exista.
            </p>
        </div>

        <div class="tarjeta-contenido">
            <form
                action="{{ route('aportes.tipos.store') }}"
                method="POST"
                class="cuadricula-tipo"
            >
                @csrf

                <div class="grupo-campo">
                    <label for="nombre">
                        Nombre del tipo
                        <span class="obligatorio">*</span>
                    </label>

                    <input
                        type="text"
                        name="nombre"
                        id="nombre"
                        value="{{ old('nombre') }}"
                        maxlength="100"
                        placeholder="Ejemplo: Aniversario"
                        class="control @error('nombre') control-error @enderror"
                        required
                    >

                    @error('nombre')
                        <span class="texto-error">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="grupo-campo">
                    <label for="descripcion">
                        Descripción
                    </label>

                    <input
                        type="text"
                        name="descripcion"
                        id="descripcion"
                        value="{{ old('descripcion') }}"
                        maxlength="200"
                        placeholder="Descripción opcional"
                        class="control @error('descripcion') control-error @enderror"
                    >

                    @error('descripcion')
                        <span class="texto-error">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <button type="submit" class="boton-tipo">
                    Guardar tipo
                </button>
            </form>
        </div>
    </section>

    <form
        action="{{ route('aportes.store') }}"
        method="POST"
        class="tarjeta"
    >
        @csrf

        <div class="tarjeta-encabezado">
            <h3>Información del aporte</h3>

            <p>
                Complete los datos generales del nuevo aporte.
            </p>
        </div>

        <div class="tarjeta-contenido">
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
                                    old('id_tipo_aporte') ==
                                    $tipo->id_tipo_aporte
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

                    @if ($tiposAportes->isEmpty())
                        <span class="texto-ayuda">
                            Primero debe registrar un tipo de aporte.
                        </span>
                    @endif
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
                        value="{{ old('concepto') }}"
                        maxlength="150"
                        placeholder="Ejemplo: Aniversario del Cantón Bengal Vinto"
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
                            now()->format('Y-m-d')
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
                        value="{{ old('fecha_vencimiento') }}"
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

        <div class="tarjeta-encabezado">
            <h3>Montos por comunidad</h3>

            <p>
                Ingrese lo que debe pagar individualmente cada contribuyente
                activo de la comunidad.
            </p>
        </div>

        <div class="tabla-montos-contenedor">
            <table class="tabla-montos">
                <thead>
                    <tr>
                        <th>Comunidad</th>
                        <th>Contribuyentes activos</th>
                        <th>Monto individual</th>
                        <th>Total esperado</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($comunidades as $comunidad)
                        @php
                            $cantidadActivos =
                                $comunidad->comunarios_activos_count ?? 0;
                        @endphp

                        <tr>
                            <td>
                                <span class="nombre-comunidad">
                                    {{ $comunidad->nombre }}
                                </span>
                            </td>

                            <td>
                                <span class="cantidad-comunarios">
                                    {{ $cantidadActivos }}
                                </span>
                            </td>

                            <td>
                                <input
                                    type="number"
                                    name="montos[{{ $comunidad->id_comunidad }}]"
                                    value="{{ old(
                                        'montos.'.$comunidad->id_comunidad
                                    ) }}"
                                    min="0.01"
                                    max="99999999.99"
                                    step="0.01"
                                    placeholder="{{ $cantidadActivos > 0 ? '0.00' : 'Sin contribuyentes' }}"
                                    class="campo-monto monto-comunidad @error(
                                        'montos.'.$comunidad->id_comunidad
                                    ) control-error @enderror"
                                    data-contribuyentes="{{ $cantidadActivos }}"
                                    @disabled($cantidadActivos === 0)
                                    @required($cantidadActivos > 0)
                                >

                                @error('montos.'.$comunidad->id_comunidad)
                                    <span class="texto-error">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </td>

                            <td>
                                <span class="monto-calculado">
                                    Bs
                                    <span class="subtotal-comunidad">
                                        0.00
                                    </span>
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="resumen">
            <span>
                Total de contribuyentes activos:

                <span class="resumen-valor">
                    {{ $totalComunariosActivos }}
                </span>
            </span>

            <span>
                Total esperado:

                <span class="resumen-valor">
                    Bs <span id="totalEsperado">0.00</span>
                </span>
            </span>
        </div>

        <div class="tarjeta-contenido">
            <div class="aviso-asignacion">
                Al guardar, el aporte será asignado automáticamente a todos
                los contribuyentes activos. Cada persona recibirá el monto
                correspondiente a su comunidad.
            </div>
        </div>

        <div class="acciones">
            <a
                href="{{ route('aportes.index') }}"
                class="boton-cancelar"
            >
                Cancelar
            </a>

            <button
                type="submit"
                class="boton-guardar"
                @disabled(
                    $tiposAportes->isEmpty() ||
                    $totalComunariosActivos === 0
                )
            >
                Crear y asignar aporte
            </button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const campos = document.querySelectorAll(
            '.monto-comunidad'
        );

        const totalEsperado = document.getElementById(
            'totalEsperado'
        );

        function actualizarTotales() {
            let total = 0;

            campos.forEach(function (campo) {
                const fila = campo.closest('tr');

                const subtotalElemento = fila.querySelector(
                    '.subtotal-comunidad'
                );

                const monto = parseFloat(campo.value) || 0;

                const contribuyentes = parseInt(
                    campo.dataset.contribuyentes,
                    10
                ) || 0;

                const subtotal = monto * contribuyentes;

                if (subtotalElemento) {
                    subtotalElemento.textContent =
                        subtotal.toFixed(2);
                }

                total += subtotal;
            });

            if (totalEsperado) {
                totalEsperado.textContent = total.toFixed(2);
            }
        }

        campos.forEach(function (campo) {
            campo.addEventListener(
                'input',
                actualizarTotales
            );
        });

        actualizarTotales();
    });
</script>
@endpush