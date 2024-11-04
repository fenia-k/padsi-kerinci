<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStokTable extends Migration
{
    public function up()
    {
        Schema::create('stok', function (Blueprint $table) {
            $table->id(); // Auto-increment ID
            $table->string('nama_stok');
            $table->integer('jumlah_stok');
            $table->decimal('harga_menu', 10, 2);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('stok');
    }
}
