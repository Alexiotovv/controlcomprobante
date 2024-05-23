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
        Schema::create('tempssalidacomprobantes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_comprobante');
            $table->string('numerocomprobante', 250)->default('');
            $table->string('fecha', 250)->default('');
            $table->string('nombreempresa', 250)->default('');
            $table->string('importe', 250)->default('');
            $table->string('siaf', 250)->default('');
            $table->string('ftefto', 250)->default('');
            $table->string('folio', 250)->default('');
            $table->string('estante', 250)->default('');
            $table->string('paquete', 250)->default('');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tempssalidacomprobantes');
    }
};
