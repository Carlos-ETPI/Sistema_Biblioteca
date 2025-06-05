<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('TITULO', function (Blueprint $table) {
            $table->integer('ID_TITULO')->autoIncrement()->primary();
            $table->integer('ID_CATALOGO');
            $table->integer('ID_CATEGORIA');
            $table->integer('ID_IDIOMA');
            $table->string('NOMBRE_TITULO', 50);
            $table->string('ISBN_TITULO', 50);

            $table->foreign('ID_CATALOGO')
                  ->references('ID_CATALOGO')
                  ->on('CATALOGO')
                  ->onUpdate('restrict')
                  ->onDelete('restrict');

            $table->foreign('ID_CATEGORIA')
                  ->references('ID_CATEGORIA')
                  ->on('CATEGORIA')
                  ->onUpdate('restrict')
                  ->onDelete('restrict');

            $table->foreign('ID_IDIOMA')
                  ->references('ID_IDIOMA')
                  ->on('IDIOMA')
                  ->onUpdate('restrict')
                  ->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('TITULO');
    }
};

