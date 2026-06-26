<?php

namespace Database\Seeders;

use App\Models\Actor;
use Faker\Generator as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ActorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        for ($i = 0; $i < 10; $i++) {
            $newActor = new Actor();

            $newActor->name = $faker->name();

            $newActor->save();
        }
    }
}
