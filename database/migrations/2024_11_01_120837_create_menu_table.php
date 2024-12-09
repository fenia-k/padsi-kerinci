<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuTable extends Migration
{
    /**
     * Menjalankan migrasi.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu', function (Blueprint $table) {
            $table->id(); // Auto-increment ID
            $table->string('nama_menu')->unique(); // Kolom nama_menu yang unik
            $table->decimal('harga_menu', 10, 2); // Kolom harga_menu dengan tipe decimal
            $table->integer('jumlah_menu')->nullable(); // Kolom jumlah_menu
            $table->string('deskripsi_menu'); // Kolom deskripsi_menu
            $table->string('gambar_menu')->nullable(); // Kolom gambar_menu
            $table->timestamps(); // Kolom timestamps untuk created_at dan updated_at
            $table->softDeletes(); // Kolom soft deletes
        });
    }

    /**
     * Membatalkan migrasi.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu'); // Menghapus tabel menu
    }
}
