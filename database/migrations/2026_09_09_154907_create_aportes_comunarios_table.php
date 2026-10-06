<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('aportes_comunarios', function (Blueprint $table) {
            $table->increments('id_aporte_comunario');
            $table->unsignedInteger('id_aporte');
            $table->unsignedInteger('id_comunario');
            $table->decimal('saldo', 10, 2);
            $table->string('estado_pago', 20)->default('pendiente');

            $table->foreign('id_aporte')
                ->references('id_aporte')
                ->on('aportes')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $table->foreign('id_comunario')
                ->references('id_comunario')
                ->on('comunarios')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $table->unique(
                ['id_aporte', 'id_comunario'],
                'aporte_comunario_unico'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('aportes_comunarios');
    }
};