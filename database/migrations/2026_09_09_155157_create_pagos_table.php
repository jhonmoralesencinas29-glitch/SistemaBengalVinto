<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pagos', function (Blueprint $table) {
            $table->increments('id_pago');
            $table->unsignedInteger('id_aporte_comunario');
            $table->unsignedInteger('id_usuario');
            $table->decimal('monto_pagado', 10, 2);
            $table->dateTime('fecha_pago');

            $table->foreign('id_aporte_comunario')
                ->references('id_aporte_comunario')
                ->on('aportes_comunarios')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $table->foreign('id_usuario')
                ->references('id_usuario')
                ->on('usuarios')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pagos');
    }
};