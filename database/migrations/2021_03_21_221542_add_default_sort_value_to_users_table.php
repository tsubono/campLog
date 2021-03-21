<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDefaultSortValueToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('sort_twitter_url')->nullable()->comment('Twitter URL 並び順')->after('is_public_twitter_url')->default(1)->change();
            $table->integer('sort_instagram_url')->nullable()->comment('インスタ URL 並び順')->after('is_public_instagram_url')->default(2)->change();
            $table->integer('sort_youtube_url')->nullable()->comment('Youtube URL 並び順')->after('is_public_youtube_url')->default(3)->change();
            $table->integer('sort_blog_url')->nullable()->comment('ブログ URL 並び順')->after('is_public_blog_url')->default(5)->change();
            $table->integer('sort_facebook_url')->nullable()->comment('Facebook URL 並び順')->after('is_public_facebook_url')->default(6)->change();
            $table->integer('sort_clubhouse_url')->nullable()->comment('Clubhouse URL 並び順')->after('is_public_clubhouse_url')->default(4)->change();
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
            $table->integer('sort_twitter_url')->nullable()->comment('Twitter URL 並び順')->after('is_public_twitter_url')->default(null)->change();
            $table->integer('sort_instagram_url')->nullable()->comment('インスタ URL 並び順')->after('is_public_instagram_url')->default(null)->change();
            $table->integer('sort_youtube_url')->nullable()->comment('Youtube URL 並び順')->after('is_public_youtube_url')->default(null)->change();
            $table->integer('sort_blog_url')->nullable()->comment('ブログ URL 並び順')->after('is_public_blog_url')->default(null)->change();
            $table->integer('sort_facebook_url')->nullable()->comment('Facebook URL 並び順')->after('is_public_facebook_url')->default(null)->change();
            $table->integer('sort_clubhouse_url')->nullable()->comment('Clubhouse URL 並び順')->after('is_public_clubhouse_url')->default(null)->change();
        });
    }
}
