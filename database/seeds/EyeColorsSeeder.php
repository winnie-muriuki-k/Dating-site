<?php

use Illuminate\Database\Seeder;

class EyeColorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('eye_colors')->delete();
        $colors = array(
            array('name' => 'Black'),
            array('name' => 'Blue'),
            array('name' => 'Brown'),
            array('name' => 'Green'),
            array('name' => 'Grey'),
            array('name' => 'Hazel'),
            array('name' => 'Other'),
        );
        DB::table('eye_colors')->insert($colors);
    }
}
