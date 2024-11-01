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
        Schema::create('data_pengguna', function (Blueprint $table) {
            $table->string('ID_PENGGUNA', 10)->primary();
            $table->string('ID_ROLE', 8);
            $table->string('NOHP_PENGGUNA', 15);
            $table->string('ALAMAT_PENGGUNA', 100);
            $table->string('NAMA_PENGGUNA', 50);
            $table->string('PASSWORD', 100);
            $table->timestamps();
    
            $table->foreign('ID_ROLE')->references('ID_ROLE')->on('roles');
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_pengguna');
    }
};
