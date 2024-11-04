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
        Schema::table('data_pelanggan', function (Blueprint $table) {
            $table->string('kode_referal')->unique()->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('data_pelanggan', function (Blueprint $table) {
            $table->dropColumn('kode_referal');
        });
    }
    
};
