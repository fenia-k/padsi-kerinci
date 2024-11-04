<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataPelangganTable extends Migration
{
    public function up()
    {
        Schema::create('data_pelanggan', function (Blueprint $table) {
            $table->id(); // Auto-increment ID
            $table->string('nama_pelanggan');
            $table->string('alamat_pelanggan');
            $table->string('noHP_pelanggan');
            $table->string('kode_referal')->unique()->nullable(); // Menambahkan kolom kode_referal
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('data_pelanggan');
    }
}
