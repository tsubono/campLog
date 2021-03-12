<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSortsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('sort_twitter_url')->nullable()->comment('Twitter URL 並び順')->after('is_public_twitter_url');
            $table->integer('sort_instagram_url')->nullable()->comment('インスタ URL 並び順')->after('is_public_instagram_url');
            $table->integer('sort_youtube_url')->nullable()->comment('Youtube URL 並び順')->after('is_public_youtube_url');
            $table->integer('sort_blog_url')->nullable()->comment('ブログ URL 並び順')->after('is_public_blog_url');
            $table->integer('sort_facebook_url')->nullable()->comment('Facebook URL 並び順')->after('is_public_facebook_url');
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
            $table->dropColumn('sort_twitter_url');
            $table->dropColumn('sort_instagram_url');
            $table->dropColumn('sort_youtube_url');
            $table->dropColumn('sort_blog_url');
            $table->dropColumn('sort_facebook_url');
        });
    }
}
