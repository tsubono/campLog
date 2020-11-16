<?php

use Illuminate\Database\Seeder;

class CampPlaceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('camp_places')->insert([
            ['id' => 1, 'prefecture_code' => 1, 'name' => 'キャンプ場AAA'],
            ['id' => 2, 'prefecture_code' => 20, 'name' => 'キャンプ場BBB'],
            ['id' => 3, 'prefecture_code' => 30, 'name' => 'キャンプ場CCC'],
        ]);
    }
}
