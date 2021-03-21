<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddClubhouseUrlToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('sort_clubhouse_url')->nullable()->after('sort_blog_url')->comment('Clubhouse URL 並び順');
            $table->boolean('is_public_clubhouse_url')->nullable()->default(1)->after('sort_blog_url')->comment('公開フラグ (Clubhouse)');
            $table->string('clubhouse_url')->nullable()->after('sort_blog_url')->comment('ClubhouseのURL');
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
            $table->dropColumn('clubhouse_url');
            $table->dropColumn('is_public_clubhouse_url');
            $table->dropColumn('sort_clubhouse_url');
        });
    }
}
