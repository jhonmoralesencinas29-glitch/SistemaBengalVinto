<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Lista de asistencia - {{ $reunion->fecha->format('d-m-Y') }}
    </title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            color: #000000;
            background: #e5e5e5;
            font-family: Arial, Helvetica, sans-serif;
        }

        .acciones {
            padding: 18px;
            display: flex;
            justify-content: center;
            gap: 12px;
        }

        .boton {
            min-width: 140px;
            min-height: 43px;
            padding: 0 18px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #000000;
            border-radius: 5px;
            color: #000000;
            background: #ffffff;
            font-size: 14px;
            text-decoration: none;
            cursor: pointer;
        }

        .boton-imprimir {
            color: #ffffff;
            background: #000000;
        }

        .hoja {
            width: 216mm;
            min-height: 279mm;
            margin: 0 auto 25px;
            padding: 8mm;
            position: relative;
            color: #000000;
            background: #ffffff;
            box-shadow: 0 3px 15px rgba(0, 0, 0, 0.18);
        }

        .hoja:not(:last-child) {
            page-break-after: always;
        }

        .encabezado {
            min-height: 27mm;
            display: grid;
            grid-template-columns: 25mm 1fr 35mm;
            align-items: center;
            gap: 4mm;
            padding-bottom: 3mm;
            border-bottom: 1px solid #000000;
        }

        .contenedor-logo {
            text-align: center;
        }

        .logo {
            width: 21mm;
            height: 21mm;
            object-fit: contain;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        .institucion {
            text-align: center;
        }

        .institucion h1 {
            margin: 0 0 2mm;
            color: #000000;
            font-size: 16px;
            font-weight: 600;
        }

        .institucion h2 {
            margin: 0 0 1.5mm;
            color: #000000;
            font-size: 14px;
            font-weight: 600;
        }

        .institucion p {
            margin: 0;
            color: #000000;
            font-size: 8px;
            line-height: 1.4;
        }

        .datos-documento {
            border: 1px solid #000000;
            font-size: 7px;
        }

        .datos-documento div {
            padding: 1.5mm;
            border-bottom: 1px solid #000000;
        }

        .datos-documento div:last-child {
            border-bottom: none;
        }

        .datos-documento span {
            display: block;
            margin-bottom: 0.5mm;
            font-size: 6px;
            text-transform: uppercase;
        }

        .datos-documento strong {
            font-weight: normal;
        }

        .informacion-reunion {
            margin-top: 3mm;
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            border: 1px solid #000000;
        }

        .informacion-reunion div {
            min-width: 0;
            padding: 1.7mm 2mm;
            border-right: 1px solid #000000;
            color: #000000;
            font-size: 7px;
        }

        .informacion-reunion div:last-child {
            border-right: none;
        }

        .informacion-reunion span {
            margin-right: 1mm;
            font-weight: 600;
        }

        .motivo {
            margin-top: 2mm;
            padding: 1.7mm 2mm;
            border: 1px solid #000000;
            color: #000000;
            font-size: 7px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .motivo span {
            font-weight: 600;
        }

        .encabezado-lista {
            margin-top: 3mm;
            padding: 2mm;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 4mm;
            border: 1px solid #000000;
            color: #000000;
        }

        .encabezado-lista h3 {
            margin: 0;
            color: #000000;
            font-size: 10px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .resumen {
            display: flex;
            gap: 3mm;
            white-space: nowrap;
        }

        .resumen span {
            color: #000000;
            font-size: 7px;
        }

        .resumen strong {
            font-weight: 600;
        }

        .columnas-lista {
            margin-top: 2mm;
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 3mm;
            align-items: start;
        }

        .tabla-asistencia {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .tabla-asistencia th,
        .tabla-asistencia td {
            border: 1px solid #000000;
            color: #000000;
        }

        .tabla-asistencia th {
            height: 6mm;
            padding: 1mm;
            background: #ffffff;
            font-size: 6.5px;
            font-weight: 600;
            text-align: center;
            text-transform: uppercase;
        }

        .tabla-asistencia td {
            height: 6.2mm;
            padding: 0.8mm 1mm;
            background: #ffffff;
            font-size: 7px;
            line-height: 1.1;
            vertical-align: middle;
        }

        .col-numero {
            width: 8%;
            text-align: center;
        }

        .col-nombre {
            width: 55%;
        }

        .col-ci {
            width: 20%;
            text-align: center;
        }

        .col-estado {
            width: 17%;
            text-align: center;
        }

        .texto-una-linea {
            display: block;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .fila-comunidad td {
            height: 5.5mm;
            padding: 1mm 1.5mm;
            border: 1px solid #000000;
            color: #000000;
            background: #ffffff;
            font-size: 7px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .sin-registros {
            height: 15mm !important;
            text-align: center;
        }

        .leyenda {
            margin-top: 2.5mm;
            padding: 1.5mm 2mm;
            border: 1px solid #000000;
            color: #000000;
            background: #ffffff;
            font-size: 7px;
            text-align: center;
        }

        .firmas {
            margin-top: 15mm;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30mm;
        }

        .firma {
            padding-top: 2mm;
            border-top: 1px solid #000000;
            color: #000000;
            font-size: 8px;
            text-align: center;
        }

        .pie-pagina {
            position: absolute;
            right: 8mm;
            bottom: 4mm;
            left: 8mm;
            padding-top: 1.5mm;
            display: flex;
            justify-content: space-between;
            border-top: 1px solid #000000;
            color: #000000;
            font-size: 6px;
        }

        @page {
            size: letter portrait;
            margin: 0;
        }

        @media print {
            html,
            body {
                width: 216mm;
                margin: 0;
                padding: 0;
                background: #ffffff;
            }

            .acciones {
                display: none !important;
            }

            .hoja {
                width: 216mm;
                min-height: 279mm;
                margin: 0;
                padding: 8mm;
                box-shadow: none;
            }

            .logo {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
        }

        @media screen and (max-width: 900px) {
            body {
                overflow-x: auto;
            }

            .hoja {
                min-width: 816px;
            }
        }
    </style>
</head>

<body>
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

        $asistenciasOrdenadas = $reunion->asistencias
            ->sortBy(function ($asistencia) use ($ordenComunidades) {
                $nombreComunidad =
                    $asistencia->comunario?->comunidad?->nombre ?? '';

                $posicion = array_search(
                    $nombreComunidad,
                    $ordenComunidades,
                    true
                );

                $posicion = $posicion === false
                    ? 999
                    : $posicion;

                $apellidos =
                    $asistencia->comunario?->apellidos ?? '';

                $nombres =
                    $asistencia->comunario?->nombres ?? '';

                return str_pad(
                    (string) $posicion,
                    3,
                    '0',
                    STR_PAD_LEFT
                ).'-'.$apellidos.'-'.$nombres;
            })
            ->values();

        /*
         * Numeración independiente por comunidad.
         */
        $numeracionPorAsistencia = [];
        $contadorPorComunidad = [];

        foreach ($asistenciasOrdenadas as $asistencia) {
            $claveComunidad = (string) (
                $asistencia->comunario?->id_comunidad
                ?? 'sin-comunidad'
            );

            if (!isset($contadorPorComunidad[$claveComunidad])) {
                $contadorPorComunidad[$claveComunidad] = 0;
            }

            $contadorPorComunidad[$claveComunidad]++;

            $numeracionPorAsistencia[
                $asistencia->id_asistencia
            ] = $contadorPorComunidad[$claveComunidad];
        }

        $asistenciasBengal = $asistenciasOrdenadas
            ->filter(function ($asistencia) {
                return $asistencia
                    ->comunario
                    ?->comunidad
                    ?->nombre === 'Bengal Vinto';
            })
            ->values();

        $asistenciasOtras = $asistenciasOrdenadas
            ->reject(function ($asistencia) {
                return $asistencia
                    ->comunario
                    ?->comunidad
                    ?->nombre === 'Bengal Vinto';
            })
            ->values();

        /*
         * Bengal Vinto:
         * 26 registros por columna.
         * 52 registros por hoja.
         *
         * Otras comunidades:
         * 22 registros por columna.
         * 44 registros por hoja.
         */
        $paginasImpresion = collect();

        foreach (
            $asistenciasBengal->chunk(52)
            as $indice => $registrosPagina
        ) {
            $paginasImpresion->push([
                'tipo' => 'bengal',
                'titulo' => 'Comunidad Bengal Vinto',
                'continuacion' => $indice > 0,
                'registros' => $registrosPagina->values(),
                'por_columna' => 26,
                'resumen' => $asistenciasBengal,
            ]);
        }

        foreach (
            $asistenciasOtras->chunk(44)
            as $indice => $registrosPagina
        ) {
            $paginasImpresion->push([
                'tipo' => 'otras',
                'titulo' => 'Comunidades convocadas',
                'continuacion' => $indice > 0,
                'registros' => $registrosPagina->values(),
                'por_columna' => 22,
                'resumen' => $asistenciasOtras,
            ]);
        }

        if ($paginasImpresion->isEmpty()) {
            $paginasImpresion->push([
                'tipo' => 'vacio',
                'titulo' => 'Lista de asistencia',
                'continuacion' => false,
                'registros' => collect(),
                'por_columna' => 22,
                'resumen' => collect(),
            ]);
        }

        $totalPaginas = $paginasImpresion->count();

        /*
         * Logo oficial a color.
         */
        $rutaLogo = public_path('images/logo.png');
    @endphp

    <div class="acciones">
        <a
            href="{{ route('reuniones.show', $reunion) }}"
            class="boton"
        >
            Volver
        </a>

        <button
            type="button"
            class="boton boton-imprimir"
            onclick="window.print()"
        >
            Imprimir
        </button>
    </div>

    @foreach ($paginasImpresion as $numeroPagina => $pagina)
        @php
            $columnasPagina = $pagina['registros']
                ->chunk($pagina['por_columna'])
                ->values();

            $resumenPagina = $pagina['resumen'];

            $totalPresentes = $resumenPagina
                ->where('estado_asistencia', 'presente')
                ->count();

            $totalRetrasos = $resumenPagina
                ->where('estado_asistencia', 'retraso')
                ->count();

            $totalFaltas = $resumenPagina
                ->where('estado_asistencia', 'falta')
                ->count();

            $totalLicencias = $resumenPagina
                ->where('estado_asistencia', 'licencia')
                ->count();

            $esUltimaPagina =
                $numeroPagina === $totalPaginas - 1;
        @endphp

        <main class="hoja">
            <header class="encabezado">
                <div class="contenedor-logo">
                    @if (file_exists($rutaLogo))
                        <img
                            src="{{ asset('images/logo.png') }}"
                            alt="Escudo del Cantón Bengal Vinto"
                            class="logo"
                        >
                    @endif
                </div>

                <div class="institucion">
                    <h1>CANTÓN BENGAL VINTO</h1>

                    <h2>CONTROL DE ASISTENCIA</h2>

                    <p>
                        Sistema de Gestión de Aportes Comunitarios
                    </p>

                    <p>Bengal Vinto - Oruro - Bolivia</p>
                </div>

                <div class="datos-documento">
                    <div>
                        <span>Reunión</span>

                        <strong>
                            N.º {{ str_pad(
                                (string) $reunion->id_reunion,
                                4,
                                '0',
                                STR_PAD_LEFT
                            ) }}
                        </strong>
                    </div>

                    <div>
                        <span>Página</span>

                        <strong>
                            {{ $numeroPagina + 1 }}
                            de
                            {{ $totalPaginas }}
                        </strong>
                    </div>
                </div>
            </header>

            <section class="informacion-reunion">
                <div>
                    <span>Fecha:</span>

                    {{ $reunion->fecha->format('d/m/Y') }}
                </div>

                <div>
                    <span>Hora:</span>

                    @if ($reunion->hora)
                        {{ \Carbon\Carbon::parse(
                            $reunion->hora
                        )->format('H:i') }}
                    @else
                        No especificada
                    @endif
                </div>

                <div>
                    <span>Lugar:</span>

                    {{ $reunion->lugar }}
                </div>
            </section>

            <div class="motivo">
                <span>Motivo:</span>

                {{ \Illuminate\Support\Str::limit(
                    $reunion->descripcion,
                    160
                ) }}
            </div>

            <section class="encabezado-lista">
                <h3>
                    {{ $pagina['titulo'] }}

                    @if ($pagina['continuacion'])
                        - Continuación
                    @endif
                </h3>

                <div class="resumen">
                    <span>
                        Total:
                        <strong>{{ $resumenPagina->count() }}</strong>
                    </span>

                    <span>
                        P:
                        <strong>{{ $totalPresentes }}</strong>
                    </span>

                    <span>
                        R:
                        <strong>{{ $totalRetrasos }}</strong>
                    </span>

                    <span>
                        F:
                        <strong>{{ $totalFaltas }}</strong>
                    </span>

                    <span>
                        L:
                        <strong>{{ $totalLicencias }}</strong>
                    </span>
                </div>
            </section>

            <section class="columnas-lista">
                @for (
                    $numeroColumna = 0;
                    $numeroColumna < 2;
                    $numeroColumna++
                )
                    @php
                        $registrosColumna = $columnasPagina->get(
                            $numeroColumna,
                            collect()
                        );

                        $ultimaComunidad = null;
                    @endphp

                    <table class="tabla-asistencia">
                        <colgroup>
                            <col class="col-numero">
                            <col class="col-nombre">
                            <col class="col-ci">
                            <col class="col-estado">
                        </colgroup>

                        <thead>
                            <tr>
                                <th>N.º</th>
                                <th>Nombre completo</th>
                                <th>CI</th>
                                <th>Estado</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($registrosColumna as $asistencia)
                                @php
                                    $nombreComunidad =
                                        $asistencia
                                            ->comunario
                                            ?->comunidad
                                            ?->nombre
                                        ?? 'Sin comunidad';

                                    $mostrarComunidad =
                                        $pagina['tipo'] === 'otras'
                                        && $nombreComunidad
                                            !== $ultimaComunidad;

                                    $ultimaComunidad =
                                        $nombreComunidad;

                                    $estadoImpresion = match (
                                        $asistencia->estado_asistencia
                                    ) {
                                        'presente' => 'P',
                                        'retraso' => 'R',
                                        'falta' => 'F',
                                        'licencia' => 'L',
                                        default => '-',
                                    };
                                @endphp

                                @if ($mostrarComunidad)
                                    <tr class="fila-comunidad">
                                        <td colspan="4">
                                            Comunidad:
                                            {{ $nombreComunidad }}
                                        </td>
                                    </tr>
                                @endif

                                <tr>
                                    <td class="col-numero">
                                        {{ $numeracionPorAsistencia[
                                            $asistencia->id_asistencia
                                        ] ?? $loop->iteration }}
                                    </td>

                                    <td class="col-nombre">
                                        <span class="texto-una-linea">
                                            {{ $asistencia
                                                ->comunario
                                                ->apellidos }}

                                            {{ $asistencia
                                                ->comunario
                                                ->nombres }}
                                        </span>
                                    </td>

                                    <td class="col-ci">
                                        <span class="texto-una-linea">
                                            {{ $asistencia
                                                ->comunario
                                                ->ci }}
                                        </span>
                                    </td>

                                    <td class="col-estado">
                                        {{ $estadoImpresion }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td
                                        colspan="4"
                                        class="sin-registros"
                                    >
                                        Sin registros
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                @endfor
            </section>

            <div class="leyenda">
                <strong>P</strong> = Presente &nbsp;&nbsp;
                <strong>R</strong> = Retraso &nbsp;&nbsp;
                <strong>F</strong> = Falta &nbsp;&nbsp;
                <strong>L</strong> = Licencia
            </div>

            @if ($esUltimaPagina)
                <section class="firmas">
                    <div class="firma">
                        Firma y sello de la autoridad
                    </div>

                    <div class="firma">
                        Firma del responsable de asistencia
                    </div>
                </section>
            @endif

            <footer class="pie-pagina">
                <span>
                    Sistema de Gestión de Aportes Comunitarios
                </span>

                <span>
                    Página {{ $numeroPagina + 1 }}
                    de {{ $totalPaginas }}
                </span>
            </footer>
        </main>
    @endforeach
</body>
</html>