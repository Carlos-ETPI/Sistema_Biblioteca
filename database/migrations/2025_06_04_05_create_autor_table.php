<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('AUTOR', function (Blueprint $table) {
            $table->integer('ID_AUTOR')->autoIncrement()->primary();
            $table->string('NOM_AUTOR', 50);
            $table->string('APE_AUTOR', 50);
            $table->string('DESC_AUTOR', 150);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('AUTOR');
    }
};
