<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCampStartDateToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->date('camp_start_date')->nullable()->after('is_public_age')->comment('キャンプ開始日');
            $table->dropColumn('camp_history');
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
            $table->dropColumn('camp_start_date');
            $table->integer('camp_history')->nullable()->after('is_public_age')->comment('キャンプ歴');
        });
    }
}
