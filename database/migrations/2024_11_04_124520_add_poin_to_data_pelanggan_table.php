<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPoinToDataPelangganTable extends Migration
{
    public function up()
    {
        Schema::table('data_pelanggan', function (Blueprint $table) {
            $table->integer('poin')->default(0); // Menambahkan kolom poin dengan default 0
        });
    }

    public function down()
    {
        Schema::table('data_pelanggan', function (Blueprint $table) {
            $table->dropColumn('poin'); // Menghapus kolom poin jika rollback
        });
    }
}
