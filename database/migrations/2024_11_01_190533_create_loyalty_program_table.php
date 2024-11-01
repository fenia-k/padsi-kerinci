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
        Schema::create('loyalty_program', function (Blueprint $table) {
            $table->integer('ID_RUJUKAN')->primary();
            $table->string('ID_PELANGGAN', 10);
            $table->string('KODE_REFERRAL', 5);
            $table->integer('BATAS_RUJUKAN');
            $table->string('STATUS', 15);
            $table->timestamps();
    
            $table->foreign('ID_PELANGGAN')->references('ID_PELANGGAN')->on('data_pelanggan');
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loyalty_program');
    }
};
