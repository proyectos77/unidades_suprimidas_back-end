<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('archivo', function (Blueprint $table) {
            $table->unsignedInteger('id_archivo')->autoIncrement();
            $table->integer('numero_cajas_archivos');
            $table->integer('numero_carpetas_archivo');
            $table->date('numero_folios_archivo');
            $table->unsignedInteger('id_detalle');
            $table->foreign('id_detalle')->references('id_detalle')->on('detalle_unidad')->onDelete('cascade');
            $table->timestamp('fecha_creacion_archivo')->useCurrent();
            $table->timestamp('fecha_actualizacion_archivo')->useCurrent()->useCurrentOnUpdate();
            $table->unsignedInteger('id_estado')->default(1);
            $table->foreign('id_estado')->references('id_estado')->on('estados')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('archivo');
    }
};
