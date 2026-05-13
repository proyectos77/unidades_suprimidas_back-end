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
        Schema::create('documentos_unidad_activas', function (Blueprint $table) {
            $table->unsignedInteger('id_unidad_activa')->autoIncrement();
            $table->unsignedInteger('id_carpeta_unidad_activa');
            $table->foreign('id_carpeta_unidad_activa')->references('id_carpeta_unidad_activa')->on('carpetas_unidad_activas')->onDelete('cascade');
            $table->string('numero_radicado');
            $table->date('fecha_elaboracion');
            $table->unsignedInteger('id_unidad');
            $table->foreign('id_unidad')->references('id_unidad')->on('unidades')->onDelete('cascade');
            $table->string('nombre_funcionario_destino');
            $table->string('asunto');
            $table->string('nombre_quien_firma');
            $table->string('cargo_quien_firma');
            $table->string('tipo_soporte');
            $table->string('cantidad_folios');
            $table->string('tipo_documental');
            $table->string('observaciones');
            $table->datetime('fecha_creacion_documento_unidad_activa')->useCurrent();
            $table->datetime('fecha_actualizacion_documento_unidad_activa')->useCurrent()->useCurrentOnUpdate();
            $table->unsignedInteger('id_estado')->default(1);
            $table->foreign('id_estado')->references('id_estado')->on('estados')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documentos_unidad_activas');
    }
};
