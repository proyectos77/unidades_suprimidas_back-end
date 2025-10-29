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
        Schema::create('archivo_unidades_activas', function (Blueprint $table) {
            $table->unsignedInteger('id_archivo_unidad_activa')->autoIncrement();
            $table->unsignedInteger('id_unidad');
            $table->foreign('id_unidad')->references('id_unidad')->on('unidades')->onDelete('cascade');
            $table->string('anio_registro_archivo_unidad_activa', 4);
            $table->string('seccion_archivo_unidad_activa');
            $table->unsignedInteger('id_serie')->nullable();
            $table->foreign('id_serie')->references('id_serie')->on('series')->onDelete('cascade');
            $table->unsignedInteger('id_subserie')->nullable();
            $table->foreign('id_subserie')->references('id_subserie')->on('subseries')->onDelete('cascade');
            $table->integer('cantidad_cajas_archivo_unidad_activa');
            $table->integer('cantidad_carpetas_archivo_unidad_activa');
            $table->integer('cantidad_otros_archivo_unidad_activa')->nullable();
            $table->string('descripcion_otro_archivo_unidad_activa', 200)->nullable();
            $table->integer('cantidad_tomos_archivo_unidad_activa')->nullable();
            $table->integer('cantidad_folios_archivo_unidad_activa');
            $table->decimal('porcentaje_archivo_unidad_activa', 10, 1)->nullable();
            $table->datetime('fecha_creacion_archivo_unidad_activa')->useCurrent();
            $table->datetime('fecha_actualizacion_archivo_unidad_activa')->useCurrent()->useCurrentOnUpdate();
            $table->unsignedInteger('id_estado')->default(1);
            $table->foreign('id_estado')->references('id_estado')->on('estados')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('archivo_unidades_activas');
    }
};
