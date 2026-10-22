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
        Schema::create('documentacion_sistema', function (Blueprint $table) {
            $table->unsignedInteger('id_documento_sistema')->autoIncrement();
            $table->string('nombre_documento_sistema');
            $table->text('descripcion_documento_sistema')->nullable();
            $table->unsignedInteger('id_tipo_documentacion_sistema')->nullable();
            $table->foreign('id_tipo_documentacion_sistema')->references('id_tipo_documentacion_sistema')->on('tipos_documentacion_sistema')->onDelete('set null');
            $table->string('ruta_documento_sistema')->nullable();
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
        Schema::dropIfExists('documentacion_sistema');
    }
};
