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
        DB::statement('ALTER TABLE detalle_documento_general_fuid MODIFY nombre_serie_subserie_asunto TEXT NOT NULL');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('ALTER TABLE detalle_documento_general_fuid MODIFY nombre_serie_subserie_asunto VARCHAR(255) NOT NULL');
    }
};
