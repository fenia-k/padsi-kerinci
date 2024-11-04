<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveDiskonFromLoyaltyProgramTable extends Migration
{
    public function up()
    {
        Schema::table('loyalty_program', function (Blueprint $table) {
            $table->dropColumn('diskon'); // Menghapus kolom diskon
        });
    }

    public function down()
    {
        Schema::table('loyalty_program', function (Blueprint $table) {
            $table->decimal('diskon', 5, 2)->nullable(); // Menambahkan kolom diskon kembali jika perlu rollback
        });
    }
}
