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
        Schema::create('transferencias', function (Blueprint $table) {
            $table->unsignedInteger('id_transferencia')->autoIncrement();
            $table->integer('cantidad_cajas_transferencia');
            $table->integer('cantidad_carpetas_transferencia');
            $table->integer('cantidad_folios_transferencia');
            $table->string('porcentaje_transferencia');
            $table->unsignedInteger('id_archivo');
            $table->foreign('id_archivo')->references('id_archivo')->on('archivo')->onDelete('cascade');
            $table->datetime('fecha_creacion_transferencia')->useCurrent();
            $table->datetime('fecha_actualizacion_transferencia')->useCurrent()->useCurrentOnUpdate();
            $table->unsignedInteger('id_estado')->default(1);
            $table->foreign('id_estado')->references('id_estado')->on('estados')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transferencias');
    }
};



