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
        Schema::create('subseries', function (Blueprint $table) {
            $table->unsignedInteger('id_subserie')->autoIncrement();
            $table->integer('codigo_subserie');
            $table->text('nombre_subserie');
            $table->unsignedInteger('id_serie')->default(1);
            $table->foreign('id_serie')->references('id_serie')->on('series')->onDelete('cascade');
            $table->datetime('fecha_creacion_subserie')->useCurrent();
            $table->datetime('fecha_actualizacion_subserie')->useCurrent()->useCurrentOnUpdate();
            $table->unsignedInteger('id_estado')->default(1);
            $table->foreign('id_estado')->references('id_estado')->on('estados')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subseries');
    }
};
