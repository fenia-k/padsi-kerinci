<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('stok', function (Blueprint $table) {
            $table->string('ID_PRODUK', 10)->primary();
            $table->string('NAMA_PRODUK', 25);
            $table->integer('QTY');
            $table->string('STATUS', 25);
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stok');
    }
};
