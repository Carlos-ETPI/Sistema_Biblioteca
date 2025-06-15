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
    Schema::table('USUARIO', function (Blueprint $table) {
        if (!Schema::hasColumn('USUARIO', 'created_by')) {
            $table->unsignedBigInteger('created_by')->nullable()->after('ESTADO_USUARIO');
        }
        if (!Schema::hasColumn('USUARIO', 'updated_by')) {
            $table->unsignedBigInteger('updated_by')->nullable()->after('created_by');
        }
        if (!Schema::hasColumn('USUARIO', 'created_at') && !Schema::hasColumn('USUARIO', 'updated_at')) {
            $table->timestamps();
        }
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('USUARIO', function (Blueprint $table) {
            $table->dropColumn(['created_by', 'updated_by', 'created_at', 'updated_at']);
        });
    }
};
