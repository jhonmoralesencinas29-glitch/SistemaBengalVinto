<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('asistencias', function (Blueprint $table) {
            $table->increments('id_asistencia');
            $table->unsignedInteger('id_reunion');
            $table->unsignedInteger('id_comunario');
            $table->string('estado_asistencia', 20);
            $table->string('observacion', 200)->nullable();

            $table->foreign('id_reunion')
                ->references('id_reunion')
                ->on('reuniones')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $table->foreign('id_comunario')
                ->references('id_comunario')
                ->on('comunarios')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $table->unique(
                ['id_reunion', 'id_comunario'],
                'asistencia_reunion_comunario_unica'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('asistencias');
    }
};