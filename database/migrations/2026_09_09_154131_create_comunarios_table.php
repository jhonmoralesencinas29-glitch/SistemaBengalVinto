<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('comunarios', function (Blueprint $table) {
            $table->increments('id_comunario');
            $table->unsignedInteger('id_usuario')->unique();
            $table->string('ci', 20)->unique();
            $table->string('nombres', 100);
            $table->string('apellidos', 100);
            $table->string('telefono', 20)->nullable();
            $table->string('direccion', 150)->nullable();
            $table->boolean('estado')->default(true);

            $table->foreign('id_usuario')
                ->references('id_usuario')
                ->on('usuarios')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('comunarios');
    }
};