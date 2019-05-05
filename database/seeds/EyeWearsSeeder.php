<?php

use Illuminate\Database\Seeder;

class EyeWearsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('eye_wears')->delete();
        $wears = array(
            array('name' => 'Contacts'),
            array('name' => 'Glasses'),
            array('name' => 'None'),
        );
        DB::table('eye_wears')->insert($wears);
    }
}
