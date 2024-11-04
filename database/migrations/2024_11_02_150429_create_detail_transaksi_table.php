<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailTransaksiTable extends Migration
{
    public function up()
    {
        Schema::create('detail_transaksi', function (Blueprint $table) {
            $table->id(); // Auto-increment ID
            $table->unsignedBigInteger('id_transaksi'); // Foreign key ke Transaksi
            $table->unsignedBigInteger('id_menu'); // Foreign key ke Menu
            $table->integer('jumlah_pesanan');
            $table->decimal('sub_total', 10, 2);
            $table->decimal('harga_menu', 10, 2);
            $table->foreign('id_transaksi')->references('id')->on('transaksi')->onDelete('cascade');
            $table->foreign('id_menu')->references('id')->on('menu')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('detail_transaksi');
    }
}
