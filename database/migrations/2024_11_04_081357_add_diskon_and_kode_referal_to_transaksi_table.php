<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDiskonAndKodeReferalToTransaksiTable extends Migration
{
    public function up()
    {
        Schema::table('transaksi', function (Blueprint $table) {
            $table->decimal('diskon', 10, 2)->nullable()->after('total_harga');
            $table->string('kode_referal')->nullable()->after('diskon');
        });
    }

    public function down()
    {
        Schema::table('transaksi', function (Blueprint $table) {
            $table->dropColumn('diskon');
            $table->dropColumn('kode_referal');
        });
    }
}
