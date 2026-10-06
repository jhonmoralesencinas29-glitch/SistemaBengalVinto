@extends('layouts.app')

@section('titulo', 'Detalle de la reunión')
@section('encabezado', 'Detalle de la reunión')

@section('contenido')
<style>
    .detalle-reunion {
        width: 100%;
        max-width: 1200px;
        margin: 0 auto;
        color: #202124;
    }

    .encabezado-detalle {
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
    }

    .encabezado-detalle h2 {
        margin: 0 0 6px;
        color: #202124;
        font-size: 28px;
        font-weight: normal;
    }

    .encabezado-detalle p {
        margin: 0;
        color: #4b5563;
        font-size: 14px;
    }

    .acciones-superiores {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .boton-accion {
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

    .boton-accion:hover {
        background: #f1f5f9;
    }

    .boton-principal {
        border-color: #1769c2;
        color: #ffffff;
        background: #1769c2;
    }

    .boton-principal:hover {
        color: #ffffff;
        background: #12569e;
    }

    .mensaje-exito {
        margin-bottom: 20px;
        padding: 14px 16px;
        border: 1px solid #b7dfc5;
        border-radius: 8px;
        color: #202124;
        background: #f0fff4;
        font-size: 14px;
    }

    .tarjeta {
        margin-bottom: 24px;
        overflow: hidden;
        border: 1px solid #d8e3ef;
        border-radius: 14px;
        background: #ffffff;
    }

    .tarjeta-encabezado {
        padding: 22px 26px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        border-bottom: 1px solid #e5edf5;
        background: #f8fafc;
    }

    .tarjeta-encabezado h3 {
        margin: 0 0 5px;
        color: #202124;
        font-size: 20px;
        font-weight: normal;
    }

    .tarjeta-encabezado p {
        margin: 0;
        color: #4b5563;
        font-size: 13px;
    }

    .estado-reunion {
        min-width: 100px;
        padding: 7px 12px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #d8e3ef;
        border-radius: 18px;
        color: #202124;
        background: #f7f9fc;
        font-size: 13px;
        font-weight: normal;
        text-transform: capitalize;
    }

    .estado-programada {
        background: #edf5ff;
    }

    .estado-realizada {
        background: #f0fff4;
    }

    .estado-cancelada {
        background: #fff1f1;
    }

    .tarjeta-cuerpo {
        padding: 26px;
    }

    .datos-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 16px;
    }

    .dato {
        min-width: 0;
        padding: 16px;
        border: 1px solid #e1e8f0;
        border-radius: 9px;
        background: #ffffff;
    }

    .dato span {
        margin-bottom: 7px;
        display: block;
        color: #64748b;
        font-size: 12px;
        text-transform: uppercase;
    }

    .dato strong {
        display: block;
        color: #202124;
        font-size: 15px;
        font-weight: normal;
        overflow-wrap: anywhere;
    }

    .descripcion-bloque {
        margin-top: 18px;
        padding: 18px;
        border: 1px solid #e1e8f0;
        border-radius: 9px;
        background: #ffffff;
    }

    .descripcion-bloque > span {
        margin-bottom: 9px;
        display: block;
        color: #64748b;
        font-size: 12px;
        text-transform: uppercase;
    }

    .texto-descripcion {
        margin: 0;
        color: #202124;
        font-size: 14px;
        line-height: 1.7;
        white-space: pre-wrap;
        overflow-wrap: anywhere;
    }

    .comunidades-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 12px;
    }

    .comunidad-item {
        padding: 15px;
        border: 1px solid #d8e3ef;
        border-radius: 8px;
        color: #202124;
        background: #f8fafc;
        font-size: 14px;
    }

    .sin-informacion {
        padding: 25px;
        border: 1px dashed #cbd8e6;
        border-radius: 8px;
        color: #4b5563;
        background: #f8fafc;
        font-size: 14px;
        text-align: center;
    }

    .resumen-asistencia {
        display: grid;
        grid-template-columns: repeat(5, minmax(0, 1fr));
        overflow: hidden;
        border: 1px solid #d8e3ef;
        border-radius: 10px;
    }

    .resumen-item {
        min-height: 95px;
        padding: 18px;
        border-right: 1px solid #d8e3ef;
    }

    .resumen-item:last-child {
        border-right: none;
    }

    .resumen-item span {
        margin-bottom: 10px;
        display: block;
        color: #4b5563;
        font-size: 13px;
    }

    .resumen-item strong {
        color: #202124;
        font-size: 24px;
        font-weight: normal;
    }

    .estado-formulario {
        margin-top: 20px;
        padding-top: 20px;
        display: flex;
        align-items: end;
        gap: 12px;
        border-top: 1px solid #e5edf5;
    }

    .campo-estado {
        width: 100%;
        max-width: 300px;
    }

    .campo-estado label {
        margin-bottom: 7px;
        display: block;
        color: #202124;
        font-size: 13px;
    }

    .campo-estado select {
        width: 100%;
        min-height: 43px;
        padding: 9px 12px;
        border: 1px solid #cbd8e6;
        border-radius: 7px;
        color: #202124;
        background: #ffffff;
        font-size: 14px;
    }

    .boton-actualizar {
        min-height: 43px;
        padding: 0 17px;
        border: 1px solid #1769c2;
        border-radius: 7px;
        color: #ffffff;
        background: #1769c2;
        font-size: 14px;
        font-weight: normal;
        cursor: pointer;
    }

    .boton-actualizar:hover {
        background: #12569e;
    }

    .tabla-responsive {
        width: 100%;
        overflow-x: auto;
    }

    .tabla-asistencia {
        width: 100%;
        min-width: 750px;
        border-collapse: collapse;
    }

    .tabla-asistencia th {
        padding: 12px 14px;
        border-bottom: 1px solid #dfe7f0;
        color: #202124;
        background: #f7f9fc;
        font-size: 12px;
        font-weight: normal;
        text-align: left;
    }

    .tabla-asistencia td {
        padding: 14px;
        border-bottom: 1px solid #edf1f5;
        color: #202124;
        font-size: 13px;
        vertical-align: middle;
    }

    .tabla-asistencia tbody tr:last-child td {
        border-bottom: none;
    }

    .asistencia-estado {
        padding: 5px 9px;
        display: inline-flex;
        border: 1px solid #d8e3ef;
        border-radius: 14px;
        background: #f8fafc;
        font-size: 12px;
        text-transform: capitalize;
    }

    @media (max-width: 950px) {
        .datos-grid,
        .comunidades-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .resumen-asistencia {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .resumen-item {
            border-bottom: 1px solid #d8e3ef;
        }
    }

    @media (max-width: 700px) {
        .encabezado-detalle,
        .tarjeta-encabezado,
        .estado-formulario {
            align-items: flex-start;
            flex-direction: column;
        }

        .acciones-superiores {
            width: 100%;
            flex-direction: column;
        }

        .boton-accion {
            width: 100%;
        }

        .datos-grid,
        .comunidades-grid,
        .resumen-asistencia {
            grid-template-columns: 1fr;
        }

        .resumen-item {
            border-right: none;
            border-bottom: 1px solid #d8e3ef;
        }

        .resumen-item:last-child {
            border-bottom: none;
        }

        .campo-estado,
        .boton-actualizar {
            width: 100%;
            max-width: none;
        }

        .tarjeta-cuerpo {
            padding: 20px;
        }
    }
</style>

<div class="detalle-reunion">
    <div class="encabezado-detalle">
        <div>
            <h2>Detalle de la reunión</h2>

            <p>
                Consulta la información y el control de asistencia.
            </p>
        </div>

        <div class="acciones-superiores">
            <a
                href="{{ route('reuniones.index') }}"
                class="boton-accion"
            >
                Volver
            </a>

            <a
                href="{{ route('reuniones.edit', $reunion) }}"
                class="boton-accion"
            >
                Editar
            </a>

            @if ($reunion->estado !== 'cancelada')
                <a
                    href="{{ route('reuniones.asistencia', $reunion) }}"
                    class="boton-accion boton-principal"
                >
                    Registrar asistencia
                </a>
            @endif
        </div>
    </div>

    @if (session('exito'))
        <div class="mensaje-exito">
            {{ session('exito') }}
        </div>
    @endif

    <div class="tarjeta">
        <div class="tarjeta-encabezado">
            <div>
                <h3>Información de la reunión</h3>

                <p>
                    Código de reunión:
                    {{ $reunion->id_reunion }}
                </p>
            </div>

            <span
                class="estado-reunion estado-{{ $reunion->estado }}"
            >
                {{ $reunion->estado }}
            </span>
        </div>

        <div class="tarjeta-cuerpo">
            <div class="datos-grid">
                <div class="dato">
                    <span>Fecha</span>

                    <strong>
                        {{ $reunion->fecha->format('d/m/Y') }}
                    </strong>
                </div>

                <div class="dato">
                    <span>Hora</span>

                    <strong>
                        {{ $reunion->hora
                            ? substr((string) $reunion->hora, 0, 5)
                            : 'Sin hora registrada' }}
                    </strong>
                </div>

                <div class="dato">
                    <span>Lugar</span>

                    <strong>
                        {{ $reunion->lugar }}
                    </strong>
                </div>
            </div>

            <div class="descripcion-bloque">
                <span>Motivo o descripción</span>

                <p class="texto-descripcion">
                    {{ $reunion->descripcion }}
                </p>
            </div>

            <form
                action="{{ route('reuniones.estado', $reunion) }}"
                method="POST"
                class="estado-formulario"
            >
                @csrf
                @method('PATCH')

                <div class="campo-estado">
                    <label for="estado">
                        Estado de la reunión
                    </label>

                    <select id="estado" name="estado">
                        <option
                            value="programada"
                            @selected($reunion->estado === 'programada')
                        >
                            Programada
                        </option>

                        <option
                            value="realizada"
                            @selected($reunion->estado === 'realizada')
                        >
                            Realizada
                        </option>

                        <option
                            value="cancelada"
                            @selected($reunion->estado === 'cancelada')
                        >
                            Cancelada
                        </option>
                    </select>
                </div>

                <button
                    type="submit"
                    class="boton-actualizar"
                >
                    Actualizar estado
                </button>
            </form>
        </div>
    </div>

    <div class="tarjeta">
        <div class="tarjeta-encabezado">
            <div>
                <h3>Comunidades convocadas</h3>

                <p>
                    Comunidades seleccionadas para participar.
                </p>
            </div>
        </div>

        <div class="tarjeta-cuerpo">
            <div class="comunidades-grid">
                @forelse ($reunion->comunidades as $comunidad)
                    <div class="comunidad-item">
                        {{ $comunidad->nombre }}
                    </div>
                @empty
                    <div class="sin-informacion">
                        No existen comunidades convocadas.
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <div class="tarjeta">
        <div class="tarjeta-encabezado">
            <div>
                <h3>Resumen de asistencia</h3>

                <p>
                    Total de comunarios y asistencia registrada.
                </p>
            </div>

            @if ($reunion->estado !== 'cancelada')
                <a
                    href="{{ route('reuniones.asistencia', $reunion) }}"
                    class="boton-accion boton-principal"
                >
                    Registrar asistencia
                </a>
            @endif
        </div>

        <div class="tarjeta-cuerpo">
            <div class="resumen-asistencia">
                <div class="resumen-item">
                    <span>Convocados</span>
                    <strong>{{ $totalConvocados }}</strong>
                </div>

                <div class="resumen-item">
                    <span>Presentes</span>
                    <strong>
                        {{ $resumenAsistencia['presentes'] }}
                    </strong>
                </div>

                <div class="resumen-item">
                    <span>Retrasos</span>
                    <strong>
                        {{ $resumenAsistencia['retrasos'] }}
                    </strong>
                </div>

                <div class="resumen-item">
                    <span>Faltas</span>
                    <strong>
                        {{ $resumenAsistencia['faltas'] }}
                    </strong>
                </div>

                <div class="resumen-item">
                    <span>Licencias</span>
                    <strong>
                        {{ $resumenAsistencia['licencias'] }}
                    </strong>
                </div>
            </div>
        </div>
    </div>

    <div class="tarjeta">
        <div class="tarjeta-encabezado">
            <div>
                <h3>Lista de asistencia</h3>

                <p>
                    Registros guardados para esta reunión.
                </p>
            </div>
        </div>

        @if ($reunion->asistencias->isNotEmpty())
            <div class="tabla-responsive">
                <table class="tabla-asistencia">
                    <thead>
                        <tr>
                            <th>Comunario</th>
                            <th>CI</th>
                            <th>Comunidad</th>
                            <th>Asistencia</th>
                            <th>Observación</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($reunion->asistencias as $asistencia)
                            <tr>
                                <td>
                                    {{ $asistencia->comunario->nombres }}
                                    {{ $asistencia->comunario->apellidos }}
                                </td>

                                <td>
                                    {{ $asistencia->comunario->ci }}
                                </td>

                                <td>
                                    {{
                                        $asistencia->comunario
                                            ->comunidad
                                            ->nombre
                                        ?? 'Sin comunidad'
                                    }}
                                </td>

                                <td>
                                    <span class="asistencia-estado">
                                        {{
                                            $asistencia
                                                ->estado_asistencia
                                        }}
                                    </span>
                                </td>

                                <td>
                                    {{
                                        $asistencia->observacion
                                        ?: 'Sin observación'
                                    }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="tarjeta-cuerpo">
                <div class="sin-informacion">
                    La asistencia todavía no fue registrada.
                </div>
            </div>
        @endif
    </div>
</div>
@endsection