<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Comprobante {{ $pago->comprobante->numero_comprobante }}</title>

    <style>
        @page {
            size: letter portrait;
            margin: 0;
        }

        html,
        body {
            width: 215mm;
            height: 278mm;
            margin: 0;
            padding: 0;
            overflow: hidden;
        }

        body {
            color: #000;
            background: #fff;
            font-family: DejaVu Sans, sans-serif;
        }

        .hoja {
            position: relative;
            width: 215mm;
            height: 278mm;
            margin: 0;
            padding: 0;
            overflow: hidden;
        }

        .comprobante {
            position: absolute;
            left: 9mm;
            width: 187mm;
            height: 120mm;
            margin: 0;
            padding: 4mm;
            overflow: hidden;
            border: 0.3mm solid #aeb7c2;
            background: #fff;
        }

        .copia-autoridad {
            top: 6mm;
        }

        .copia-comunario {
            top: 145mm;
        }

        table {
            border-spacing: 0;
        }

        .encabezado {
            width: 100%;
            margin: 1.5mm 0;
            table-layout: fixed;
        }

        .encabezado td {
            vertical-align: middle;
        }

        .celda-logo {
            width: 28mm;
            text-align: center;
        }

        .logo-comunidad {
            width: 26mm;
            height: 26mm;
        }

        .celda-institucion {
            padding: 0 27mm 0 3mm;
            text-align: center;
        }

        .nombre-institucion {
            margin: 0 0 1.5mm;
            font-size: 14px;
            font-weight: bold;
            line-height: 1.15;
            text-transform: uppercase;
        }

        .texto-institucion {
            margin: 0.6mm 0;
            font-size: 8px;
            line-height: 1.2;
        }

        .celda-datos {
            width: 62mm;
        }

        .datos-comprobante {
            width: 58mm;
            border: 0.3mm solid #aeb7c2;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .datos-comprobante td {
            height: 5.5mm;
            padding: 0.7mm;
            border-bottom: 0.3mm solid #b8c0c9;
            font-size: 6.5px;
            vertical-align: middle;
        }

        .datos-comprobante tr:last-child td {
            border-bottom: none;
        }

        .etiqueta-comprobante {
            width: 15mm;
            font-weight: bold;
            text-transform: uppercase;
        }

        .valor-comprobante {
            width: 43mm;
            font-size: 6px;
            font-weight: normal;
            white-space: nowrap;
        }

        .titulo-comprobante {
            width: 100%;
            margin: 1.5mm 0 1.2mm;
            padding: 0.7mm 0;
            border-top: 0.3mm solid #aeb7c2;
            border-bottom: 0.3mm solid #aeb7c2;
            text-align: center;
        }

        .titulo-comprobante h2 {
            margin: 0;
            font-size: 11px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .titulo-comprobante p {
            margin: 0.5mm 0 0;
            font-size: 7px;
        }

        .datos-cliente {
            width: 100%;
            margin-bottom: 2mm;
            table-layout: fixed;
        }

        .datos-cliente td {
            width: 50%;
            padding: 0.5mm 3mm 0.5mm 0;
            font-size: 7.2px;
            line-height: 1.2;
            vertical-align: top;
        }

        .datos-cliente span {
            font-weight: bold;
        }

        .tabla-detalle {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .tabla-detalle th,
        .tabla-detalle td {
            padding: 1.2mm 1mm;
            border: 0.3mm solid #aeb7c2;
            font-size: 7px;
        }

        .tabla-detalle th {
            background: #f7f7f7;
            font-weight: bold;
            text-align: center;
            text-transform: uppercase;
        }

        .tabla-detalle td {
            height: 7mm;
            vertical-align: middle;
        }

        .columna-codigo {
            width: 10%;
            text-align: center;
        }

        .columna-descripcion {
            width: 44%;
        }

        .columna-monto {
            width: 15.33%;
            text-align: right;
        }

        .resumen {
            width: 100%;
            margin-top: 1.5mm;
            table-layout: fixed;
        }

        .resumen td {
            vertical-align: top;
        }

        .informacion-adicional {
            padding-right: 7mm;
            font-size: 7px;
            line-height: 1.3;
        }

        .informacion-adicional p {
            margin: 0 0 1mm;
        }

        .celda-totales {
            width: 66mm;
        }

        .totales {
            width: 100%;
            border: 0.3mm solid #aeb7c2;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .totales td {
            padding: 1mm 1.5mm;
            border-bottom: 0.3mm solid #b8c0c9;
            font-size: 7px;
        }

        .totales tr:last-child td {
            border-bottom: none;
        }

        .total-etiqueta {
            width: 41mm;
            border-right: 0.3mm solid #b8c0c9;
            text-align: right;
            text-transform: uppercase;
        }

        .total-valor {
            width: 25mm;
            text-align: right;
        }

        .total-principal td {
            font-weight: bold;
        }

        .firmas {
            position: absolute;
            left: 4mm;
            bottom: 18mm;
            width: 187mm;
            margin: 0;
            table-layout: fixed;
        }

        .firmas td {
            width: 50%;
            padding: 0 7mm;
            vertical-align: bottom;
        }

        .firma {
            padding-top: 1.5mm;
            border-top: 0.3mm solid #8f99a5;
            font-size: 7px;
            text-align: center;
        }

        .pie-comprobante {
            position: absolute;
            left: 4mm;
            bottom: 4mm;
            width: 187mm;
            height: 8mm;
            border-top: 0.3mm solid #c2c8cf;
        }

        .pie-contenido {
            width: 100%;
            height: 100%;
            table-layout: fixed;
        }

        .pie-contenido td {
            vertical-align: middle;
        }

        .mensaje-certificacion {
            width: 82%;
            padding-right: 3mm;
            font-size: 6px;
            line-height: 1.2;
            white-space: nowrap;
        }

        .desarrollador {
            width: 18%;
            font-size: 6px;
            text-align: right;
            white-space: nowrap;
        }

        .logo-desarrollador {
            width: 19mm;
            height: 7mm;
            margin-left: 1mm;
            vertical-align: middle;
        }

        .separador {
            position: absolute;
            top: 139mm;
            left: 9mm;
            width: 197mm;
            height: 5mm;
            text-align: center;
        }

        .separador-linea {
            width: 100%;
            border-top: 0.3mm dashed #9aa3ad;
        }

        .separador span {
            position: relative;
            top: -2.3mm;
            padding: 0 3mm;
            color: #555;
            background: #fff;
            font-size: 6px;
        }
    </style>
</head>
<body>
    @php
        $asignacion = $pago->aporteComunario;
        $comunario = $asignacion->comunario;
        $aporte = $asignacion->aporte;
        $comprobante = $pago->comprobante;
        $saldoAnterior = (float) $asignacion->saldo + (float) $pago->monto_pagado;
    @endphp

    <div class="hoja">
        @foreach (['Copia para la autoridad', 'Copia para el comunario'] as $copia)
            <section class="comprobante {{ $loop->first ? 'copia-autoridad' : 'copia-comunario' }}">
                <table class="encabezado">
                    <colgroup>
                        <col style="width: 28mm;">
                        <col>
                        <col style="width: 62mm;">
                    </colgroup>
                    <tr>
                        <td class="celda-logo">
                            <img
                                src="{{ public_path('images/logo.png') }}"
                                class="logo-comunidad"
                                alt="Escudo del Cantón Bengal Vinto"
                            >
                        </td>
                        <td class="celda-institucion">
                            <div class="nombre-institucion">Cantón Bengal Vinto</div>
                            <div class="texto-institucion">Sistema de Gestión de Aportes Comunitarios</div>
                            <div class="texto-institucion">Bengal Vinto - Oruro - Bolivia</div>
                        </td>
                        <td class="celda-datos">
                            <table class="datos-comprobante">
                                <colgroup>
                                    <col style="width: 15mm;">
                                    <col style="width: 43mm;">
                                </colgroup>
                                <tr>
                                    <td class="etiqueta-comprobante">Número</td>
                                    <td class="valor-comprobante">{{ $comprobante->numero_comprobante }}</td>
                                </tr>
                                <tr>
                                    <td class="etiqueta-comprobante">Pago</td>
                                    <td class="valor-comprobante">
                                        {{ str_pad((string) $pago->id_pago, 6, '0', STR_PAD_LEFT) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="etiqueta-comprobante">Fecha</td>
                                    <td class="valor-comprobante">{{ $pago->fecha_pago->format('d/m/Y H:i') }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>

                <div class="titulo-comprobante">
                    <h2>Comprobante de pago</h2>
                    <p>{{ $copia }}</p>
                </div>

                <table class="datos-cliente">
                    <tr>
                        <td>
                            <span>Comunario:</span>
                            {{ $comunario->nombres }} {{ $comunario->apellidos }}
                        </td>
                        <td>
                            <span>CI:</span>
                            {{ $comunario->ci }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span>Comunidad:</span>
                            {{ $comunario->comunidad->nombre ?? 'Sin comunidad' }}
                        </td>
                        <td>
                            <span>Registrado por:</span>
                            {{ $pago->usuario->nombre_completo }}
                        </td>
                    </tr>
                </table>

                <table class="tabla-detalle">
                    <colgroup>
                        <col style="width: 10%;">
                        <col style="width: 44%;">
                        <col style="width: 15.33%;">
                        <col style="width: 15.33%;">
                        <col style="width: 15.34%;">
                    </colgroup>
                    <thead>
                        <tr>
                            <th class="columna-codigo">Código</th>
                            <th class="columna-descripcion">Descripción del aporte</th>
                            <th class="columna-monto">Monto asignado</th>
                            <th class="columna-monto">Monto pagado</th>
                            <th class="columna-monto">Saldo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="columna-codigo">{{ $aporte->id_aporte }}</td>
                            <td class="columna-descripcion">{{ $aporte->concepto }}</td>
                            <td class="columna-monto">
                                Bs {{ number_format((float) $asignacion->monto_asignado, 2, ',', '.') }}
                            </td>
                            <td class="columna-monto">
                                Bs {{ number_format((float) $pago->monto_pagado, 2, ',', '.') }}
                            </td>
                            <td class="columna-monto">
                                Bs {{ number_format((float) $asignacion->saldo, 2, ',', '.') }}
                            </td>
                        </tr>
                    </tbody>
                </table>

                <table class="resumen">
                    <tr>
                        <td class="informacion-adicional">
                            <p>
                                <strong>Concepto:</strong>
                                Pago correspondiente al aporte {{ $aporte->concepto }}.
                            </p>
                            <p>
                                <strong>Estado actual:</strong>
                                {{ ucfirst($asignacion->estado_pago) }}
                            </p>
                        </td>
                        <td class="celda-totales">
                            <table class="totales">
                                <colgroup>
                                    <col style="width: 41mm;">
                                    <col style="width: 25mm;">
                                </colgroup>
                                <tr>
                                    <td class="total-etiqueta">Saldo anterior Bs</td>
                                    <td class="total-valor">
                                        {{ number_format($saldoAnterior, 2, ',', '.') }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="total-etiqueta">Pago realizado Bs</td>
                                    <td class="total-valor">
                                        {{ number_format((float) $pago->monto_pagado, 2, ',', '.') }}
                                    </td>
                                </tr>
                                <tr class="total-principal">
                                    <td class="total-etiqueta">Saldo pendiente Bs</td>
                                    <td class="total-valor">
                                        {{ number_format((float) $asignacion->saldo, 2, ',', '.') }}
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>

                <table class="firmas">
                    <tr>
                        <td>
                            <div class="firma">Firma y sello de la autoridad</div>
                        </td>
                        <td>
                            <div class="firma">Firma del comunario</div>
                        </td>
                    </tr>
                </table>

                <div class="pie-comprobante">
                    <table class="pie-contenido">
                        <colgroup>
                            <col style="width: 82%;">
                            <col style="width: 18%;">
                        </colgroup>
                        <tr>
                            <td class="mensaje-certificacion">
                                Este documento certifica el registro del pago en el Sistema de Gestión de Aportes Comunitarios del Cantón Bengal Vinto.
                            </td>
                            <td class="desarrollador">
                                Desarrollado por:
                                <img
                                    src="{{ public_path('images/mi-logos.png') }}"
                                    class="logo-desarrollador"
                                    alt="Logo del desarrollador"
                                >
                            </td>
                        </tr>
                    </table>
                </div>
            </section>
        @endforeach

        <div class="separador">
            <div class="separador-linea"></div>
            <span>Línea de corte</span>
        </div>
    </div>
</body>
</html>