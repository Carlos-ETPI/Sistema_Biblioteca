<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
Schema::create('PRESTA', function (Blueprint $table) {
    $table->id('ID_PRESTA'); // equivale a unsigned big integer + auto_increment + primary
    $table->unsignedInteger('ID_EJEMPLAR');
    $table->unsignedInteger('ID_USUARIO');
    $table->unsignedInteger('ID_COSTO_PRESTA');
    $table->integer('ESTADO_PRESTA');
    $table->date('FECHA_PRESTA');
    $table->date('FECHA_DEVO');

    // Foreign keys
    $table->foreign('ID_EJEMPLAR')->references('ID_EJEMPLAR')->on('EJEMPLAR')->onUpdate('restrict')->onDelete('restrict');
    $table->foreign('ID_USUARIO')->references('ID_USUARIO')->on('USUARIO')->onUpdate('restrict')->onDelete('restrict');
    $table->foreign('ID_COSTO_PRESTA')->references('ID_COSTO_PRESTA')->on('COSTO_PRESTA')->onUpdate('restrict')->onDelete('restrict');
});

    }

    public function down(): void
    {
        Schema::dropIfExists('PRESTA');
    }
};

