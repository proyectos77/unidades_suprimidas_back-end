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
        Schema::create('detalle_documento_general_fuid', function (Blueprint $table) {
            $table->unsignedInteger('id_detalle_documento_general')->autoIncrement();
            $table->unsignedInteger('id_documento_general');
            $table->foreign('id_documento_general')->references('id_documento_general')->on('documento_general_fuid')->onDelete('cascade');
            $table->index('id_documento_general');
            $table->unsignedInteger('id_carpeta_unidad_activa')->nullable();
            $table->foreign('id_carpeta_unidad_activa')->references('id_carpeta_unidad_activa')->on('carpetas_unidad_activas')->onDelete('set null');
            $table->index('id_carpeta_unidad_activa');
            $table->unsignedInteger('numero_orden');
            $table->unsignedInteger('codigo');
            $table->string('nombre_serie_subserie_asunto');
            $table->date('fecha_extrema_inicio');
            $table->date('fecha_extrema_fin');
            $table->string('numero_caja');
            $table->string('numero_carpeta');
            $table->string('numero_tomo');
            $table->string('numero_otro');
            $table->string('numero_folios');
            $table->string('numero_soporte');
            $table->string('numero_frecuencia_consulta');
            $table->text('notas');
            $table->unsignedInteger('id_estado')->default(1);
            $table->foreign('id_estado')->references('id_estado')->on('estados')->onDelete('cascade');
            $table->datetime('fecha_creacion')->useCurrent();
            $table->datetime('fecha_actualizacion')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_documento_general_fuid');
    }
};
