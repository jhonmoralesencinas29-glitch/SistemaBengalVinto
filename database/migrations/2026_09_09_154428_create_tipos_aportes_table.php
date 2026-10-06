<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tipos_aportes', function (Blueprint $table) {
            $table->increments('id_tipo_aporte');
            $table->string('nombre', 100)->unique();
            $table->string('descripcion', 200)->nullable();
            $table->boolean('estado')->default(true);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tipos_aportes');
    }
};