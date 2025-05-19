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
        Schema::create('solicitud_transferencias', function (Blueprint $table) {
            $table->unsignedInteger('id_solicitud_transferencia')->autoIncrement();
            $table->unsignedInteger('id_transferencia');
            $table->foreign('id_transferencia')->references('id_transferencia')->on('transferencias')->onDelete('cascade')->name('sol_trans_transferencia_fk');
            $table->date('fecha_inicio_solicitud_transferencia');
            $table->unsignedInteger('id_usuario_solicitante_solicitud_transferencia');
            $table->foreign('id_usuario_solicitante_solicitud_transferencia')->references('id_usuario')->on('usuarios')->onDelete('cascade')->name('sol_trans_usuario_solicitante_fk');
            $table->unsignedInteger('estado_solicitud_transferencia');
            $table->foreign('estado_solicitud_transferencia')->references('id_estado')->on('estados')->onDelete('cascade')->name('sol_trans_estado_fk');
            $table->unsignedInteger('id_usuario_revisor_solicitud_transferencia')->nullable();
            $table->foreign('id_usuario_revisor_solicitud_transferencia')->references('id_usuario')->on('usuarios')->onDelete('cascade')->name('sol_trans_usuario_revisor_fk');
            $table->date('fecha_fin_solicitud_transferencia')->nullable();
            $table->string('observacion_solicitud_transferencia')->nullable();
             $table->timestamp('fecha_creacion_solicitud_transferencia')->useCurrent();
            $table->timestamp('fecha_actualizacion_solicitud_transferencia')->useCurrent()->useCurrentOnUpdate();
            $table->unsignedInteger('id_estado')->default(1);
            $table->foreign('id_estado')->references('id_estado')->on('estados')->onDelete('cascade')->name('sol_trans_estado_general_fk');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solicitud_transferencias');
    }
};
