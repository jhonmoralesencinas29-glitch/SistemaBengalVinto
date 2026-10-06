<?php

namespace Database\Seeders;

use App\Models\Usuario;
use Illuminate\Database\Seeder;

class UsuarioAdministradorSeeder extends Seeder
{
    public function run(): void
    {
        Usuario::updateOrCreate(
            ['usuario' => 'admin'],
            [
                'nombre_completo' => 'Administrador del sistema',
                'contrasena' => 'Admin123*',
                'rol' => 'administrador',
                'estado' => true,
            ]
        );
    }
}