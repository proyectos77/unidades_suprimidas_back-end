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
        Schema::create('tipo_usuarios_permisos', function (Blueprint $table) {
            $table->unsignedInteger('id_tipo_usuario_permisos')->autoIncrement();
            $table->unsignedInteger('id_tipo_usuario');
            $table->foreign('id_tipo_usuario')->references('id_tipo_usuario')->on('tipo_usuarios')->onDelete('cascade');
            $table->unsignedInteger('id_permiso');
            $table->foreign('id_permiso')->references('id_permiso')->on('permisos')->onDelete('cascade');
            $table->datetime('fecha_creacion_tipo_usuario_permiso');
            $table->datetime('fecha_actualizacion_tipo_usuario_permiso');
            $table->unsignedInteger('id_estado');
            $table->foreign('id_estado')->references('id_estado')->on('estados')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

    }
};
