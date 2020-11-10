<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = Faker\Factory::create();
        $record = 10;
        for($i = 0; $i < $record; $i++) {
            DB::table('task')->insert(
                [
                    'name' => $faker->name,
                    'description' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
                    'email' => $faker->unique()->email,
                    'contact_number' => $faker->phoneNumber
                ]
            );
        }
    }
}
