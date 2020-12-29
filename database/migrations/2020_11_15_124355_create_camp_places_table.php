<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampPlacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('camp_places', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('キャンプ場名');
            $table->string('address')->comment('住所');
            $table->text('parking')->nullable()->comment('駐車場');
            $table->text('business_hours')->nullable()->comment('営業時間');
            $table->text('holiday')->nullable()->comment('定休日');
            $table->text('check_in')->nullable()->comment('チェックイン');
            $table->text('check_out')->nullable()->comment('チェックアウト');
            $table->string('can_credit')->nullable()->comment('カード決済');
            $table->string('usage_type')->nullable()->comment('利用タイプ');
            $table->text('url')->nullable()->comment('URL');
            $table->string('tel_number')->nullable()->comment('電話番号');
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
        Schema::dropIfExists('camp_places');
    }
}
