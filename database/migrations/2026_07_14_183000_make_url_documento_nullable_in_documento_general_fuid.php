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
        Schema::table('documento_general_fuid', function (Blueprint $table) {
            $table->string('url_documento')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('documento_general_fuid', function (Blueprint $table) {
            $table->string('url_documento')->nullable(false)->change();
        });
    }
};
