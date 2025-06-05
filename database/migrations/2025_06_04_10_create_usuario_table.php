<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
Schema::create('USUARIO', function (Blueprint $table) {
    $table->unsignedInteger('ID_USUARIO')->autoIncrement()->primary();
    $table->unsignedInteger('ID_PERSONA');
    $table->unsignedInteger('ID_CARNET');
    $table->unsignedInteger('ID_ROL');
    $table->date('FECHAREGISTRO_USUARIO');
    $table->integer('ESTADO_USUARIO');

    $table->foreign(['ID_PERSONA'])
          ->references(['ID_PERSONA'])
          ->on('PERSONA')
          ->onUpdate('restrict')
          ->onDelete('restrict');

    $table->foreign('ID_CARNET')
          ->references('ID_CARNET')
          ->on('CARNET')
          ->onUpdate('restrict')
          ->onDelete('restrict');

    $table->foreign('ID_ROL')
          ->references('ID_ROL')
          ->on('ROL')
          ->onUpdate('restrict')
          ->onDelete('restrict');
});

    }

    public function down(): void
    {
        Schema::dropIfExists('USUARIO');
    }
};
