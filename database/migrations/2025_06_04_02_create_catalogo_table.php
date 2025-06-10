<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('CATALOGO', function (Blueprint $table) {
            $table->integer('ID_CATALOGO')->autoIncrement()->primary(); // autoincremental
            $table->string('BIBLIOTECA_CATALOGO', 50);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('CATALOGO');
    }
};

