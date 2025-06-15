<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('CARNET', function (Blueprint $table) {
            if (!Schema::hasColumn('CARNET', 'created_by')) {
                $table->unsignedBigInteger('created_by')->nullable(); // quitamos el after
            }
            if (!Schema::hasColumn('CARNET', 'updated_by')) {
                $table->unsignedBigInteger('updated_by')->nullable();
            }
            if (!Schema::hasColumn('CARNET', 'created_at')) {
                $table->timestamp('created_at')->nullable();
            }
            if (!Schema::hasColumn('CARNET', 'updated_at')) {
                $table->timestamp('updated_at')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
       Schema::table('CARNET', function (Blueprint $table) {
            $table->dropColumn(['created_by', 'updated_by', 'created_at', 'updated_at']);
        });
    }
};
