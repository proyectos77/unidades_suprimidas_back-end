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
         Schema::create('detalle_transferencia', function (Blueprint $table) {
            $table->unsignedInteger('id_detalle_transferencia')->autoIncrement();
            $table->unsignedInteger('id_transferencia');
            $table->foreign('id_transferencia')->references('id_transferencia')->on('transferencias')->onDelete('cascade');
            $table->string('seccion_detalle_transferencia');
            $table->unsignedInteger('id_serie')->nullable();
            $table->foreign('id_serie')->references('id_serie')->on('series')->onDelete('cascade');
            $table->unsignedInteger('id_subserie')->nullable();
            $table->foreign('id_subserie')->references('id_subserie')->on('subseries')->onDelete('cascade');
            $table->integer('cantidad_cajas_detalle_transferencia');
            $table->integer('cantidad_carpetas_detalle_transferencia');
            $table->integer('cantidad_otros_detalle_transferencia')->nullable();
            $table->string('descripcion_otro_detalle_transferencia', 200)->nullable();
            $table->integer('cantidad_tomos_detalle_transferencia')->nullable();
            $table->integer('cantidad_folios_detalle_transferencia');
            $table->decimal('porcentaje_detalle_transferencia', 10, 1);
            $table->datetime('fecha_creacion_detalle_transferencia')->useCurrent();
            $table->datetime('fecha_actualizacion_detalle_transferencia')->useCurrent()->useCurrentOnUpdate();
            $table->unsignedInteger('id_estado')->default(1);
            $table->foreign('id_estado')->references('id_estado')->on('estados')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_transferencia');
    }
};
