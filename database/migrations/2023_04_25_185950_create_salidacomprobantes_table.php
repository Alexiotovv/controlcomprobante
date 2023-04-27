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
        Schema::create('salidacomprobantes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('comprobantes_id')->unsigned();
            $table->foreign('comprobantes_id')->references('id')->on('comprobantes')->onDelete('cascade');
            $table->bigInteger('clientes_id')->unsigned();
            $table->string('numero_cargo', 100)->nullable()->default('');
            $table->foreign('clientes_id')->references('id')->on('clientes')->onDelete('cascade');
            $table->string('numero_oficio', 150)->nullable()->default('');
            $table->string('folios', 150)->nullable()->default('-');
            $table->date('fecha_salida')->nullable();
            $table->time('hora_salida')->nullable();
            $table->boolean('salida')->nullable()->default(true);
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
        Schema::dropIfExists('salidacomprobantes');
    }
};
