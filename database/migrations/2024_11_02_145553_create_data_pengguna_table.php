<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataPenggunaTable extends Migration
{
    public function up()
    {
        Schema::create('data_pengguna', function (Blueprint $table) {
            $table->id(); // Auto-increment ID
            $table->string('nama_pengguna');
            $table->string('alamat_pengguna');
            $table->string('noHP_pengguna');
            $table->unsignedBigInteger('id_role'); // Foreign key ke Role
            $table->foreign('id_role')->references('id')->on('role')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('data_pengguna');
    }
}
