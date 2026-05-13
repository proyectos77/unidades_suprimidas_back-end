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
         Schema::create('tipos_documentales', function (Blueprint $table) {
            $table->unsignedInteger('id_tipo_documental')->autoIncrement();
            $table->string('nombre_tipo_documental');

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tipos_documentales');
    }
};
