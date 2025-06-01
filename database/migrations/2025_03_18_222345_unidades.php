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
        Schema::create('unidades', function (Blueprint $table) {
            $table->unsignedInteger('id_unidad')->autoIncrement();
            $table->string('nombre_unidad');
            $table->string('sigla_unidad', 20);
            $table->string('unidad_que_asume_archivo_unidad');
            $table->unsignedInteger('id_municipio')->default(1);
            $table->foreign('id_municipio')->references('id_municipio')->on('municipios')->onDelete('cascade');
            $table->datetime('fecha_creacion_unidad')->useCurrent();
            $table->datetime('fecha_actualizacion_unidad')->useCurrent()->useCurrentOnUpdate();
            $table->unsignedInteger('id_estado')->default(1);
            $table->foreign('id_estado')->references('id_estado')->on('estados')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unidades');
    }
};
