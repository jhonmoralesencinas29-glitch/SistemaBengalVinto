<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reuniones', function (Blueprint $table) {
            $table->increments('id_reunion');
            $table->string('descripcion', 200);
            $table->date('fecha');
            $table->string('lugar', 150);
            $table->string('estado', 20);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reuniones');
    }
};