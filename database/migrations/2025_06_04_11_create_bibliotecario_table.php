<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('BIBLIOTECARIO', function (Blueprint $table) {
            $table->unsignedInteger('ID_BIBLIOTECARIO')->autoIncrement()->primary();
            $table->integer('ID_CATALOGO');
            $table->string('NOMBRE_BIBLIOTECARIO', 50);
            $table->string('APELLIDO_BIBLIOTECARIO', 50);

            // Foreign key
            $table->foreign('ID_CATALOGO')
                  ->references('ID_CATALOGO')
                  ->on('CATALOGO')
                  ->onUpdate('restrict')
                  ->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('BIBLIOTECARIO');
    }
};

