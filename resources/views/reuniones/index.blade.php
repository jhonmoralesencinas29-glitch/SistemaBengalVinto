@extends('layouts.app')

@section('titulo', 'Reuniones')
@section('encabezado', 'Reuniones')

@section('contenido')
<style>
    .reuniones-pagina {
        color: #202124;
    }

    .encabezado-reuniones {
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
                 rgba(0, 0, 0, 0.45),
                 rgba(0, 0, 0, 0.10)
            ),
            url('{{ asset('images/plaza.png') }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        overflow: hidden;

    }

    .encabezado-reuniones h2 {
        margin: 0 0 8px;
        color: #ffffff;
        font-size: 30px;
        font-weight: 600;
    }

    .encabezado-reuniones p {
        margin: 0;
        color: #ffffff;
        font-size: 16px;
        line-height: 1.5;
    }

    .boton-nueva-reunion {
        min-height: 46px;
        padding: 0 20px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #ffffff;
        border-radius: 8px;
        color: #202124;
        background: #ffffff;
        font-size: 14px;
        font-weight: normal;
        text-decoration: none;
        white-space: nowrap;
    }

    .boton-nueva-reunion:hover {
        background: #f1f5f9;
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

    .resumen-reuniones {
        margin-bottom: 24px;
        padding: 26px 34px 34px;
        border: 1px solid #d8e3ef;
        border-radius: 14px;
        background: #ffffff;
    }

    .resumen-reuniones h3 {
        margin: 0 0 6px;
        color: #202124;
        font-size: 21px;
        font-weight: normal;
    }

    .resumen-reuniones > p {
        margin: 0 0 24px;
        color: #5f6368;
        font-size: 14px;
    }

    .resumen-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        overflow: hidden;
        border: 1px solid #d8e3ef;
        border-radius: 12px;
    }

    .resumen-item {
        min-height: 105px;
        padding: 22px 25px;
        border-right: 1px solid #d8e3ef;
        background: #ffffff;
    }

    .resumen-item:last-child {
        border-right: none;
    }

    .resumen-item span {
        display: block;
        margin-bottom: 12px;
        color: #202124;
        font-size: 14px;
    }

    .resumen-item strong {
        display: block;
        color: #202124;
        font-size: 26px;
        font-weight: normal;
    }

    .contenedor-reuniones {
        overflow: hidden;
        border: 1px solid #d8e3ef;
        border-radius: 14px;
        background: #ffffff;
    }

    .titulo-listado {
        padding: 24px 28px 18px;
    }

    .titulo-listado h3 {
        margin: 0 0 6px;
        color: #202124;
        font-size: 21px;
        font-weight: normal;
    }

    .titulo-listado p {
        margin: 0;
        color: #5f6368;
        font-size: 14px;
    }

    .barra-filtros {
        padding: 18px 28px;
        display: grid;
        grid-template-columns:
            minmax(260px, 1fr)
            230px
            auto
            auto;
        gap: 12px;
        align-items: end;
        border-top: 1px solid #edf1f5;
        border-bottom: 1px solid #e5edf5;
    }

    .campo-filtro label {
        margin-bottom: 7px;
        display: block;
        color: #202124;
        font-size: 13px;
        font-weight: normal;
    }

    .campo-filtro input,
    .campo-filtro select {
        width: 100%;
        min-height: 44px;
        padding: 9px 12px;
        border: 1px solid #cbd8e6;
        border-radius: 7px;
        color: #202124;
        background: #ffffff;
        font-size: 14px;
        outline: none;
    }

    .campo-filtro input:focus,
    .campo-filtro select:focus {
        border-color: #1769c2;
    }

    .boton-buscar,
    .boton-limpiar {
        min-height: 44px;
        padding: 0 18px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 7px;
        font-size: 14px;
        font-weight: normal;
        text-decoration: none;
        cursor: pointer;
    }

    .boton-buscar {
        border: 1px solid #1769c2;
        color: #ffffff;
        background: #1769c2;
    }

    .boton-buscar:hover {
        background: #12569e;
    }

    .boton-limpiar {
        border: 1px solid #cbd8e6;
        color: #202124;
        background: #ffffff;
    }

    .boton-limpiar:hover {
        background: #f1f5f9;
    }

    .lista-reuniones {
        width: 100%;
    }

    .reunion-item {
        padding: 24px 28px;
        border-bottom: 1px solid #e5edf5;
        background: #ffffff;
    }

    .reunion-item:last-child {
        border-bottom: none;
    }

    .reunion-item:hover {
        background: #fafcff;
    }

    .reunion-principal {
        display: grid;
        grid-template-columns: 125px minmax(0, 1fr) 130px;
        gap: 24px;
        align-items: start;
    }

    .reunion-fecha {
        padding-right: 20px;
        border-right: 1px solid #e5edf5;
    }

    .reunion-fecha span {
        display: block;
    }

    .fecha-texto {
        margin-bottom: 6px;
        color: #202124;
        font-size: 15px;
    }

    .hora-texto {
        color: #5f6368;
        font-size: 13px;
    }

    .reunion-descripcion h4 {
        margin: 0 0 8px;
        color: #202124;
        font-size: 17px;
        font-weight: normal;
        text-transform: uppercase;
    }

    .reunion-descripcion p {
        margin: 0;
        color: #5f6368;
        font-size: 13px;
        line-height: 1.55;
    }

    .lugar-reunion {
        margin-top: 9px !important;
        color: #202124 !important;
    }

    .lugar-reunion span {
        color: #5f6368;
    }

    .contenedor-estado {
        display: flex;
        justify-content: flex-end;
    }

    .estado-reunion {
        min-width: 105px;
        min-height: 34px;
        padding: 0 12px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #d8e3ef;
        border-radius: 17px;
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

    .reunion-secundaria {
        margin-top: 20px;
        padding-top: 18px;
        display: grid;
        grid-template-columns: minmax(0, 1fr) auto;
        gap: 24px;
        align-items: start;
        border-top: 1px solid #edf1f5;
    }

    .seccion-comunidades h5,
    .seccion-asistencia h5 {
        margin: 0 0 10px;
        color: #5f6368;
        font-size: 12px;
        font-weight: normal;
        text-transform: uppercase;
    }

    .comunidades-reunion {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
    }

    .comunidad-etiqueta {
        padding: 5px 10px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #d8e3ef;
        border-radius: 16px;
        color: #202124;
        background: #f7f9fc;
        font-size: 12px;
    }

    .sin-comunidades {
        color: #5f6368;
        font-size: 13px;
    }

    .asistencia-resumen {
        display: grid;
        grid-template-columns: repeat(4, minmax(75px, 1fr));
        overflow: hidden;
        border: 1px solid #d8e3ef;
        border-radius: 8px;
    }

    .dato-asistencia {
        min-width: 75px;
        padding: 9px 12px;
        border-right: 1px solid #d8e3ef;
        text-align: center;
    }

    .dato-asistencia:last-child {
        border-right: none;
    }

    .dato-asistencia span {
        display: block;
        margin-bottom: 4px;
        color: #5f6368;
        font-size: 11px;
    }

    .dato-asistencia strong {
        display: block;
        color: #202124;
        font-size: 16px;
        font-weight: normal;
    }

    .acciones-reunion {
        margin-top: 18px;
        padding-top: 18px;
        display: flex;
        justify-content: flex-end;
        flex-wrap: wrap;
        gap: 8px;
        border-top: 1px solid #edf1f5;
    }

    .accion-reunion {
        min-height: 39px;
        padding: 0 15px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #cbd8e6;
        border-radius: 7px;
        color: #202124;
        background: #ffffff;
        font-size: 13px;
        font-weight: normal;
        text-decoration: none;
    }

    .accion-reunion:hover {
        background: #f1f5f9;
    }

    .accion-principal {
        border-color: #1769c2;
        color: #ffffff;
        background: #1769c2;
    }

    .accion-principal:hover {
        color: #ffffff;
        background: #12569e;
    }

    .sin-registros {
        padding: 45px 20px;
        color: #5f6368;
        text-align: center;
    }

    .paginacion-reuniones {
        padding: 18px 25px;
        border-top: 1px solid #edf1f5;
    }

    @media (max-width: 1100px) {
        .reunion-secundaria {
            grid-template-columns: 1fr;
        }

        .asistencia-resumen {
            width: 100%;
        }
    }

    @media (max-width: 1000px) {
        .resumen-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .resumen-item:nth-child(2) {
            border-right: none;
        }

        .resumen-item:nth-child(-n+2) {
            border-bottom: 1px solid #d8e3ef;
        }

        .barra-filtros {
            grid-template-columns: 1fr 1fr;
        }

        .reunion-principal {
            grid-template-columns: 110px minmax(0, 1fr);
        }

        .contenedor-estado {
            grid-column: 1 / -1;
            justify-content: flex-start;
        }
    }

    @media (max-width: 700px) {
        .encabezado-reuniones {
            min-height: 265px;
            padding: 30px 24px;
            flex-direction: column;
            align-items: flex-start;
            justify-content: center;
            border-radius: 22px;;
        }

        .encabezado-reuniones h2 {
            font-size: 24px;
        }

        .boton-nueva-reunion {
            width: 100%;
        }

        .resumen-reuniones {
            padding: 22px;
        }

        .resumen-grid {
            grid-template-columns: 1fr;
        }

        .resumen-item {
            border-right: none;
            border-bottom: 1px solid #d8e3ef;
        }

        .resumen-item:last-child {
            border-bottom: none;
        }

        .barra-filtros {
            grid-template-columns: 1fr;
            padding: 18px;
        }

        .boton-buscar,
        .boton-limpiar {
            width: 100%;
        }

        .reunion-item {
            padding: 20px;
        }

        .reunion-principal {
            grid-template-columns: 1fr;
            gap: 15px;
        }

        .reunion-fecha {
            padding-right: 0;
            padding-bottom: 13px;
            border-right: none;
            border-bottom: 1px solid #e5edf5;
        }

        .contenedor-estado {
            grid-column: auto;
        }

        .reunion-secundaria {
            grid-template-columns: 1fr;
        }

        .asistencia-resumen {
            grid-template-columns: repeat(2, 1fr);
        }

        .dato-asistencia:nth-child(2) {
            border-right: none;
        }

        .dato-asistencia:nth-child(-n+2) {
            border-bottom: 1px solid #d8e3ef;
        }

        .acciones-reunion {
            flex-direction: column;
        }

        .accion-reunion {
            width: 100%;
        }
    }
</style>

<div class="reuniones-pagina">
    <div class="encabezado-reuniones">
        <div>
            <h2>Gestión de reuniones</h2>

            <p>
                Programa reuniones y controla la asistencia de los comunarios.
            </p>
        </div>

        <a
            href="{{ route('reuniones.create') }}"
            class="boton-nueva-reunion"
        >
            Nueva reunión
        </a>
    </div>

    @if (session('exito'))
        <div class="mensaje-exito">
            {{ session('exito') }}
        </div>
    @endif

    <div class="resumen-reuniones">
        <h3>Resumen de reuniones</h3>

        <p>
            Información general de las reuniones registradas.
        </p>

        <div class="resumen-grid">
            <div class="resumen-item">
                <span>Total de reuniones</span>
                <strong>{{ $totalReuniones }}</strong>
            </div>

            <div class="resumen-item">
                <span>Programadas</span>
                <strong>{{ $programadas }}</strong>
            </div>

            <div class="resumen-item">
                <span>Realizadas</span>
                <strong>{{ $realizadas }}</strong>
            </div>

            <div class="resumen-item">
                <span>Canceladas</span>
                <strong>{{ $canceladas }}</strong>
            </div>
        </div>
    </div>

    <div class="contenedor-reuniones">
        <div class="titulo-listado">
            <h3>Reuniones registradas</h3>

            <p>
                Busca una reunión por descripción, lugar o comunidad.
            </p>
        </div>

        <form
            action="{{ route('reuniones.index') }}"
            method="GET"
            class="barra-filtros"
        >
            <div class="campo-filtro">
                <label for="buscar">Buscar reunión</label>

                <input
                    type="text"
                    id="buscar"
                    name="buscar"
                    value="{{ $buscar }}"
                    placeholder="Descripción, lugar o comunidad"
                >
            </div>

            <div class="campo-filtro">
                <label for="estado">Estado</label>

                <select id="estado" name="estado">
                    <option value="">
                        Todos los estados
                    </option>

                    <option
                        value="programada"
                        @selected($estado === 'programada')
                    >
                        Programada
                    </option>

                    <option
                        value="realizada"
                        @selected($estado === 'realizada')
                    >
                        Realizada
                    </option>

                    <option
                        value="cancelada"
                        @selected($estado === 'cancelada')
                    >
                        Cancelada
                    </option>
                </select>
            </div>

            <button type="submit" class="boton-buscar">
                Buscar
            </button>

            @if ($buscar !== '' || !empty($estado))
                <a
                    href="{{ route('reuniones.index') }}"
                    class="boton-limpiar"
                >
                    Limpiar
                </a>
            @endif
        </form>

        <div class="lista-reuniones">
            @forelse ($reuniones as $reunion)
                <article class="reunion-item">
                    <div class="reunion-principal">
                        <div class="reunion-fecha">
                            <span class="fecha-texto">
                                {{ $reunion->fecha->format('d/m/Y') }}
                            </span>

                            <span class="hora-texto">
                                {{ $reunion->hora
                                    ? substr(
                                        (string) $reunion->hora,
                                        0,
                                        5
                                    )
                                    : 'Sin hora' }}
                            </span>
                        </div>

                        <div class="reunion-descripcion">
                            <h4>
                                {{ \Illuminate\Support\Str::limit(
                                    $reunion->descripcion,
                                    90
                                ) }}
                            </h4>

                            <p class="lugar-reunion">
                                <span>Lugar:</span>
                                {{ $reunion->lugar }}
                            </p>
                        </div>

                        <div class="contenedor-estado">
                            <span
                                class="estado-reunion
                                    estado-{{ $reunion->estado }}"
                            >
                                {{ $reunion->estado }}
                            </span>
                        </div>
                    </div>

                    <div class="reunion-secundaria">
                        <div class="seccion-comunidades">
                            <h5>Comunidades convocadas</h5>

                            <div class="comunidades-reunion">
                                @forelse (
                                    $reunion->comunidades
                                    as $comunidad
                                )
                                    <span class="comunidad-etiqueta">
                                        {{ $comunidad->nombre }}
                                    </span>
                                @empty
                                    <span class="sin-comunidades">
                                        Sin comunidades
                                    </span>
                                @endforelse
                            </div>
                        </div>

                        <div class="seccion-asistencia">
                            <h5>Asistencia registrada</h5>

                            <div class="asistencia-resumen">
                                <div class="dato-asistencia">
                                    <span>Presentes</span>

                                    <strong>
                                        {{ $reunion->presentes_count }}
                                    </strong>
                                </div>

                                <div class="dato-asistencia">
                                    <span>Retrasos</span>

                                    <strong>
                                        {{ $reunion->retrasos_count }}
                                    </strong>
                                </div>

                                <div class="dato-asistencia">
                                    <span>Faltas</span>

                                    <strong>
                                        {{ $reunion->faltas_count }}
                                    </strong>
                                </div>

                                <div class="dato-asistencia">
                                    <span>Licencias</span>

                                    <strong>
                                        {{ $reunion->licencias_count }}
                                    </strong>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="acciones-reunion">
                        <a
                            href="{{ route(
                                'reuniones.show',
                                $reunion
                            ) }}"
                            class="accion-reunion"
                        >
                            Ver
                        </a>

                        <a
                            href="{{ route(
                                'reuniones.edit',
                                $reunion
                            ) }}"
                            class="accion-reunion"
                        >
                            Editar
                        </a>

                        @if ($reunion->estado !== 'cancelada')
                            <a
                                href="{{ route(
                                    'reuniones.asistencia',
                                    $reunion
                                ) }}"
                                class="accion-reunion accion-principal"
                            >
                                Asistencia
                            </a>
                        @endif

                        <a
                            href="{{ route(
                                'reuniones.imprimir',
                                $reunion
                            ) }}"
                            class="accion-reunion"
                        >
                            Imprimir
                        </a>
                    </div>
                </article>
            @empty
                <div class="sin-registros">
                    No se encontraron reuniones registradas.
                </div>
            @endforelse
        </div>

        @if ($reuniones->hasPages())
            <div class="paginacion-reuniones">
                {{ $reuniones->links() }}
            </div>
        @endif
    </div>
</div>
@endsection