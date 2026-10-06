<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('comunarios', function (Blueprint $table) {
            $table->unsignedInteger('numero_comunidad')
                ->after('id_comunidad');

            $table->unique(
                ['id_comunidad', 'numero_comunidad'],
                'comunario_numero_comunidad_unico'
            );
        });
    }

    public function down(): void
    {
        Schema::table('comunarios', function (Blueprint $table) {
            $table->dropUnique(
                'comunario_numero_comunidad_unico'
            );

            $table->dropColumn('numero_comunidad');
        });
    }
};