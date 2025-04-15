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
        Schema::create('municipios', function (Blueprint $table) {
            $table->unsignedInteger('id_municipio')->autoIncrement();
            $table->string('nombre_municipio');
            $table->unsignedInteger('id_departamento')->default(1);
            $table->foreign('id_departamento')->references('id_departamento')->on('departamentos')->onDelete('cascade');
            $table->timestamp('fecha_creacion_municipio')->useCurrent();
            $table->timestamp('fecha_actualizacion_municipio')->useCurrent()->useCurrentOnUpdate();
            $table->unsignedInteger('id_estado')->default(1);
            $table->foreign('id_estado')->references('id_estado')->on('estados')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('municipios');
    }
};
