<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('PERSONA', function (Blueprint $table) {
            $table->unsignedInteger('ID_PERSONA')->autoIncrement();
            $table->string('NOMBRE_PERSONA', 50);
            $table->string('APELLIDO_PERSONA', 50);
            $table->date('NACIMIENTO_PERSONA');
            $table->string('TELEFONO_PERSONA', 10);
            $table->string('DUI_PERSONA', 10)->unique();
            $table->timestamps();

            //$table->primary(['ID_PERSONA', 'DUI_PERSONA']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('PERSONA');
    }
};
