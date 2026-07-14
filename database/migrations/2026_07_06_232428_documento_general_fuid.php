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
        Schema::create('documento_general_fuid', function (Blueprint $table) {
            $table->unsignedInteger('id_documento_general')->autoIncrement();
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
            $table->string('notas');
            $table->string('url_documento');
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
        Schema::dropIfExists('documento_general_fuid');
    }
};
