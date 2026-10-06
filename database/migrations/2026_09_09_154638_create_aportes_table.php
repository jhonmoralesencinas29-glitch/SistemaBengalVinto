<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('aportes', function (Blueprint $table) {
            $table->increments('id_aporte');
            $table->unsignedInteger('id_tipo_aporte');
            $table->string('concepto', 150);
            $table->decimal('monto', 10, 2);
            $table->date('fecha_creacion');
            $table->date('fecha_vencimiento');
            $table->string('estado', 20);

            $table->foreign('id_tipo_aporte')
                ->references('id_tipo_aporte')
                ->on('tipos_aportes')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('aportes');
    }
};