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
        Schema::create('transaksi_penjualan', function (Blueprint $table) {
            $table->string('NOMOR_FAKTUR', 10)->primary();
            $table->string('ID_PELANGGAN', 10);
            $table->integer('ID_RUJUKAN')->nullable();
            $table->string('ID_PENGGUNA', 10);
            $table->datetime('TANGGAL_PENJUALAN');
            $table->float('TOTAL_HARGA');
            $table->timestamps();
    
            $table->foreign('ID_PELANGGAN')->references('ID_PELANGGAN')->on('data_pelanggan');
            $table->foreign('ID_PENGGUNA')->references('ID_PENGGUNA')->on('data_pengguna');
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_penjualan');
    }
};
