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
        Schema::create('cajas_unidad_activas', function (Blueprint $table) {
            $table->unsignedInteger('id_caja_unidad_activa')->autoIncrement();
            $table->unsignedInteger('id_archivo_unidad_activa');
            $table->foreign('id_archivo_unidad_activa')->references('id_archivo_unidad_activa')->on('archivo_unidades_activas')->onDelete('cascade');
            $table->unsignedInteger('id_balda');
            $table->foreign('id_balda')->references('id_balda')->on('baldas')->onDelete('cascade');
            $table->string('codigo_caja_unidad_activa', 100);
            $table->string('numero_consecutivo_bodega_unidad_activa', 100);
            $table->string('numero_correlativo_dependencia_unidad_activa', 100);
            $table->string('anio_caja_unidad_activa', 100);
            $table->string('cantidad_libros_unidad_activa', 100);
            $table->string('cantidad_carpetas_unidad_activa', 100);
            $table->datetime('fecha_creacion_caja_unidad_activa')->useCurrent();
            $table->datetime('fecha_actualizacion_caja_unidad_activa')->useCurrent()->useCurrentOnUpdate();
            $table->unsignedInteger('id_estado')->default(1);
            $table->foreign('id_estado')->references('id_estado')->on('estados')->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cajas_unidad_activas');
    }
};
