<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('DETALLE_CONSULTA', function (Blueprint $table) {
            $table->unsignedInteger('ID_BIBLIOTECARIO');
            $table->unsignedInteger('ID_USUARIO');
            $table->string('TITULOS_DETALLECONSULTA', 100);
            $table->float('COSTO_DETALLECONSULTA');
            $table->date('FECHA_DETALLECONSULTA');

            $table->primary(['ID_BIBLIOTECARIO', 'ID_USUARIO']);

            $table->foreign('ID_BIBLIOTECARIO')
                ->references('ID_BIBLIOTECARIO')
                ->on('BIBLIOTECARIO')
                ->onUpdate('restrict')
                ->onDelete('restrict');

            $table->foreign('ID_USUARIO')
                ->references('ID_USUARIO')
                ->on('USUARIO')
                ->onUpdate('restrict')
                ->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('DETALLE_CONSULTA');
    }
};

