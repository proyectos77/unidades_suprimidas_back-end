<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('documento_general_fuid', function (Blueprint $table) {
            $table->unsignedInteger('id_carpeta_unidad_activa')->nullable()->after('id_documento_general');
            $table->foreign('id_carpeta_unidad_activa')->references('id_carpeta_unidad_activa')->on('carpetas_unidad_activas')->onDelete('set null');
            $table->index('id_carpeta_unidad_activa');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('documento_general_fuid', function (Blueprint $table) {
            $table->dropForeign(['id_carpeta_unidad_activa']);
            $table->dropIndex(['id_carpeta_unidad_activa']);
            $table->dropColumn('id_carpeta_unidad_activa');
        });
    }
};
