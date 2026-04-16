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
        Schema::create('baldas', function (Blueprint $table) {
            $table->unsignedInteger('id_balda')->autoIncrement();
            $table->string('nombre_balda');
            $table->unsignedInteger('id_estante');
            $table->foreign('id_estante')->references('id_estante')->on('estantes')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('baldas');
    }
};
