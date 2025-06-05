<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('EJEMPLAR', function (Blueprint $table) {
            $table->unsignedInteger('ID_EJEMPLAR')->autoIncrement()->primary();
            $table->integer('ID_TITULO');
            $table->integer('ESTADO_EJEMPLAR');

            $table->foreign('ID_TITULO')
                  ->references('ID_TITULO')
                  ->on('TITULO')
                  ->onUpdate('restrict')
                  ->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('EJEMPLAR');
    }
};

