<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLanggananIdInUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('langganan_id')->nullable()->after('remember_token');
            $table->foreign('langganan_id')->references('id')->on('manajemen_langganans')->nullOnDelete();
        });

        Schema::table('manajemen_langganans', function (Blueprint $table) {
            $table->date('expired_at')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['langganan_id']);
            $table->dropColumn('langganan_id');
        });
        Schema::table('manajemen_langganans', function (Blueprint $table) {
            $table->dropColumn('expired_at');
        });
    }
}
