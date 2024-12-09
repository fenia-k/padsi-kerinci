<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiTable extends Migration
{
    public function up()
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id(); // ID auto-increment
            $table->integer('jumlah')->default(0); // Kolom untuk jumlah, default 0
            $table->decimal('total_harga', 10, 2); // Kolom total_harga
            $table->decimal('nominal', 10, 2)->nullable(); // Menjadikan kolom nominal nullable
            $table->integer('poin_digunakan')->nullable()->default(0); // Kolom poin_digunakan, nullable dan default 0
            $table->date('tanggal_transaksi'); // Kolom untuk tanggal transaksi
            $table->unsignedBigInteger('id_pelanggan')->nullable(); // Foreign key ke DataPelanggan
            $table->unsignedBigInteger('id_pengguna'); // Foreign key ke DataPengguna
            $table->string('kode_referal')->nullable(); // Kolom kode_referal
            $table->timestamps(); // Kolom created_at dan updated_at

            // Tambahkan foreign key untuk integritas data
            $table->foreign('id_pelanggan')->references('id')->on('data_pelanggan')->onDelete('set null');
            $table->foreign('id_pengguna')->references('id')->on('data_pengguna')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('transaksi');
    }
}
