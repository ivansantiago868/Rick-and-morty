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
            'detail' => 'Niño '
        ]);
        DB::table('people')->insert([
            'name' => 'Rick Sánchez',
            'detail' => 'Cientifico'
        ]);
        DB::table('people')->insert([
            'name' => 'Arthricia',
            'detail' => 'Niña'
        ]);
        DB::table('people')->insert([
            'name' => 'Beth Smith',
            'detail' => 'Mama'
        ]);
        // Person::factory()->count(3)->create();

    }
}
