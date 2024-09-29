<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //lancement des seeders pour les données
        $this->call([
            ClientSeeder::class,
            OffreSeeder::class,
            TechnologySeeder::class,
        ]);
    }
}
