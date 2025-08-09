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
        Schema::create('dependencias', function (Blueprint $table) {
            $table->unsignedInteger('id_dependencia')->autoIncrement();
            $table->string('nombre_dependencia');
            $table->string('sigla_dependencia');
            $table->integer('padre_dependencia')->nullable();
            $table->datetime('fecha_creacion_dependencia')->useCurrent();
            $table->datetime('fecha_actualizacion_dependencia')->useCurrent()->useCurrentOnUpdate();
            $table->unsignedInteger('id_estado')->default(1);
            $table->foreign('id_estado')->references('id_estado')->on('estados')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dependencias');
    }
};
