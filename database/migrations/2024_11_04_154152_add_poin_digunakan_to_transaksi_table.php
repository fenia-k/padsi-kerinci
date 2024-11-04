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
        Schema::table('transaksi', function (Blueprint $table) {
            $table->integer('poin_digunakan')->nullable()->after('kode_referal'); // Menambahkan kolom poin_digunakan
        });
    }
    
    public function down()
    {
        Schema::table('transaksi', function (Blueprint $table) {
            $table->dropColumn('poin_digunakan');
        });
    }
    
};
