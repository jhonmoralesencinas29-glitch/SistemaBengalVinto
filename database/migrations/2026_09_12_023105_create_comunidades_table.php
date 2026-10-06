<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('comunidades', function (Blueprint $table) {
            $table->increments('id_comunidad');
            $table->string('nombre', 100)->unique();
            $table->string('descripcion', 200)->nullable();
            $table->boolean('estado')->default(true);
        });

        DB::table('comunidades')->insert([
            [
                'id_comunidad' => 1,
                'nombre' => 'Bengal Vinto',
                'descripcion' => 'Comunidad central del Cantón Bengal Vinto',
                'estado' => true,
            ],
            [
                'id_comunidad' => 2,
                'nombre' => 'Loma',
                'descripcion' => null,
                'estado' => true,
            ],
            [
                'id_comunidad' => 3,
                'nombre' => 'Totorani',
                'descripcion' => null,
                'estado' => true,
            ],
            [
                'id_comunidad' => 4,
                'nombre' => 'Achuata',
                'descripcion' => null,
                'estado' => true,
            ],
            [
                'id_comunidad' => 5,
                'nombre' => 'Cilupata',
                'descripcion' => null,
                'estado' => true,
            ],
            [
                'id_comunidad' => 6,
                'nombre' => 'Peña Blanca',
                'descripcion' => null,
                'estado' => true,
            ],
            [
                'id_comunidad' => 7,
                'nombre' => 'Huaylla',
                'descripcion' => null,
                'estado' => true,
            ],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('comunidades');
    }
};