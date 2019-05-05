<?php

use Illuminate\Database\Seeder;

class HairLengthsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('hair_lengths')->delete();
        $lengths = array(
            array('name' => 'Bald'),
            array('name' => 'Bald on Top'),
            array('name' => 'Long'),
            array('name' => 'Shaved'),
            array('name' => 'Short'),
            array('name' => 'Medium'),
        );
        DB::table('hair_lengths')->insert($lengths);
    }
}
