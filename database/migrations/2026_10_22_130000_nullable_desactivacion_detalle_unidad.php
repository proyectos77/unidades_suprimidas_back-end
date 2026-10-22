<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Los datos de desactivacion son opcionales al registrar/actualizar el detalle
        DB::statement('ALTER TABLE detalle_unidad MODIFY acto_administrativo_desactivacion_detalle TEXT NULL');
        DB::statement('ALTER TABLE detalle_unidad MODIFY fecha_desactivacion_unidad_detalle DATE NULL');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('ALTER TABLE detalle_unidad MODIFY acto_administrativo_desactivacion_detalle TEXT NOT NULL');
        DB::statement('ALTER TABLE detalle_unidad MODIFY fecha_desactivacion_unidad_detalle DATE NOT NULL');
    }
};
