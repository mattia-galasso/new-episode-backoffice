<?php

namespace Database\Seeders;

use App\Models\Platform;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlatformsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $platforms = [
            ['name' => 'Netflix', 'website' => 'https://www.netflix.com'],
            ['name' => 'Prime Video', 'website' => 'https://www.primevideo.com'],
            ['name' => 'Disney+', 'website' => 'https://www.disneyplus.com'],
            ['name' => 'Apple TV+', 'website' => 'https://tv.apple.com'],
            ['name' => 'HBO Max', 'website' => 'https://www.max.com'],
            ['name' => 'Paramount+', 'website' => 'https://www.paramountplus.com'],
            ['name' => 'NOW TV', 'website' => 'https://www.nowtv.it']
        ];

        foreach ($platforms as $platform) {
            $newPlatform = new Platform();

            $newPlatform->name = $platform['name'];
            $newPlatform->website = $platform['website'];

            $newPlatform->save();
        }
    }
}
