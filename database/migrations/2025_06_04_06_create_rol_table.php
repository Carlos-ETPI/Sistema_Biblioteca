<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('ROL', function (Blueprint $table) {
            $table->unsignedInteger('ID_ROL')->autoIncrement()->primary();
            $table->string('DESC_ROL', 50);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ROL');
    }
};

