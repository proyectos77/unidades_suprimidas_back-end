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
            $table->string('ubicacion_archivo_unidad_activa');
            $table->string('direccion_archivo_unidad_activa');
            $table->string('edificio_archivo_unidad_activa')->nullable();
            $table->string('piso_archivo_unidad_activa')->nullable();
            $table->string('bodega_archivo_unidad_activa')->nullable();
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
