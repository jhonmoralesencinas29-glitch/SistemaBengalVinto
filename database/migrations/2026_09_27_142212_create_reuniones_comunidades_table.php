<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create(
            'reuniones_comunidades',
            function (Blueprint $table) {
                $table->increments(
                    'id_reunion_comunidad'
                );

                $table->unsignedInteger('id_reunion');
                $table->unsignedInteger('id_comunidad');

                $table->foreign('id_reunion')
                    ->references('id_reunion')
                    ->on('reuniones')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

                $table->foreign('id_comunidad')
                    ->references('id_comunidad')
                    ->on('comunidades')
                    ->onUpdate('cascade')
                    ->onDelete('restrict');

                $table->unique(
                    [
                        'id_reunion',
                        'id_comunidad',
                    ],
                    'reunion_comunidad_unica'
                );
            }
        );
    }

    public function down(): void
    {
        Schema::dropIfExists(
            'reuniones_comunidades'
        );
    }
};