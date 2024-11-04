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
            $table->unsignedBigInteger('id_menu'); // Kolom untuk menu
            $table->integer('jumlah'); // Kolom untuk jumlah
            $table->decimal('total_harga', 10, 2);
            $table->decimal('nominal', 10, 2)->nullable(); // Menjadikan kolom nominal nullable
            $table->date('tanggal_transaksi'); // Kolom untuk tanggal transaksi
            $table->unsignedBigInteger('id_pelanggan')->nullable(); // Foreign key ke DataPelanggan
            $table->unsignedBigInteger('id_pengguna'); // Foreign key ke DataPengguna
            $table->string('kode_referal')->nullable(); // Kolom untuk kode referral
            $table->decimal('diskon', 10, 2)->nullable()->after('total_harga');
            $table->timestamps(); // Ini akan menambahkan kolom created_at dan updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('transaksi');
    }
}
