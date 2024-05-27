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
        Schema::table('comprobantes', function (Blueprint $table) {
            $table->integer('itemfile')->nullable()->default(0);
            $table->string('tipodocumento', 250)->nullable()->default('');
            $table->string('medio', 1000)->nullable()->default('');
            $table->text('descripcion');
            $table->string('observacion', 500)->nullable()->default('');
            $table->string('estado', 500)->nullable()->default('');
            $table->string('anhoinventario', 5)->nullable()->default('');
            $table->string('rofidei', 250)->nullable()->default('');
            
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('comprobantes', function (Blueprint $table) {
            
            $table->dropColumn('itemfile');
            $table->dropColumn('tipodocumento');
            $table->dropColumn('medio');
            $table->dropColumn('descripcion');
            $table->dropColumn('observacion');
            $table->dropColumn('estado');
            $table->dropColumn('anhoinventario');
            $table->dropColumn('rofidei');
        });
    }
};
