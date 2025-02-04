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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->unsignedInteger('id_usuario')->autoIncrement();
            $table->string('nombre_usuario');
            $table->string('user_usuario');
            $table->string('email_usuario')->unique();
            $table->string('password_usuario');
            $table->rememberToken();
            $table->datetime('fecha_creacion_usuario');
            $table->datetime('fecha_actualizacion_usuario');
            $table->unsignedInteger('id_estado');
            $table->foreign('id_estado')->references('id_estado')->on('estados')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
