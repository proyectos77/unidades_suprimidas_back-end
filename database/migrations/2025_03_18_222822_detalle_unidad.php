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
        Schema::create('detalle_unidad', function (Blueprint $table) {
            $table->unsignedInteger('id_detalle')->autoIncrement();
            $table->string('acto_administrativo_creacion_detalle', 100);
            $table->string('acto_administrativo_desactivacion_detalle', 100);
            $table->date('fecha_creacion_unidad_detalle');
            $table->date('fecha_desactivacion_unidad_detalle');
            $table->string('puesto_mando_adelantado_detalle');
            $table->string('puesto_mando_atrasado_detalle');
            $table->string('plan_reorganizacion_diorg_detalle');
            $table->text('observacion_detalle');
            $table->unsignedInteger('id_unidad')->default(1);
            $table->foreign('id_unidad')->references('id_unidad')->on('unidades')->onDelete('cascade');
            $table->datetime('fecha_creacion_detalle')->useCurrent();
            $table->datetime('fecha_actualizacion_detalle')->useCurrent()->useCurrentOnUpdate();
            $table->unsignedInteger('id_estado')->default(1);
            $table->foreign('id_estado')->references('id_estado')->on('estados')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_unidad');
    }
};
