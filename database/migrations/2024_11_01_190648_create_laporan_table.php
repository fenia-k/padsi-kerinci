<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('laporan', function (Blueprint $table) {
            $table->string('ID_LAPORAN', 10)->primary();
            $table->string('NOMOR_FAKTUR', 10);
            $table->string('JENIS_LAPORAN', 50);
            $table->date('TANGGAL_LAPORAN');
            $table->timestamps();
    
            $table->foreign('NOMOR_FAKTUR')->references('NOMOR_FAKTUR')->on('transaksi_penjualan');
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan');
    }
};
