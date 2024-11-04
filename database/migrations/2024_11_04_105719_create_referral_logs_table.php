<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReferralLogsTable extends Migration
{
    public function up()
    {
        Schema::create('referral_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('referrer_user_id')->constrained('data_pelanggan')->onDelete('cascade');
            $table->foreignId('referred_user_id')->constrained('data_pelanggan')->onDelete('cascade');
            $table->foreignId('transaction_id')->nullable()->constrained('transaksi')->onDelete('cascade');
            $table->integer('poin')->default(0); // Jumlah poin yang diberikan setiap kali kode referral digunakan
            $table->timestamp('used_at')->nullable(); // Waktu penggunaan kode referral
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('referral_logs');
    }
}
