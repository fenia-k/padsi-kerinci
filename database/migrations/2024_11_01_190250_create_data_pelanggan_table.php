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
        Schema::create('data_pelanggan', function (Blueprint $table) {
            $table->string('ID_PELANGGAN', 10)->primary();
            $table->integer('ID_RUJUKAN')->nullable();
            $table->string('NAMA_PELANGGAN', 50);
            $table->string('NOHP_PELANGGAN', 15);
            $table->string('ALAMAT_PELANGGAN', 50);
            $table->string('KODE_REFERRAL', 5)->nullable();
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_pelanggan');
    }
};
