<?php

namespace Database\Seeders;

use App\Models\ProductionCompany;
use Faker\Generator as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductionCompaniesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {

        for ($i = 0; $i < 10; $i++) {
            $newProductionCompany = new ProductionCompany();

            $newProductionCompany->name = $faker->company();
            $newProductionCompany->country = $faker->country();

            $newProductionCompany->save();
        }
    }
}
