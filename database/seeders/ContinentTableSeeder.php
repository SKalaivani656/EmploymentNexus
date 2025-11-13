<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContinentTableSeeder extends Seeder
{
/**
 * Run the database seeds.
 *
 * @return void
 */
    public function run()
    {
        DB::table('continents')->delete();
        $continents = array(
            array('id' => 1, 'code' => 'as', 'name' => "Asia"),
            array('id' => 2, 'code' => 'eu', 'name' => "Europe"),
            array('id' => 3, 'code' => 'af', 'name' => "Africa"),
            array('id' => 4, 'code' => 'oc', 'name' => "Oceania"),
            array('id' => 5, 'code' => 'an', 'name' => "Antarctica"),
            array('id' => 6, 'code' => 'na', 'name' => "North America"),
            array('id' => 7, 'code' => 'sa', 'name' => "South America"),
        );
        DB::table('continents')->insert($continents);
    }
}
