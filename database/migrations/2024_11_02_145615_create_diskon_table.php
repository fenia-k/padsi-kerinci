<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiskonTable extends Migration
{
    public function up()
    {
        Schema::create('diskon', function (Blueprint $table) {
            $table->id(); // Auto-increment ID
            $table->decimal('harga_diskon', 10, 2);
            $table->integer('batas_pemakaian');
            $table->unsignedBigInteger('id_pelanggan'); // Foreign key ke DataPelanggan
            $table->foreign('id_pelanggan')->references('id')->on('data_pelanggan')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('diskon');
    }
}
