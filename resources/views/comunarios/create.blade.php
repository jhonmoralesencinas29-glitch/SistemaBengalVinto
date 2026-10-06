@extends('layouts.app')

@section('titulo', 'Nuevo comunario')
@section('encabezado', 'Comunarios')

@push('estilos')
<style>
    .pagina-formulario {
        width: 100%;
        max-width: 1050px;
        margin: 0 auto;
        color: #202124;
    }

    .encabezado-formulario {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 24px;
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
        border-radius: 8px;
        color: #202124;
        background: #ffffff;
        font-size: 14px;
        font-weight: normal;
        text-decoration: none;
    }

    .boton-volver:hover {
        background: #f3f4f6;
    }

    .mensaje-errores {
        padding: 15px 18px;
        margin-bottom: 20px;
        border: 1px solid #e5a7a7;
        border-radius: 8px;
        color: #7f1d1d;
        background: #fff5f5;
        font-size: 14px;
        font-weight: normal;
    }

    .mensaje-errores p {
        margin: 0 0 7px;
        font-weight: normal;
    }

    .mensaje-errores ul {
        margin: 0;
        padding-left: 20px;
        line-height: 1.6;
    }

    .formulario-tarjeta {
        overflow: hidden;
        border: 1px solid #d8e0e8;
        border-radius: 10px;
        background: #ffffff;
    }

    .seccion-formulario {
        padding: 25px 28px;
        border-bottom: 1px solid #e4e9ef;
    }

    .titulo-seccion {
        margin-bottom: 21px;
    }

    .titulo-seccion h3 {
        margin: 0 0 4px;
        color: #202124;
        font-size: 19px;
        font-weight: normal;
    }

    .titulo-seccion p {
        margin: 0;
        color: #4b5563;
        font-size: 13px;
        font-weight: normal;
        line-height: 1.5;
    }

    .cuadricula-campos {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 20px 24px;
    }

    .campo-completo {
        grid-column: 1 / -1;
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

    .control-formulario {
        width: 100%;
        min-height: 48px;
        padding: 11px 13px;
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

    .control-formulario:hover {
        border-color: #9ca3af;
    }

    .control-formulario:focus {
        border-color: #1669c1;
        box-shadow: 0 0 0 3px rgba(22, 105, 193, 0.1);
    }

    .control-formulario::placeholder {
        color: #737b87;
        opacity: 1;
    }

    select.control-formulario {
        cursor: pointer;
    }

    textarea.control-formulario {
        min-height: 90px;
        resize: vertical;
    }

    .campo-error {
        border-color: #b42318;
    }

    .campo-error:focus {
        border-color: #b42318;
        box-shadow: 0 0 0 3px rgba(180, 35, 24, 0.08);
    }

    .texto-error {
        display: block;
        margin-top: 6px;
        color: #b42318;
        font-size: 13px;
        font-weight: normal;
    }

    .texto-ayuda {
        display: block;
        margin-top: 6px;
        color: #606975;
        font-size: 12px;
        font-weight: normal;
        line-height: 1.4;
    }

    .contenedor-contrasena {
        position: relative;
    }

    .control-contrasena {
        padding-right: 52px;
    }

    .boton-contrasena {
        position: absolute;
        top: 50%;
        right: 8px;
        width: 36px;
        height: 36px;
        padding: 0;
        transform: translateY(-50%);
        display: flex;
        align-items: center;
        justify-content: center;
        border: none;
        border-radius: 6px;
        color: #202124;
        background: transparent;
        cursor: pointer;
    }

    .boton-contrasena:hover {
        background: #f1f3f5;
    }

    .boton-contrasena:focus {
        outline: 2px solid #1669c1;
        outline-offset: 1px;
    }

    .boton-contrasena svg {
        width: 20px;
        height: 20px;
        fill: none;
        stroke: currentColor;
        stroke-width: 1.8;
        stroke-linecap: round;
        stroke-linejoin: round;
    }

    .acciones-formulario {
        padding: 20px 28px;
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 11px;
        background: #f8fafc;
    }

    .boton-cancelar,
    .boton-guardar {
        min-height: 46px;
        padding: 0 21px;
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

        .boton-volver {
            width: 100%;
        }

        .cuadricula-campos {
            grid-template-columns: 1fr;
        }

        .campo-completo {
            grid-column: auto;
        }

        .seccion-formulario {
            padding: 22px 18px;
        }

        .acciones-formulario {
            padding: 18px;
            flex-direction: column-reverse;
        }

        .boton-cancelar,
        .boton-guardar {
            width: 100%;
        }
    }
</style>
@endpush

@section('contenido')
@php
    $idComunidadRegreso = old(
        'id_comunidad',
        request('id_comunidad')
    );

    $rutaRegreso = $idComunidadRegreso
        ? route('comunarios.index', [
            'id_comunidad' => $idComunidadRegreso
        ])
        : route('comunarios.index');
@endphp

<div class="pagina-formulario">
    <div class="encabezado-formulario">
        <div>
            <h2>Registrar nuevo comunario</h2>

            <p>
                Complete la información personal y los datos de acceso.
            </p>
        </div>

        <a href="{{ $rutaRegreso }}" class="boton-volver">
            Volver
        </a>
    </div>

    @if ($errors->any())
        <div class="mensaje-errores" role="alert">
            <p>No se pudo registrar el comunario:</p>

            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form
        action="{{ route('comunarios.store') }}"
        method="POST"
        class="formulario-tarjeta"
    >
        @csrf

        <section class="seccion-formulario">
            <div class="titulo-seccion">
                <h3>Datos personales</h3>

                <p>
                    Información del contribuyente y la comunidad a la que pertenece.
                </p>
            </div>

            <div class="cuadricula-campos">
                <div class="grupo-campo campo-completo">
                    <label for="id_comunidad">
                        Comunidad
                        <span class="obligatorio">*</span>
                    </label>

                    <select
                        name="id_comunidad"
                        id="id_comunidad"
                        class="control-formulario @error('id_comunidad') campo-error @enderror"
                        required
                        autofocus
                    >
                        <option value="">
                            Seleccione una comunidad
                        </option>

                        @foreach ($comunidades as $comunidad)
                            <option
                                value="{{ $comunidad->id_comunidad }}"
                                @selected(
                                    old(
                                        'id_comunidad',
                                        request('id_comunidad')
                                    ) == $comunidad->id_comunidad
                                )
                            >
                                {{ $comunidad->nombre }}
                            </option>
                        @endforeach
                    </select>

                    @error('id_comunidad')
                        <span class="texto-error">
                            {{ $message }}
                        </span>
                    @enderror

                    <span class="texto-ayuda">
                        Seleccione la comunidad a la que pertenece el comunario.
                    </span>
                </div>

                <div class="grupo-campo">
                    <label for="ci">
                        Cédula de identidad
                        <span class="obligatorio">*</span>
                    </label>

                    <input
                        type="text"
                        name="ci"
                        id="ci"
                        value="{{ old('ci') }}"
                        maxlength="20"
                        placeholder="Ejemplo: 12345678"
                        class="control-formulario @error('ci') campo-error @enderror"
                        required
                    >

                    @error('ci')
                        <span class="texto-error">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="grupo-campo">
                    <label for="telefono">
                        Teléfono
                    </label>

                    <input
                        type="tel"
                        name="telefono"
                        id="telefono"
                        value="{{ old('telefono') }}"
                        maxlength="20"
                        placeholder="Ejemplo: 71234567"
                        class="control-formulario @error('telefono') campo-error @enderror"
                    >

                    @error('telefono')
                        <span class="texto-error">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="grupo-campo">
                    <label for="nombres">
                        Nombres
                        <span class="obligatorio">*</span>
                    </label>

                    <input
                        type="text"
                        name="nombres"
                        id="nombres"
                        value="{{ old('nombres') }}"
                        maxlength="100"
                        placeholder="Ingrese los nombres"
                        class="control-formulario @error('nombres') campo-error @enderror"
                        required
                    >

                    @error('nombres')
                        <span class="texto-error">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="grupo-campo">
                    <label for="apellidos">
                        Apellidos
                        <span class="obligatorio">*</span>
                    </label>

                    <input
                        type="text"
                        name="apellidos"
                        id="apellidos"
                        value="{{ old('apellidos') }}"
                        maxlength="100"
                        placeholder="Ingrese los apellidos"
                        class="control-formulario @error('apellidos') campo-error @enderror"
                        required
                    >

                    @error('apellidos')
                        <span class="texto-error">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="grupo-campo campo-completo">
                    <label for="direccion">
                        Dirección
                    </label>

                    <textarea
                        name="direccion"
                        id="direccion"
                        maxlength="150"
                        placeholder="Ingrese la dirección o una referencia del domicilio"
                        class="control-formulario @error('direccion') campo-error @enderror"
                    >{{ old('direccion') }}</textarea>

                    @error('direccion')
                        <span class="texto-error">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
            </div>
        </section>

        <section class="seccion-formulario">
            <div class="titulo-seccion">
                <h3>Datos de acceso</h3>

                <p>
                    Credenciales que el comunario utilizará para ingresar al sistema.
                </p>
            </div>

            <div class="cuadricula-campos">
                <div class="grupo-campo campo-completo">
                    <label for="usuario">
                        Nombre de usuario
                        <span class="obligatorio">*</span>
                    </label>

                    <input
                        type="text"
                        name="usuario"
                        id="usuario"
                        value="{{ old('usuario') }}"
                        maxlength="50"
                        placeholder="Cree un nombre de usuario"
                        autocomplete="username"
                        class="control-formulario @error('usuario') campo-error @enderror"
                        required
                    >

                    @error('usuario')
                        <span class="texto-error">
                            {{ $message }}
                        </span>
                    @enderror

                    <span class="texto-ayuda">
                        Este nombre será utilizado para iniciar sesión.
                    </span>
                </div>

                <div class="grupo-campo">
                    <label for="contrasena">
                        Contraseña
                        <span class="obligatorio">*</span>
                    </label>

                    <div class="contenedor-contrasena">
                        <input
                            type="password"
                            name="contrasena"
                            id="contrasena"
                            minlength="8"
                            placeholder="Mínimo 8 caracteres"
                            autocomplete="new-password"
                            class="control-formulario control-contrasena @error('contrasena') campo-error @enderror"
                            required
                        >

                        <button
                            type="button"
                            class="boton-contrasena"
                            data-campo="contrasena"
                            aria-label="Mostrar contraseña"
                        >
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M2 12s3.5-6 10-6 10 6 10 6-3.5 6-10 6S2 12 2 12Z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                        </button>
                    </div>

                    @error('contrasena')
                        <span class="texto-error">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="grupo-campo">
                    <label for="contrasena_confirmation">
                        Confirmar contraseña
                        <span class="obligatorio">*</span>
                    </label>

                    <div class="contenedor-contrasena">
                        <input
                            type="password"
                            name="contrasena_confirmation"
                            id="contrasena_confirmation"
                            minlength="8"
                            placeholder="Repita la contraseña"
                            autocomplete="new-password"
                            class="control-formulario control-contrasena"
                            required
                        >

                        <button
                            type="button"
                            class="boton-contrasena"
                            data-campo="contrasena_confirmation"
                            aria-label="Mostrar contraseña"
                        >
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M2 12s3.5-6 10-6 10 6 10 6-3.5 6-10 6S2 12 2 12Z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <div class="acciones-formulario">
            <a href="{{ $rutaRegreso }}" class="boton-cancelar">
                Cancelar
            </a>

            <button type="submit" class="boton-guardar">
                Registrar comunario
            </button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const botones = document.querySelectorAll('.boton-contrasena');

        botones.forEach(function (boton) {
            boton.addEventListener('click', function () {
                const campo = document.getElementById(
                    boton.dataset.campo
                );

                if (!campo) {
                    return;
                }

                const mostrar = campo.type === 'password';

                campo.type = mostrar ? 'text' : 'password';

                boton.setAttribute(
                    'aria-label',
                    mostrar
                        ? 'Ocultar contraseña'
                        : 'Mostrar contraseña'
                );
            });
        });
    });
</script>
@endpush