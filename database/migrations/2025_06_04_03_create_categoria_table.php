<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('CATEGORIA', function (Blueprint $table) {
            $table->integer('ID_CATEGORIA')->autoIncrement()->primary(); // autoincremental
            $table->string('NOM_CATEGORIA', 50);
            $table->string('DESCRIPCION_CATEGORIA', 150);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('CATEGORIA');
    }
};
