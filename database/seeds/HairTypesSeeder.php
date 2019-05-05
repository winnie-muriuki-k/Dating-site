<?php

use Illuminate\Database\Seeder;

class HairTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('hair_types')->delete();
        $types = array(
            array('name' => 'Curly'),
            array('name' => 'Other'),
            array('name' => 'Straight'),
            array('name' => 'Wavy'),
        );
        DB::table('hair_types')->insert($types);
    }
}
