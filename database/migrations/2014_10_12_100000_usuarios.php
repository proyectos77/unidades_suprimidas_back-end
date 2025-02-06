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
            $table->string('identificacion_usuario');
            $table->string('email_usuario')->unique();
            $table->string('user_usuario');
            $table->string('password_usuario');
            $table->rememberToken();
            $table->timestamp('fecha_creacion_usuario')->useCurrent();
            $table->timestamp('fecha_actualizacion_usuario')->useCurrent()->useCurrentOnUpdate();
            $table->unsignedInteger('id_estado')->default(1);
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
