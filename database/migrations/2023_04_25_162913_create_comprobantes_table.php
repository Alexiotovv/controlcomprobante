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
        Schema::create('comprobantes', function (Blueprint $table) {
            $table->id();
            $table->string('numero', 250)->unique()->default('');
            $table->date('fecha')->nullable();
            $table->string('nombre', 250)->default('');
            $table->decimal('importe', 10, 2)->nullable()->default(0.00);
            $table->string('siaf', 50)->nullable()->default('');
            $table->string('fuentefto', 20)->nullable()->default('');
            $table->string('folios', 50)->nullable()->default('');
            $table->string('estante', 50)->nullable()->default('');
            $table->string('paquete', 50)->nullable()->default('');
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
        Schema::dropIfExists('comprobantes');
    }
};
