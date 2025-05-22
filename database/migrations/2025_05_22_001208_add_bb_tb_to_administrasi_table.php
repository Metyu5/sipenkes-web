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
        Schema::table('administrasi', function (Blueprint $table) {
             $table->float('bb')->nullable()->after('denyut_nadi'); // Berat badan (kg)
             $table->float('tb')->nullable()->after('bb');           // Tinggi badan (cm)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('administrasi', function (Blueprint $table) {
            $table->dropColumn(['bb', 'tb']);
        });
    }
};
