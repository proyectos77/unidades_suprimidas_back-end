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
        Schema::create('carpetas_unidad_activas', function (Blueprint $table) {
            $table->unsignedInteger('id_carpeta_unidad_activa')->autoIncrement();
            $table->unsignedInteger('id_caja_unidad_activa');
            $table->foreign('id_caja_unidad_activa')->references('id_caja_unidad_activa')->on('cajas_unidad_activas')->onDelete('cascade');
            $table->unsignedInteger('id_serie');
            $table->foreign('id_serie')->references('id_serie')->on('series')->onDelete('cascade');
            $table->unsignedInteger('id_subserie')->nullable();
            $table->foreign('id_subserie')->references('id_subserie')->on('subseries')->onDelete('cascade');
            $table->string('numero_carpeta_unidad_activa');
            $table->date('fecha_extrema_inicio');
            $table->date('fecha_extrema_fin');
            $table->string('cantidad_folios');
            $table->datetime('fecha_creacion_carpeta_unidad_activa')->useCurrent();
            $table->datetime('fecha_actualizacion_carpeta_unidad_activa')->useCurrent()->useCurrentOnUpdate();
            $table->unsignedInteger('id_estado')->default(1);
            $table->foreign('id_estado')->references('id_estado')->on('estados')->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carpetas_unidad_activas');
    }
};
