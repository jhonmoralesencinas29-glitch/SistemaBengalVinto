@extends('layouts.app')

@section('titulo', 'Nueva comunidad')
@section('encabezado', 'Nueva comunidad')

@section('contenido')
<style>
    .formulario-contenedor {
        max-width: 760px;
        margin: 0 auto;
    }

    .formulario-encabezado {
        margin-bottom: 22px;
    }

    .formulario-encabezado h2 {
        margin-bottom: 6px;
        color: #123d70;
        font-size: 24px;
    }

    .formulario-encabezado p {
        color: #64748b;
        font-size: 14px;
        line-height: 1.5;
    }

    .formulario-tarjeta {
        padding: 26px;
        border: 1px solid #d7dee8;
        border-radius: 10px;
        background: #ffffff;
    }

    .mensaje-error {
        padding: 14px 16px;
        margin-bottom: 20px;
        border: 1px solid #f3a6a6;
        border-radius: 7px;
        background: #fff1f1;
        color: #991b1b;
        font-size: 14px;
    }

    .mensaje-error ul {
        margin: 8px 0 0 20px;
    }

    .campo {
        margin-bottom: 20px;
    }

    .campo label {
        display: block;
        margin-bottom: 7px;
        color: #123d70;
        font-size: 14px;
        font-weight: 600;
    }

    .campo input,
    .campo textarea {
        width: 100%;
        padding: 11px 13px;
        border: 1px solid #cbd8e6;
        border-radius: 7px;
        color: #1f2937;
        background: #ffffff;
        font-size: 14px;
        outline: none;
    }

    .campo textarea {
        min-height: 110px;
        resize: vertical;
    }

    .campo input:focus,
    .campo textarea:focus {
        border-color: #1669c1;
    }

    .campo-invalido {
        border-color: #dc2626 !important;
    }

    .error-campo {
        display: block;
        margin-top: 6px;
        color: #dc2626;
        font-size: 13px;
    }

    .texto-ayuda {
        display: block;
        margin-top: 6px;
        color: #64748b;
        font-size: 12px;
    }

    .acciones-formulario {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        padding-top: 6px;
    }

    .boton-cancelar,
    .boton-guardar {
        min-width: 120px;
        padding: 11px 18px;
        border-radius: 7px;
        font-size: 14px;
        font-weight: 600;
        text-align: center;
    }

    .boton-cancelar {
        border: 1px solid #cbd8e6;
        color: #475569;
        background: #ffffff;
        text-decoration: none;
    }

    .boton-guardar {
        border: none;
        color: #ffffff;
        background: #1669c1;
        cursor: pointer;
    }

    .boton-guardar:hover {
        background: #1259a6;
    }

    @media (max-width: 600px) {
        .formulario-tarjeta {
            padding: 20px;
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

<div class="formulario-contenedor">
    <div class="formulario-encabezado">
        <h2>Registrar comunidad</h2>
        <p>
            Registre una comunidad perteneciente al Cantón Bengal Vinto.
        </p>
    </div>

    <div class="formulario-tarjeta">
        @if ($errors->any())
            <div class="mensaje-error">
                <strong>Revise la información ingresada.</strong>

                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('comunidades.store') }}" method="POST">
            @csrf

            <div class="campo">
                <label for="nombre">Nombre de la comunidad</label>

                <input
                    type="text"
                    id="nombre"
                    name="nombre"
                    value="{{ old('nombre') }}"
                    maxlength="100"
                    class="@error('nombre') campo-invalido @enderror"
                    placeholder="Ingrese el nombre de la comunidad"
                    required
                    autofocus
                >

                @error('nombre')
                    <span class="error-campo">{{ $message }}</span>
                @enderror
            </div>

            <div class="campo">
                <label for="descripcion">Descripción</label>

                <textarea
                    id="descripcion"
                    name="descripcion"
                    maxlength="500"
                    class="@error('descripcion') campo-invalido @enderror"
                    placeholder="Ingrese una descripción breve"
                >{{ old('descripcion') }}</textarea>

                @error('descripcion')
                    <span class="error-campo">{{ $message }}</span>
                @enderror

                <span class="texto-ayuda">
                    Este campo es opcional.
                </span>
            </div>

            <div class="acciones-formulario">
                <a
                    href="{{ route('comunidades.index') }}"
                    class="boton-cancelar"
                >
                    Cancelar
                </a>

                <button type="submit" class="boton-guardar">
                    Guardar
                </button>
            </div>
        </form>
    </div>
</div>
@endsection