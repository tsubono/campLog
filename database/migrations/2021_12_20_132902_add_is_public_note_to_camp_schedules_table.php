<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsPublicNoteToCampSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('camp_schedules', function (Blueprint $table) {
            $table->boolean('is_public_note')->nullable()->default(1)->comment('公開フラグ (メモ)')->after('note');
        });

        \App\Models\CampSchedule::all()->each (function($campSchedule) {
            $campSchedule->is_public_note = 1;
            $campSchedule->save();
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
            $table->dropColumn('is_public_note');
        });
    }
}
