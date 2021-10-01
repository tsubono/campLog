<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddReviewColumnToCampSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('camp_schedules', function (Blueprint $table) {
            $table->text('review')->after('number_of_people')->nullable()->comment('レビュー');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('camp_schedules', function (Blueprint $table) {
            $table->dropColumn('review');
        });
    }
}
