<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('reuniones', function (Blueprint $table) {
            $table->text('descripcion')->change();
        });
    }

    public function down(): void
    {
        Schema::table('reuniones', function (Blueprint $table) {
            $table->string('descripcion', 200)->change();
        });
    }
};