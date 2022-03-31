<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIndexToTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('camp_schedule_images', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $doctrineTable = $sm->listTableDetails('camp_schedule_images');
            if (!$doctrineTable->hasIndex('camp_schedule_images_camp_schedule_id_index')) {
                $table->index('camp_schedule_id');
            }
        });
        Schema::table('camp_schedules', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $doctrineTable = $sm->listTableDetails('camp_schedules');
            if (!$doctrineTable->hasIndex('camp_schedules_user_id_index')) {
                $table->index('user_id');
            }
            if (!$doctrineTable->hasIndex('camp_schedules_camp_place_id_index')) {
                $table->index('camp_place_id');
            }
        });
        Schema::table('user_bookmarks', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $doctrineTable = $sm->listTableDetails('user_bookmarks');
            if (!$doctrineTable->hasIndex('user_bookmarks_user_id_index')) {
                $table->index('user_id');
            }
            if (!$doctrineTable->hasIndex('user_bookmarks_camp_place_id_index')) {
                $table->index('camp_place_id');
            }
        });
        Schema::table('user_links', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $doctrineTable = $sm->listTableDetails('user_links');
            if (!$doctrineTable->hasIndex('user_links_user_id_index')) {
                $table->index('user_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
