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
            ['logo_img' => 'logo_netflix.png', 'name' => 'Netflix', 'website' => 'https://www.netflix.com'],
            ['logo_img' => 'logo_primevideo.png', 'name' => 'Prime Video', 'website' => 'https://www.primevideo.com'],
            ['logo_img' => 'logo_disney.png', 'name' => 'Disney+', 'website' => 'https://www.disneyplus.com'],
            ['logo_img' => 'logo_appletv.png', 'name' => 'Apple TV+', 'website' => 'https://tv.apple.com'],
            ['logo_img' => 'logo_hbo.png', 'name' => 'HBO Max', 'website' => 'https://www.max.com'],
            ['logo_img' => 'logo_paramount.png', 'name' => 'Paramount+', 'website' => 'https://www.paramountplus.com'],
            ['logo_img' => 'logo_now.png', 'name' => 'NOW TV', 'website' => 'https://www.nowtv.it'],
            ['logo_img' => 'logo_sky.png', 'name' => 'Sky', 'website' => 'https://www.sky.it']
        ];

        foreach ($platforms as $platform) {
            $newPlatform = new Platform();

            $newPlatform->logo_img = $platform['logo_img'];
            $newPlatform->name = $platform['name'];
            $newPlatform->website = $platform['website'];

            $newPlatform->save();
        }
    }
}
