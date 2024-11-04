<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiTable extends Migration
{
    public function up()
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id(); // Auto-increment ID
            $table->decimal('total_harga', 10, 2);
            $table->decimal('nominal', 10, 2);
            $table->timestamp('tanggal_transaksi')->nullable();
            $table->unsignedBigInteger('id_pelanggan')->nullable(); // Foreign key ke DataPelanggan
            $table->unsignedBigInteger('id_pengguna'); // Foreign key ke DataPengguna
            $table->foreign('id_pelanggan')->references('id')->on('data_pelanggan')->onDelete('set null');
            $table->foreign('id_pengguna')->references('id')->on('data_pengguna')->onDelete('cascade');
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('transaksi');
    }
}
