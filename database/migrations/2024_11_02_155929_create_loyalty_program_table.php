<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoyaltyProgramTable extends Migration
{
    public function up()
    {
        Schema::create('loyalty_program', function (Blueprint $table) {
            $table->id(); // Auto-increment ID
            $table->string('kode_referral', 5)->unique(); // Kode referral dengan panjang 5 karakter dan unique
            $table->integer('batas_loyalty')->default(5); // Batas loyalty default 5x
            $table->decimal('diskon', 10, 2)->default(5000.00); // Diskon default Rp 5.000,00
            $table->unsignedBigInteger('id_pelanggan'); // Foreign key ke DataPelanggan
            $table->foreign('id_pelanggan')->references('id')->on('data_pelanggan')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes(); // Kolom soft delete untuk penghapusan lembut
        });
    }

    public function down()
    {
        Schema::dropIfExists('loyalty_program');
    }
}
