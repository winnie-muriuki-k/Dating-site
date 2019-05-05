<?php

use Illuminate\Database\Seeder;

class HairColorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('hair_colors')->delete();
        $colors = array(
            array('name' => 'Bald/Shaved'),
            array('name' => 'Black'),
            array('name' => 'Blonde'),
            array('name' => 'Brown'),
            array('name' => 'Grey/White'),
            array('name' => 'Light/Brown'),
            array('name' => 'Red'),
            array('name' => 'Other'),
            array('name' => 'Changes Frequently'),
        );
        DB::table('hair_colors')->insert($colors);
    }
}
