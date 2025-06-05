<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('FORMULARIO', function (Blueprint $table) {
            $table->increments('ID_FORMULARIO'); // PK autoincremental

            $table->unsignedInteger('ID_USUARIO');
            $table->unsignedInteger('ID_BIBLIOTECARIO');
            $table->integer('APROBACION_FORMULARIO');
            $table->string('COMENTARIOS', 150)->nullable();

            $table->foreign('ID_USUARIO')
                  ->references('ID_USUARIO')
                  ->on('USUARIO')
                  ->onUpdate('restrict')
                  ->onDelete('restrict');

            $table->foreign('ID_BIBLIOTECARIO')
                  ->references('ID_BIBLIOTECARIO')
                  ->on('BIBLIOTECARIO')
                  ->onUpdate('restrict')
                  ->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('FORMULARIO');
    }
};


