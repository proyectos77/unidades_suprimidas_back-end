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
        Schema::create('estados', function (Blueprint $table) {
            $table->unsignedInteger('id_estado')->autoIncrement();
            $table->string('nombre_estado');
            $table->string('descripcion_estado');
            $table->char('estado', 1)->default(1);
            $table->datetime('fecha_creacion_estado');
            $table->datetime('fecha_actualizacion_estado');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estados');
    }
};
