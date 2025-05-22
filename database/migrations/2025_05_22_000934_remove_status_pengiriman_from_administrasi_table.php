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
            $table->dropColumn('status_pengiriman');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('administrasi', function (Blueprint $table) {
           $table->enum('status_pengiriman', ['Belum', 'Sudah'])->default('Belum');
        });
    }
};
