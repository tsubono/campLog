<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('camp_schedules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->comment('ユーザーID');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('camp_place_id')->comment('キャンプ場所ID');
            $table->foreign('camp_place_id')->references('id')->on('camp_places');
            $table->date('date')->nullable()->comment('日付');
            $table->string('title')->comment('タイトル');
            $table->integer('number_of_stay')->nullable()->default(0)->comment('泊数');
            $table->integer('number_of_people')->nullable()->default(0)->comment('人数');
            $table->string('url')->nullable()->comment('URL');
            $table->text('cancel_note')->nullable()->comment('キャンセル規定');
            $table->time('in')->nullable()->comment('イン');
            $table->time('out')->nullable()->comment('アウト');
            $table->string('tel_number')->nullable()->comment('電話番号');
            $table->boolean('is_public')->nullable()->default(false)->comment('公開フラグ');
            $table->timestampsTz();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('camp_schedules');
    }
}
