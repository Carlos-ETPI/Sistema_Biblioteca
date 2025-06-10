<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('CARNET', function (Blueprint $table) {
            $table->unsignedInteger('ID_CARNET')->autoIncrement()->primary();
            $table->string('CARNET', 50)->unique();
            $table->date('VENCIMIENTO_CARNET');
            $table->date('EXPEDICION_CARNET');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('CARNET');
    }
};
