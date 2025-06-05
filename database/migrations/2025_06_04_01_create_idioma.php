<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('IDIOMA', function (Blueprint $table) {
            $table->integer('ID_IDIOMA')->autoIncrement()->primary(); // lo hacemos autoincremental
            $table->string('IDIOMA', 50)->nullable(); // el campo puede ser nulo
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('IDIOMA');
    }
};

