<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('aportes_comunidades', function (Blueprint $table) {
            $table->increments('id_aporte_comunidad');
            $table->unsignedInteger('id_aporte');
            $table->unsignedInteger('id_comunidad');
            $table->decimal('monto', 10, 2);

            $table->foreign('id_aporte')
                ->references('id_aporte')
                ->on('aportes')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('id_comunidad')
                ->references('id_comunidad')
                ->on('comunidades')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $table->unique(
                ['id_aporte', 'id_comunidad'],
                'aporte_comunidad_unico'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('aportes_comunidades');
    }
};