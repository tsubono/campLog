<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampScheduleImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('camp_schedule_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('camp_schedule_id')->comment('キャンプ予定ID');
            $table->foreign('camp_schedule_id')->references('id')->on('camp_schedules')->onDelete('cascade');
            $table->string('image_path')->comment('画像パス');
            $table->integer('sort')->nullable()->comment('順番');
            $table->timestampTz('created_at', 0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('camp_schedule_images');
    }
}
