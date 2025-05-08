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
        Schema::create('documentos', function (Blueprint $table) {
            $table->unsignedInteger('id_documento')->autoIncrement();
            $table->string('nombre_documento');
            $table->string('url_documento');
            $table->string('extension_documento');
            $table->string('tipo_documento');
            $table->timestamp('fecha_creacion_documentos')->useCurrent();
            $table->timestamp('fecha_actualizacion_documentos')->useCurrent()->useCurrentOnUpdate();
            $table->unsignedInteger('id_estado')->default(1);
            $table->foreign('id_estado')->references('id_estado')->on('estados')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documentos');
    }
};
