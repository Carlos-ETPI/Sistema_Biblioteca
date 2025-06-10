<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('TITULOAUTOR', function (Blueprint $table) {
            $table->integer('ID_TITULO');
            $table->integer('ID_AUTOR');
            $table->timestamps();

            $table->primary(['ID_TITULO', 'ID_AUTOR']);

            $table->foreign('ID_TITULO')
                  ->references('ID_TITULO')
                  ->on('TITULO')
                  ->onUpdate('restrict')
                  ->onDelete('restrict');

            $table->foreign('ID_AUTOR')
                  ->references('ID_AUTOR')
                  ->on('AUTOR')
                  ->onUpdate('restrict')
                  ->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('TITULO_AUTOR');
    }
};

