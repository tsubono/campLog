<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsPublicColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_public_gender')->nullable()->default(1)->comment('公開フラグ (性別)')->after('gender');
            $table->boolean('is_public_age')->nullable()->default(1)->comment('公開フラグ (年齢)')->after('age');
            $table->boolean('is_public_camp_history')->nullable()->default(1)->comment('公開フラグ (キャンプ歴)')->after('camp_history');
            $table->boolean('is_public_location')->nullable()->default(1)->comment('公開フラグ (拠点)')->after('location');
            $table->boolean('is_public_introduction')->nullable()->default(1)->comment('公開フラグ (自己紹介)')->after('introduction');
            $table->boolean('is_public_twitter_url')->nullable()->default(1)->comment('公開フラグ (Twitter)')->after('twitter_url');
            $table->boolean('is_public_instagram_url')->nullable()->default(1)->comment('公開フラグ (インスタ)')->after('instagram_url');
            $table->boolean('is_public_facebook_url')->nullable()->default(1)->comment('公開フラグ (Facebook)')->after('facebook_url');
            $table->boolean('is_public_youtube_url')->nullable()->default(1)->comment('公開フラグ (YouTube)')->after('youtube_url');
            $table->boolean('is_public_blog_url')->nullable()->default(1)->comment('公開フラグ (Blog)')->after('blog_url');
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
            $table->dropColumn('is_public_gender');
            $table->dropColumn('is_public_age');
            $table->dropColumn('is_public_camp_history');
            $table->dropColumn('is_public_location');
            $table->dropColumn('is_public_introduction');
            $table->dropColumn('is_public_twitter_url');
            $table->dropColumn('is_public_instagram_url');
            $table->dropColumn('is_public_facebook_url');
            $table->dropColumn('is_public_youtube_url');
            $table->dropColumn('is_public_blog_url');
        });
    }
}
