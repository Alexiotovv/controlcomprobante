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
        Schema::create('comprobantesarchivos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_comprobantes')->unsigned();
            $table->foreign('id_comprobantes')->references('id')->on('comprobantes')->onDelete('cascade');
            $table->string('nombrearchivo', 255)->default('');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comprobantesarchivos');
    }
};
