<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('COSTO_PRESTA', function (Blueprint $table) {
            $table->unsignedInteger('ID_COSTO_PRESTA')->autoIncrement()->primary();
            $table->float('COSTO_PRESTA');
            $table->float('MORA_PRESTA');
            $table->integer('ESTADO_CANCELADO');
            $table->float('MONTO_CANCELADO');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('COSTO_PRESTA');
    }
};

