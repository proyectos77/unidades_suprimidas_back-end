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
        Schema::create('documento_general_fuid', function (Blueprint $table) {
            $table->unsignedInteger('id_documento_general')->autoIncrement();
            $table->unsignedInteger('id_caja_unidad_activa')->nullable();
            $table->foreign('id_caja_unidad_activa')->references('id_caja_unidad_activa')->on('cajas_unidad_activas')->onDelete('set null');
            $table->index('id_caja_unidad_activa');
            $table->string('nombre_documento_general');
            $table->string('url_documento')->nullable();
            $table->unsignedInteger('id_estado')->default(1);
            $table->foreign('id_estado')->references('id_estado')->on('estados')->onDelete('cascade');

            $table->datetime('fecha_creacion')->useCurrent();
            $table->datetime('fecha_actualizacion')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documento_general_fuid');
    }
};
