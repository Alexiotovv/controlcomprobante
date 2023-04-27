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
        Schema::create('devolucioncomprobantes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('salidacomprobantes_id')->unsigned();
            $table->foreign('salidacomprobantes_id')->references('id')->on('salidacomprobantes')->onDelete('cascade');
            $table->date('fecha_devolucion')->nullable();
            $table->time('hora_devolucion')->nullable();
            $table->bigInteger('usuario_id')->unsigned();
            $table->foreign('usuario_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('devolucioncomprobantes');
    }
};
