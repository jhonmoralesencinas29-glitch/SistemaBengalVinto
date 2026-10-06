<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Symfony\Component\Process\Process;
use Throwable;

class RespaldoController extends Controller
{
    public function descargar()
    {
        $conexion = config(
            'database.connections.'.config('database.default')
        );

        abort_unless(
            ($conexion['driver'] ?? null) === 'mysql',
            500,
            'La conexión configurada no es MySQL.'
        );

        $programa = 'C:\\xampp\\mysql\\bin\\mysqldump.exe';

        abort_unless(
            is_file($programa),
            500,
            'No se encontró mysqldump en la carpeta de XAMPP.'
        );

        $entorno = getenv();

        if (!is_array($entorno)) {
            $entorno = [];
        }

        $entorno['MYSQL_PWD'] = (string) ($conexion['password'] ?? '');

        $proceso = new Process([
            $programa,
            '--host='.$conexion['host'],
            '--port='.$conexion['port'],
            '--user='.$conexion['username'],
            '--single-transaction',
            '--skip-lock-tables',
            '--default-character-set=utf8mb4',
            $conexion['database'],
        ], base_path(), $entorno, null, 300);

        try {
            $proceso->run();
        } catch (Throwable $error) {
            Log::error('No se pudo iniciar mysqldump.', [
                'mensaje' => $error->getMessage(),
            ]);

            abort(500, 'No se pudo iniciar la copia de seguridad.');
        }

        if (!$proceso->isSuccessful()) {
            Log::error('mysqldump terminó con error.', [
                'codigo' => $proceso->getExitCode(),
                'detalle' => $proceso->getErrorOutput(),
            ]);

            abort(500, 'Falló la copia de seguridad. Revisa laravel.log.');
        }

        $nombre = 'respaldo_'
            .Str::slug($conexion['database'])
            .'_'
            .now()->format('Ymd_His')
            .'.sql';

        return response($proceso->getOutput(), 200, [
            'Content-Type' => 'application/sql; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="'.$nombre.'"',
        ]);
    }
}