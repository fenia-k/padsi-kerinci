<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuTable extends Migration
{
    public function up()
    {
        Schema::create('menu', function (Blueprint $table) {
            $table->id(); // Auto-increment ID
            $table->string('nama_menu');
            $table->decimal('harga_menu', 10, 2);
            $table->integer('jumlah_menu');
            $table->string('deskripsi_menu');
            $table->string('gambar_menu');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('menu');
    }
}
