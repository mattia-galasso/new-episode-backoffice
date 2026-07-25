<?php

namespace App\Console\Commands;

use App\Services\TmdbImporter;
use Illuminate\Console\Command;

class TmdbPopulate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:tmdb-populate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(TmdbImporter $importer)
    {
        $series = [
            /* 'Breaking Bad',
            'Better Call Saul',
            'Stranger Things',
            'Dark',
            'The Last of Us',
            'Game of Thrones',
            'House of the Dragon',
            'The Walking Dead',
            'The Boys',
            'Invincible',
            'The Witcher',
            'Peaky Blinders',
            'Chernobyl',
            'Sherlock',
            'Loki',
            'Daredevil',
            'Wednesday',
            'You',
            'Black Mirror',
            'Narcos',
            'Ozark',
            'Dexter',
            'Lost',
            'Prison Break',
            'Vikings',
            'The Office',
            'Friends',
            'How I Met Your Mother',
            'The Big Bang Theory',
            'Brooklyn Nine-Nine',
            'The Bear',
            'The Sopranos',
            'True Detective',
            'Mindhunter',
            'Mr. Robot',
            'Severance',
            'Arcane',
            'Cyberpunk: Edgerunners',
            'The Mandalorian',
            'Andor',
            'The Penguin',
            'The Sandman',
            'The Queen\'s Gambit',
            'Squid Game',
            'Alice in Borderland',
            'Gilmore Girls',
            'The Haunting of Hill House',
            'From',
            'Silo',
            'Fallout',
            'Alien: Earth',
            'IT: Welcome to Derry',
            'Ironheart',
            'Eyes of Wakanda',
            'Lanterns',
            'Vision Quest',
            'Daredevil: Born Again',
            'A Knight of the Seven Kingdoms',
            'Spider-Noir',
            'Harry Potter',
            'Paradise',
            'Chief of War',
            'Murderbot',
            'Blade Runner',
            'Crystal Lake',
            */
            'Lucifer',
        ];

        foreach ($series as $index => $title) {

            $this->info('[' . ($index + 1) . '/' . count($series) . '] Importazione: ' . $title);

            try {

                $importer->import($title);

                $this->info('✔ Completata');
            } catch (\Throwable $e) {

                $this->error('✘ Errore: ' . $e->getMessage());
            }
        }

        return self::SUCCESS;
    }
}
