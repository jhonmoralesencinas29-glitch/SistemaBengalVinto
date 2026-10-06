<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Comprobante {{ $pago->comprobante->numero_comprobante }}
    </title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 22px;
            color: #000000;
            background: #e9e9e9;
            font-family: Arial, Helvetica, sans-serif;
        }

        .acciones-pagina {
            margin-bottom: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-wrap: wrap;
            gap: 10px;
        }

        .boton {
            min-width: 130px;
            min-height: 42px;
            padding: 0 18px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #000000;
            border-radius: 4px;
            color: #000000;
            background: #ffffff;
            font-size: 14px;
            font-weight: normal;
            text-decoration: none;
            cursor: pointer;
        }

        .boton-pdf {
            color: #ffffff;
            border-color: #1761bf;
            background: #1761bf;
        }

        .boton-pdf:hover {
            border-color: #0f4fa5;
            background: #0f4fa5;
        }

        .boton-imprimir {
            color: #ffffff;
            background: #000000;
        }

        .hoja {
            width: 216mm;
            min-height: 279mm;
            margin: 0 auto;
            padding: 7mm 9mm;
            background: #ffffff;
            box-shadow: 0 2px 14px rgba(0, 0, 0, 0.18);
        }

        .comprobante {
            height: 128mm;
            padding: 4.5mm 5mm 3.5mm;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            border: 0.35mm solid #aeb7c2;
            background: #ffffff;
        }

        .encabezado {
            display: grid;
            grid-template-columns: 28mm 1fr 58mm;
            gap: 4mm;
            align-items: center;
        }

        .logo-comunidad {
            width: 26mm;
            height: 26mm;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .logo-comunidad img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .datos-institucion {
            text-align: center;
        }

        .datos-institucion h1 {
            margin: 0 0 1.8mm;
            color: #000000;
            font-size: 15px;
            font-weight: 700;
            line-height: 1.15;
            text-transform: uppercase;
        }

        .datos-institucion p {
            margin: 0.8mm 0;
            color: #000000;
            font-size: 9px;
            font-weight: normal;
            line-height: 1.25;
        }

        .datos-comprobante {
            overflow: hidden;
            border: 0.3mm solid #aeb7c2;
            border-radius: 3px;
        }

        .dato-comprobante {
            min-height: 7mm;
            padding: 1.3mm 1.8mm;
            display: grid;
            grid-template-columns: 19mm 1fr;
            gap: 1.5mm;
            align-items: center;
            border-bottom: 0.3mm solid #b8c0c9;
            font-size: 7.7px;
        }

        .dato-comprobante:last-child {
            border-bottom: none;
        }

        .dato-comprobante span {
            font-weight: 700;
            text-transform: uppercase;
        }

        .dato-comprobante strong {
            overflow-wrap: anywhere;
            font-weight: normal;
        }

        .titulo-comprobante {
            margin: 2.5mm 0 2mm;
            padding: 1.2mm;
            border-top: 0.3mm solid #aeb7c2;
            border-bottom: 0.3mm solid #aeb7c2;
            text-align: center;
        }

        .titulo-comprobante h2 {
            margin: 0;
            color: #000000;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .titulo-comprobante p {
            margin: 0.7mm 0 0;
            color: #000000;
            font-size: 7.5px;
            font-weight: normal;
        }

        .datos-cliente {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.3mm 7mm;
            margin-bottom: 2.5mm;
        }

        .dato-cliente {
            display: grid;
            grid-template-columns: auto 1fr;
            gap: 1.7mm;
            color: #000000;
            font-size: 8px;
        }

        .dato-cliente span {
            font-weight: 700;
        }

        .dato-cliente strong {
            overflow-wrap: anywhere;
            font-weight: normal;
        }

        .tabla-detalle {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .tabla-detalle th,
        .tabla-detalle td {
            padding: 1.5mm 1.3mm;
            border: 0.3mm solid #aeb7c2;
            color: #000000;
            font-size: 7.6px;
        }

        .tabla-detalle th {
            background: #f7f7f7;
            font-weight: 700;
            text-align: center;
            text-transform: uppercase;
        }

        .tabla-detalle td {
            height: 8mm;
            font-weight: normal;
            vertical-align: middle;
        }

        .tabla-detalle td strong {
            font-weight: normal;
        }

        .columna-codigo {
            width: 18mm;
            text-align: center;
        }

        .columna-monto {
            width: 29mm;
            text-align: right;
        }

        .resumen {
            margin-top: 2mm;
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 7mm;
        }

        .informacion-adicional {
            flex: 1;
            color: #000000;
            font-size: 7.7px;
            line-height: 1.35;
        }

        .informacion-adicional p {
            margin: 0 0 1.2mm;
        }

        .informacion-adicional strong {
            font-weight: 700;
        }

        .totales {
            width: 68mm;
            border: 0.3mm solid #aeb7c2;
        }

        .fila-total {
            display: grid;
            grid-template-columns: 1fr 27mm;
            border-bottom: 0.3mm solid #b8c0c9;
        }

        .fila-total:last-child {
            border-bottom: none;
        }

        .fila-total span,
        .fila-total strong {
            padding: 1.2mm 1.7mm;
            color: #000000;
            font-size: 7.5px;
        }

        .fila-total span {
            border-right: 0.3mm solid #b8c0c9;
            font-weight: normal;
            text-align: right;
            text-transform: uppercase;
        }

        .fila-total strong {
            font-weight: normal;
            text-align: right;
        }

        .fila-total-principal span,
        .fila-total-principal strong {
            font-weight: 700;
        }

        .firmas {
            margin-top: auto;
            padding-top: 11mm;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 28mm;
        }

        .firma {
            padding-top: 1.5mm;
            border-top: 0.3mm solid #8f99a5;
            color: #000000;
            font-size: 7.5px;
            font-weight: normal;
            text-align: center;
        }

        .pie-comprobante {
            margin-top: 3mm;
            padding-top: 1.7mm;
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 5mm;
            align-items: center;
            border-top: 0.3mm solid #c2c8cf;
        }

        .mensaje-certificacion {
            color: #000000;
            font-size: 6.5px;
            font-weight: normal;
            line-height: 1.25;
            text-align: left;
        }

        .desarrollador {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 1.5mm;
            color: #000000;
            font-size: 6.5px;
            white-space: nowrap;
        }

        .desarrollador span {
            font-weight: normal;
        }

        .logo-desarrollador {
            width: 19mm;
            height: 7mm;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: visible;
        }

        .logo-desarrollador img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
            transform: scale(1.35);
            transform-origin: center;
        }

        .separador {
            position: relative;
            height: 9mm;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .separador::before {
            width: 100%;
            content: "";
            border-top: 0.3mm dashed #9aa3ad;
        }

        .separador span {
            position: absolute;
            left: 50%;
            padding: 0 3mm;
            color: #555555;
            background: #ffffff;
            font-size: 6.5px;
            font-weight: normal;
            transform: translateX(-50%);
        }

        @page {
            size: Letter portrait;
            margin: 0;
        }

        @media print {
            body {
                padding: 0;
                background: #ffffff;
            }

            .acciones-pagina {
                display: none;
            }

            .hoja {
                width: 216mm;
                height: 279mm;
                min-height: 279mm;
                margin: 0;
                padding: 7mm 9mm;
                box-shadow: none;
            }

            .comprobante {
                break-inside: avoid;
                page-break-inside: avoid;
            }

            .logo-comunidad img,
            .logo-desarrollador img {
                print-color-adjust: exact;
                -webkit-print-color-adjust: exact;
            }
        }

        @media screen and (max-width: 850px) {
            body {
                padding: 10px;
            }

            .acciones-pagina {
                width: 100%;
            }

            .boton {
                flex: 1;
                min-width: 140px;
            }

            .hoja {
                width: 100%;
                min-height: auto;
                padding: 12px;
            }

            .comprobante {
                height: auto;
                min-height: 490px;
            }

            .encabezado {
                grid-template-columns: 75px 1fr;
            }

            .datos-comprobante {
                grid-column: 1 / -1;
            }

            .firmas {
                margin-top: 20px;
                padding-top: 35px;
                gap: 30px;
            }

            .pie-comprobante {
                grid-template-columns: 1fr;
            }

            .desarrollador {
                justify-content: center;
            }
        }
    </style>
</head>

<body>
    @php
        $asignacion = $pago->aporteComunario;
        $comunario = $asignacion->comunario;
        $aporte = $asignacion->aporte;
        $comprobante = $pago->comprobante;
    @endphp

    <div class="acciones-pagina">
        <a
            href="{{ route('pagos.show', $pago) }}"
            class="boton"
        >
            Volver
        </a>

        <a
            href="{{ route('pagos.comprobante.pdf', $pago) }}"
            class="boton boton-pdf"
        >
            Descargar PDF
        </a>

        <button
            type="button"
            class="boton boton-imprimir"
            onclick="window.print()"
        >
            Imprimir
        </button>
    </div>

    <div class="hoja">
        @foreach (
            [
                'Copia para la autoridad',
                'Copia para el comunario'
            ] as $copia
        )
            <section class="comprobante">
                <div class="encabezado">
                    <div class="logo-comunidad">
                        <img
                            src="{{ asset('images/logo.png') }}"
                            alt="Escudo del Cantón Bengal Vinto"
                        >
                    </div>

                    <div class="datos-institucion">
                        <h1>Cantón Bengal Vinto</h1>

                        <p>
                            Sistema de Gestión de Aportes Comunitarios
                        </p>

                        <p>
                            Bengal Vinto - Oruro - Bolivia
                        </p>
                    </div>

                    <div class="datos-comprobante">
                        <div class="dato-comprobante">
                            <span>Número</span>

                            <strong>
                                {{ $comprobante->numero_comprobante }}
                            </strong>
                        </div>

                        <div class="dato-comprobante">
                            <span>Pago</span>

                            <strong>
                                {{ str_pad(
                                    (string) $pago->id_pago,
                                    6,
                                    '0',
                                    STR_PAD_LEFT
                                ) }}
                            </strong>
                        </div>

                        <div class="dato-comprobante">
                            <span>Fecha</span>

                            <strong>
                                {{ $pago->fecha_pago->format('d/m/Y H:i') }}
                            </strong>
                        </div>
                    </div>
                </div>

                <div class="titulo-comprobante">
                    <h2>Comprobante de pago</h2>

                    <p>{{ $copia }}</p>
                </div>

                <div class="datos-cliente">
                    <div class="dato-cliente">
                        <span>Comunario:</span>

                        <strong>
                            {{ $comunario->nombres }}
                            {{ $comunario->apellidos }}
                        </strong>
                    </div>

                    <div class="dato-cliente">
                        <span>CI:</span>

                        <strong>
                            {{ $comunario->ci }}
                        </strong>
                    </div>

                    <div class="dato-cliente">
                        <span>Comunidad:</span>

                        <strong>
                            {{ $comunario->comunidad->nombre ?? 'Sin comunidad' }}
                        </strong>
                    </div>

                    <div class="dato-cliente">
                        <span>Registrado por:</span>

                        <strong>
                            {{ $pago->usuario->nombre_completo }}
                        </strong>
                    </div>
                </div>

                <table class="tabla-detalle">
                    <thead>
                        <tr>
                            <th class="columna-codigo">
                                Código
                            </th>

                            <th>
                                Descripción del aporte
                            </th>

                            <th class="columna-monto">
                                Monto asignado
                            </th>

                            <th class="columna-monto">
                                Monto pagado
                            </th>

                            <th class="columna-monto">
                                Saldo
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td class="columna-codigo">
                                {{ $aporte->id_aporte }}
                            </td>

                            <td>
                                {{ $aporte->concepto }}
                            </td>

                            <td class="columna-monto">
                                Bs
                                {{ number_format(
                                    (float) $asignacion->monto_asignado,
                                    2,
                                    ',',
                                    '.'
                                ) }}
                            </td>

                            <td class="columna-monto">
                                Bs
                                {{ number_format(
                                    (float) $pago->monto_pagado,
                                    2,
                                    ',',
                                    '.'
                                ) }}
                            </td>

                            <td class="columna-monto">
                                Bs
                                {{ number_format(
                                    (float) $asignacion->saldo,
                                    2,
                                    ',',
                                    '.'
                                ) }}
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div class="resumen">
                    <div class="informacion-adicional">
                        <p>
                            <strong>Concepto:</strong>

                            Pago correspondiente al aporte
                            {{ $aporte->concepto }}.
                        </p>

                        <p>
                            <strong>Estado actual:</strong>

                            {{ ucfirst($asignacion->estado_pago) }}
                        </p>
                    </div>

                    <div class="totales">
                        <div class="fila-total">
                            <span>Saldo anterior Bs</span>

                            <strong>
                                {{ number_format(
                                    (float) $asignacion->saldo +
                                    (float) $pago->monto_pagado,
                                    2,
                                    ',',
                                    '.'
                                ) }}
                            </strong>
                        </div>

                        <div class="fila-total">
                            <span>Pago realizado Bs</span>

                            <strong>
                                {{ number_format(
                                    (float) $pago->monto_pagado,
                                    2,
                                    ',',
                                    '.'
                                ) }}
                            </strong>
                        </div>

                        <div class="fila-total fila-total-principal">
                            <span>Saldo pendiente Bs</span>

                            <strong>
                                {{ number_format(
                                    (float) $asignacion->saldo,
                                    2,
                                    ',',
                                    '.'
                                ) }}
                            </strong>
                        </div>
                    </div>
                </div>

                <div class="firmas">
                    <div class="firma">
                        Firma y sello de la autoridad
                    </div>

                    <div class="firma">
                        Firma del comunario
                    </div>
                </div>

                <div class="pie-comprobante">
                    <div class="mensaje-certificacion">
                        Este documento certifica el registro del pago en el
                        Sistema de Gestión de Aportes Comunitarios del Cantón
                        Bengal Vinto.
                    </div>

                    <div class="desarrollador">
                        <span>Desarrollado por:</span>

                        <div class="logo-desarrollador">
                            <img
                                src="{{ asset('images/mi-logos.png') }}"
                                alt="Logo del desarrollador"
                            >
                        </div>
                    </div>
                </div>
            </section>

            @if (!$loop->last)
                <div class="separador">
                    <span>Línea de corte</span>
                </div>
            @endif
        @endforeach
    </div>
</body>
</html>