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
        Schema::table('laporan', function (Blueprint $table) {
            // Drop foreign key constraint dulu
            $table->dropForeign('laporan_dokter_id_foreign');
            // Hapus kolom dokter_id
            $table->dropColumn('dokter_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('laporan', function (Blueprint $table) {
            // Balikin kolom dokter_id
            $table->bigInteger('dokter_id')->unsigned()->after('id');
            // Balikin foreign key-nya
            $table->foreign('dokter_id')->references('id')->on('dokters')->onDelete('cascade');
        });
    }
};
