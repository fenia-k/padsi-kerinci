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
        Schema::create('menu', function (Blueprint $table) {
            $table->char('ID_MENU', 10)->primary();
            $table->string('NAMA_MENU', 25);
            $table->string('DESKRIPSI_MENU', 100);
            $table->float('HARGA_MENU');
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu');
    }
};
