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
        Schema::create('permisos', function (Blueprint $table) {
            $table->unsignedInteger('id_permiso')->autoIncrement();
            $table->string('nombre_permiso');
            $table->string('descripcion_permiso');
            $table->timestamp('fecha_creacion_usuario')->useCurrent();
            $table->timestamp('fecha_actualizacion_usuario')->useCurrent()->useCurrentOnUpdate();
            $table->unsignedInteger('id_estado');
            $table->foreign('id_estado')->references('id_estado')->on('estados')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permisos');
    }
};
