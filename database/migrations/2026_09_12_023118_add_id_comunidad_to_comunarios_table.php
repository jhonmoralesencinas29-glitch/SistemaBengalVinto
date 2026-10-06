<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('comunarios', function (Blueprint $table) {
            $table->unsignedInteger('id_comunidad')
                ->default(1)
                ->after('id_usuario');

            $table->foreign('id_comunidad')
                ->references('id_comunidad')
                ->on('comunidades')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::table('comunarios', function (Blueprint $table) {
            $table->dropForeign(['id_comunidad']);
            $table->dropColumn('id_comunidad');
        });
    }
};