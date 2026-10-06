<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('aportes_comunarios', function (Blueprint $table) {
            $table->decimal('monto_asignado', 10, 2)
                ->default(0)
                ->after('id_comunario');
        });

        DB::table('aportes_comunarios')->update([
            'monto_asignado' => DB::raw('saldo'),
        ]);
    }

    public function down(): void
    {
        Schema::table('aportes_comunarios', function (Blueprint $table) {
            $table->dropColumn('monto_asignado');
        });
    }
};