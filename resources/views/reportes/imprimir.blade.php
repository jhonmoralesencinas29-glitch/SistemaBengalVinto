<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        {{ $tipo === 'estado_cuenta'
            ? 'Estado de cuenta'
            : 'Reporte de asistencias' }}
    </title>

    <style>
        @page {
            size: letter portrait;
            margin: 12mm;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            color: #000000;
            background: #e5e7eb;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 11px;
        }

        .acciones {
            padding: 18px;
            display: flex;
            justify-content: center;
            gap: 12px;
        }

        .boton {
            min-height: 44px;
            padding: 0 24px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #cbd5e1;
            border-radius: 7px;
            color: #111827;
            background: #ffffff;
            font-size: 15px;
            text-decoration: none;
            cursor: pointer;
        }

        .boton-imprimir {
            border-color: #1761bf;
            color: #ffffff;
            background: #1761bf;
        }

        .hoja {
            width: 216mm;
            min-height: 279mm;
            margin: 0 auto 25px;
            padding: 12mm;
            background: #ffffff;
            box-shadow: 0 4px 18px rgba(0, 0, 0, 0.15);
        }

        .encabezado {
            min-height: 95px;
            padding-bottom: 10px;
            display: grid;
            grid-template-columns: 95px 1fr 95px;
            align-items: center;
            border-bottom: 1px solid #64748b;
        }

        .logo {
            width: 78px;
            height: 78px;
            object-fit: contain;
        }

        .encabezado-centro {
            text-align: center;
        }

        .encabezado-centro h1 {
            margin: 0 0 5px;
            font-size: 18px;
            font-weight: 700;
        }

        .encabezado-centro p {
            margin: 2px 0;
            font-size: 10px;
        }

        .fecha-emision {
            text-align: right;
            font-size: 9px;
            line-height: 1.5;
        }

        .titulo-reporte {
            padding: 15px 0 11px;
            text-align: center;
        }

        .titulo-reporte h2 {
            margin: 0 0 5px;
            font-size: 16px;
            text-transform: uppercase;
        }

        .titulo-reporte p {
            margin: 0;
            font-size: 10px;
        }

        .informacion {
            margin-bottom: 13px;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            border: 1px solid #9ca3af;
        }

        .informacion-item {
            min-height: 35px;
            padding: 7px 9px;
            border-right: 1px solid #9ca3af;
            border-bottom: 1px solid #9ca3af;
        }

        .informacion-item:nth-child(even) {
            border-right: none;
        }

        .informacion-item:nth-last-child(-n + 2) {
            border-bottom: none;
        }

        .informacion-item span {
            display: block;
            margin-bottom: 3px;
            font-size: 8px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .informacion-item strong {
            font-size: 10px;
        }

        .resumen {
            margin-bottom: 14px;
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            border: 1px solid #64748b;
        }

        .resumen-item {
            padding: 8px 4px;
            border-right: 1px solid #64748b;
            text-align: center;
        }

        .resumen-item:last-child {
            border-right: none;
        }

        .resumen-item span {
            display: block;
            margin-bottom: 4px;
            font-size: 8px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .resumen-item strong {
            font-size: 15px;
        }

        .tabla {
            width: 100%;
            border-collapse: collapse;
        }

        .tabla th,
        .tabla td {
            padding: 6px 5px;
            border: 1px solid #64748b;
            font-size: 9px;
            vertical-align: middle;
        }

        .tabla th {
            color: #ffffff;
            background: #111827;
            font-size: 8px;
            text-align: center;
            text-transform: uppercase;
        }

        .tabla td {
            color: #000000;
        }

        .centrado {
            text-align: center;
        }

        .derecha {
            text-align: right;
        }

        .estado {
            font-weight: 700;
            text-align: center;
        }

        .sin-datos {
            padding: 28px !important;
            text-align: center;
        }

        .seccion {
            margin-top: 16px;
        }

        .seccion h3 {
            margin: 0 0 8px;
            padding-bottom: 5px;
            border-bottom: 1px solid #64748b;
            font-size: 12px;
            text-transform: uppercase;
        }

        .totales-cuenta {
            width: 330px;
            margin: 0 0 15px auto;
            border-collapse: collapse;
        }

        .totales-cuenta td {
            padding: 7px 9px;
            border: 1px solid #64748b;
            font-size: 9px;
        }

        .totales-cuenta td:first-child {
            font-weight: 700;
            text-transform: uppercase;
        }

        .totales-cuenta td:last-child {
            width: 115px;
            text-align: right;
        }

        .saldo-final td {
            font-size: 11px;
            font-weight: 700;
        }

        .firmas {
            margin-top: 65px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 70px;
            break-inside: avoid;
            page-break-inside: avoid;
        }

        .firma {
            padding-top: 6px;
            border-top: 1px solid #000000;
            font-size: 9px;
            text-align: center;
        }

        .pie {
            margin-top: 22px;
            padding-top: 8px;
            border-top: 1px solid #cbd5e1;
            font-size: 8px;
            text-align: center;
        }

        @media print {
            body {
                background: #ffffff;
                print-color-adjust: exact;
                -webkit-print-color-adjust: exact;
            }

            .acciones {
                display: none;
            }

            .hoja {
                width: auto;
                min-height: auto;
                margin: 0;
                padding: 0;
                box-shadow: none;
            }

            .tabla thead {
                display: table-header-group;
            }

            .tabla tr,
            .informacion,
            .resumen,
            .totales-cuenta {
                break-inside: avoid;
                page-break-inside: avoid;
            }
        }
        
            body.pdf-render .hoja {
                width: auto;
                min-height: auto;
                margin: 0;
                padding: 0;
                box-shadow: none;
            }

            body.pdf-render .encabezado,
            body.pdf-render .informacion,
            body.pdf-render .resumen,
            body.pdf-render .firmas {
                display: table;
                width: 100%;
                table-layout: fixed;
            }

            body.pdf-render .encabezado > div,
            body.pdf-render .informacion-item,
            body.pdf-render .resumen-item,
            body.pdf-render .firma {
                display: table-cell;
                vertical-align: middle;
            }

            body.pdf-render .encabezado > div:first-child,
            body.pdf-render .encabezado > div:last-child {
                width: 95px;
            }

            body.pdf-render .informacion-item,
            body.pdf-render .firma {
                width: 50%;
            }
    </style>
</head>

<body class="{{ ($pdf ?? false) ? 'pdf-render' : '' }}">
    @php
        $tipoReporte = $tipo ?? request('tipo', 'asistencias');

        $listaAsistencias = $asistencias ?? collect();
        $listaAsignaciones = $asignaciones ?? collect();
        $listaPagos = $pagos ?? collect();

        $totalAsistencias = $listaAsistencias->count();

        $presentes = $listaAsistencias->filter(
            fn ($asistencia) =>
                strtoupper(trim($asistencia->estado_asistencia))
                === 'PRESENTE'
        )->count();

        $retrasos = $listaAsistencias->filter(
            fn ($asistencia) =>
                strtoupper(trim($asistencia->estado_asistencia))
                === 'RETRASO'
        )->count();

        $faltas = $listaAsistencias->filter(
            fn ($asistencia) =>
                strtoupper(trim($asistencia->estado_asistencia))
                === 'FALTA'
        )->count();

        $licencias = $listaAsistencias->filter(
            fn ($asistencia) =>
                strtoupper(trim($asistencia->estado_asistencia))
                === 'LICENCIA'
        )->count();

        $totalAsignado = (float) $listaAsignaciones
            ->sum('monto_asignado');

        $saldoPendiente = (float) $listaAsignaciones
            ->sum('saldo');

        $totalPagado = (float) $listaPagos
            ->sum('monto_pagado');

        $periodoSeleccionado = request('periodo', 'anio');

        $nombrePeriodo = match ($periodoSeleccionado) {
            'reunion' => 'Reunión seleccionada',
            'dia' => 'Reporte diario',
            'mes' => 'Reporte mensual',
            'semestre' => 'Reporte semestral',
            'anio' => 'Reporte anual',
            'personalizado' => 'Periodo personalizado',
            default => 'Periodo seleccionado',
        };

        $comunidadSeleccionada = !empty($idComunidad)
            ? $comunidades->firstWhere(
                'id_comunidad',
                (int) $idComunidad
            )
            : null;

        $nombreComunidad = $comunidadSeleccionada?->nombre
            ?? 'Todas las comunidades';

        $periodoMostrado = ($descripcionPeriodo ?? null)
            ?: $nombrePeriodo;
    @endphp

    @unless($pdf ?? false)
    <div class="acciones">
        <a
            href="{{ route('reportes.index', request()->query()) }}"
            class="boton"
        >
            Volver
        </a>

        <button
            type="button"
            class="boton boton-imprimir"
            onclick="window.print()"
        >
            Imprimir reporte
        </button>

        <a
            href="{{ route('reportes.pdf', request()->query()) }}"
            class="boton boton-imprimir"
        >
            Descargar PDF
        </a>
    </div>
    @endunless
    <main class="hoja">
        <header class="encabezado">
            <div>
                <img
                    src="{{ ($pdf ?? false) ? public_path('images/logo.png') : asset('images/logo.png') }}"
                    alt="Escudo del Cantón Bengal Vinto"
                    class="logo"
                >
            </div>

            <div class="encabezado-centro">
                <h1>CANTÓN BENGAL VINTO</h1>

                <p>
                    Sistema de Gestión de Aportes Comunitarios
                </p>

                <p>Bengal Vinto - Oruro - Bolivia</p>
            </div>

            <div class="fecha-emision">
                <strong>Fecha de emisión</strong><br>
                {{ now()->format('d/m/Y') }}<br>
                {{ now()->format('H:i') }}
            </div>
        </header>

        @if ($tipoReporte === 'asistencias')
            <section class="titulo-reporte">
                <h2>Reporte de asistencias</h2>

                <p>
                    {{ $periodoMostrado }}
                    ·
                    {{ $nombreComunidad }}
                </p>
            </section>

            <section class="informacion">
                <div class="informacion-item">
                    <span>Periodo consultado</span>

                    <strong>{{ $periodoMostrado }}</strong>
                </div>

                <div class="informacion-item">
                    <span>Comunidad</span>

                    <strong>{{ $nombreComunidad }}</strong>
                </div>
            </section>

            <section class="resumen">
                <div class="resumen-item">
                    <span>Registros</span>
                    <strong>{{ $totalAsistencias }}</strong>
                </div>

                <div class="resumen-item">
                    <span>Presentes</span>
                    <strong>{{ $presentes }}</strong>
                </div>

                <div class="resumen-item">
                    <span>Retrasos</span>
                    <strong>{{ $retrasos }}</strong>
                </div>

                <div class="resumen-item">
                    <span>Faltas</span>
                    <strong>{{ $faltas }}</strong>
                </div>

                <div class="resumen-item">
                    <span>Licencias</span>
                    <strong>{{ $licencias }}</strong>
                </div>
            </section>

            <table class="tabla">
                <thead>
                    <tr>
                        <th style="width: 35px;">N.º</th>
                        <th style="width: 75px;">Fecha</th>
                        <th>Reunión</th>
                        <th>Comunidad</th>
                        <th>Comunario</th>
                        <th style="width: 80px;">Estado</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($listaAsistencias as $asistencia)
                        <tr>
                            <td class="centrado">
                                {{ $loop->iteration }}
                            </td>

                            <td class="centrado">
                                {{
                                    $asistencia->reunion
                                        ?->fecha
                                        ?->format('d/m/Y')
                                    ?? 'Sin fecha'
                                }}
                            </td>

                            <td>
                                {{
                                    $asistencia->reunion
                                        ?->descripcion
                                    ?? 'Sin descripción'
                                }}
                            </td>

                            <td>
                                {{
                                    $asistencia->comunario
                                        ?->comunidad
                                        ?->nombre
                                    ?? 'Sin comunidad'
                                }}
                            </td>

                            <td>
                                {{
                                    $asistencia->comunario
                                        ?->apellidos
                                }}

                                {{
                                    $asistencia->comunario
                                        ?->nombres
                                }}
                            </td>

                            <td class="estado">
                                {{ $asistencia->estado_asistencia }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="sin-datos">
                                No existen registros de asistencia
                                para el periodo seleccionado.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        @else
            <section class="titulo-reporte">
                <h2>Estado de cuenta del comunario</h2>

                <p>
                    Detalle de aportes, pagos realizados y
                    saldo pendiente
                </p>
            </section>

            @if ($comunarioSeleccionado)
                <section class="informacion">
                    <div class="informacion-item">
                        <span>Nombre completo</span>

                        <strong>
                            {{ $comunarioSeleccionado->nombres }}
                            {{ $comunarioSeleccionado->apellidos }}
                        </strong>
                    </div>

                    <div class="informacion-item">
                        <span>Cédula de identidad</span>

                        <strong>
                            {{ $comunarioSeleccionado->ci }}
                        </strong>
                    </div>

                    <div class="informacion-item">
                        <span>Comunidad</span>

                        <strong>
                            {{
                                $comunarioSeleccionado
                                    ->comunidad
                                    ?->nombre
                                ?? 'Sin comunidad'
                            }}
                        </strong>
                    </div>

                    <div class="informacion-item">
                        <span>Teléfono</span>

                        <strong>
                            {{
                                $comunarioSeleccionado->telefono
                                ?: 'No registrado'
                            }}
                        </strong>
                    </div>
                </section>

                <table class="totales-cuenta">
                    <tr>
                        <td>Total asignado</td>

                        <td>
                            Bs {{
                                number_format(
                                    $totalAsignado,
                                    2,
                                    ',',
                                    '.'
                                )
                            }}
                        </td>
                    </tr>

                    <tr>
                        <td>Total pagado</td>

                        <td>
                            Bs {{
                                number_format(
                                    $totalPagado,
                                    2,
                                    ',',
                                    '.'
                                )
                            }}
                        </td>
                    </tr>

                    <tr class="saldo-final">
                        <td>Saldo pendiente</td>

                        <td>
                            Bs {{
                                number_format(
                                    $saldoPendiente,
                                    2,
                                    ',',
                                    '.'
                                )
                            }}
                        </td>
                    </tr>
                </table>

                <section class="seccion">
                    <h3>Aportes asignados</h3>

                    <table class="tabla">
                        <thead>
                            <tr>
                                <th style="width: 35px;">N.º</th>
                                <th>Concepto del aporte</th>
                                <th style="width: 90px;">
                                    Asignado
                                </th>
                                <th style="width: 90px;">
                                    Pagado
                                </th>
                                <th style="width: 90px;">
                                    Saldo
                                </th>
                                <th style="width: 75px;">
                                    Estado
                                </th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse (
                                $listaAsignaciones as $asignacion
                            )
                                @php
                                    $montoAsignado = (float)
                                        $asignacion->monto_asignado;

                                    $saldo = (float)
                                        $asignacion->saldo;

                                    $pagado = (float) (
                                        $asignacion->total_pagado
                                        ?? ($montoAsignado - $saldo)
                                    );
                                @endphp

                                <tr>
                                    <td class="centrado">
                                        {{ $loop->iteration }}
                                    </td>

                                    <td>
                                        {{
                                            $asignacion
                                                ->aporte
                                                ?->concepto
                                            ?? 'Sin concepto'
                                        }}
                                    </td>

                                    <td class="derecha">
                                        Bs {{
                                            number_format(
                                                $montoAsignado,
                                                2,
                                                ',',
                                                '.'
                                            )
                                        }}
                                    </td>

                                    <td class="derecha">
                                        Bs {{
                                            number_format(
                                                $pagado,
                                                2,
                                                ',',
                                                '.'
                                            )
                                        }}
                                    </td>

                                    <td class="derecha">
                                        Bs {{
                                            number_format(
                                                $saldo,
                                                2,
                                                ',',
                                                '.'
                                            )
                                        }}
                                    </td>

                                    <td class="centrado">
                                        {{
                                            ucfirst(
                                                $asignacion
                                                    ->estado_pago
                                            )
                                        }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td
                                        colspan="6"
                                        class="sin-datos"
                                    >
                                        El comunario no tiene
                                        aportes asignados.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </section>

                <section class="seccion">
                    <h3>Historial de pagos</h3>

                    <table class="tabla">
                        <thead>
                            <tr>
                                <th style="width: 35px;">N.º</th>
                                <th style="width: 80px;">Fecha</th>
                                <th>Aporte</th>
                                <th style="width: 115px;">
                                    Comprobante
                                </th>
                                <th style="width: 95px;">
                                    Monto pagado
                                </th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($listaPagos as $pago)
                                <tr>
                                    <td class="centrado">
                                        {{ $loop->iteration }}
                                    </td>

                                    <td class="centrado">
                                        {{
                                            $pago->fecha_pago
                                                ?->format('d/m/Y')
                                            ?? 'Sin fecha'
                                        }}
                                    </td>

                                    <td>
                                        {{
                                            $pago
                                                ->aporteComunario
                                                ?->aporte
                                                ?->concepto
                                            ?? 'Sin concepto'
                                        }}
                                    </td>

                                    <td class="centrado">
                                        {{
                                            $pago
                                                ->comprobante
                                                ?->numero_comprobante
                                            ?? 'No generado'
                                        }}
                                    </td>

                                    <td class="derecha">
                                        Bs {{
                                            number_format(
                                                (float)
                                                    $pago
                                                        ->monto_pagado,
                                                2,
                                                ',',
                                                '.'
                                            )
                                        }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td
                                        colspan="5"
                                        class="sin-datos"
                                    >
                                        El comunario todavía no tiene
                                        pagos registrados.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </section>
            @else
                <table class="tabla">
                    <tbody>
                        <tr>
                            <td class="sin-datos">
                                No se seleccionó ningún comunario.
                            </td>
                        </tr>
                    </tbody>
                </table>
            @endif
        @endif

        <section class="firmas">
            <div class="firma">
                Firma y sello de la autoridad
            </div>

            <div class="firma">
                {{
                    $tipoReporte === 'estado_cuenta'
                        ? 'Firma del comunario'
                        : 'Firma del responsable'
                }}
            </div>
        </section>

        <footer class="pie">
            Documento generado por el Sistema de Gestión de
            Aportes Comunitarios del Cantón Bengal Vinto.
        </footer>
    </main>
</body>
</html>