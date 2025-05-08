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
        Schema::create('documentos_transferencias', function (Blueprint $table) {
            $table->unsignedInteger('id_documento_transferencia')->autoIncrement();
            $table->unsignedInteger('id_documento');
            $table->foreign('id_documento')->references('id_documento')->on('documentos')->onDelete('cascade');
            $table->unsignedInteger('id_transferencia');
            $table->foreign('id_transferencia')->references('id_transferencia')->on('transferencias')->onDelete('cascade');
            $table->unsignedInteger('id_estado')->default(1);
            $table->foreign('id_estado')->references('id_estado')->on('estados')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documentos_transferencias');
    }
};
