<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyReferredUserIdNullableInReferralLogs extends Migration
{
    public function up()
    {
        Schema::table('referral_logs', function (Blueprint $table) {
            $table->unsignedBigInteger('referred_user_id')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('referral_logs', function (Blueprint $table) {
            $table->unsignedBigInteger('referred_user_id')->nullable(false)->change();
        });
    }
}

