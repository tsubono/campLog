<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('ユーザー名: URLの名前になる');
            $table->string('twitter_token')->nullable()->comment('Twitter認証した場合に格納');
            $table->string('handle_name')->comment('プロフィールで表示する名称');
            $table->string('email')->nullable()->comment('メールアドレス');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable()->comment('パスワード');
            $table->string('avatar_path')->nullable()->comment('アイコン画像パス');
            $table->string('background_path')->nullable()->comment('背景画像パス');
            $table->string('gender')->nullable()->comment('性別');
            $table->integer('age')->nullable()->comment('年齢');
            $table->integer('camp_history')->nullable()->comment('キャンプ歴');
            $table->string('location')->nullable()->comment('拠点');
            $table->text('introduction')->nullable()->comment('自己紹介');
            $table->string('twitter_url')->nullable()->comment('TwitterのURL');
            $table->string('instagram_url')->nullable()->comment('InstagramのURL');
            $table->string('facebook_url')->nullable()->comment('FacebookのURL');
            $table->string('youtube_url')->nullable()->comment('YoutubeのURL');
            $table->string('blog_url')->nullable()->comment('BlogのURL');
            $table->boolean('admin_flg')->nullable()->default(false)->comment('管理者フラグ');
            $table->rememberToken();
            $table->timestampsTz();
            $table->softDeletesTz();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
