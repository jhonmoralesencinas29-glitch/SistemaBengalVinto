<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('comprobantes', function (Blueprint $table) {
            $table->increments('id_comprobante');
            $table->unsignedInteger('id_pago')->unique();
            $table->string('numero_comprobante', 50)->unique();
            $table->dateTime('fecha_emision');

            $table->foreign('id_pago')
                ->references('id_pago')
                ->on('pagos')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('comprobantes');
    }
};