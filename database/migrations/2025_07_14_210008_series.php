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
        Schema::create('series', function (Blueprint $table) {
            $table->unsignedInteger('id_serie')->autoIncrement();
            $table->text('nombre_serie');
            $table->integer('codigo_serie');
            $table->integer('anio_inicio_serie');
            $table->integer('anio_fin_serie');
            $table->datetime('fecha_creacion_serie')->useCurrent();
            $table->datetime('fecha_actualizacion_serie')->useCurrent()->useCurrentOnUpdate();
            $table->unsignedInteger('id_estado')->default(1);
            $table->foreign('id_estado')->references('id_estado')->on('estados')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('series');
    }
};
