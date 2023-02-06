<?php

namespace Database\Seeders;

use App\Models\Person;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PersonSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('people')->insert([
            'name' => 'Morty Smith',
            'detail' => 'Niño ',
            'gender_id' => 1
        ]);
        DB::table('people')->insert([
            'name' => 'Rick Sánchez',
            'detail' => 'Cientifico',
            'gender_id' => 1
        ]);
        DB::table('people')->insert([
            'name' => 'Arthricia',
            'detail' => 'Niña',
            'gender_id' => 2
        ]);
        DB::table('people')->insert([
            'name' => 'Beth Smith',
            'detail' => 'Mama',
            'gender_id' => 2
        ]);
        // Person::factory()->count(3)->create();

    }
}
