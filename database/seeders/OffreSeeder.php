<?php

namespace Database\Seeders;

use App\Models\Offre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OffreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // creation des offres spécifique
        array_map(fn($offre) => Offre::factory()->create(['name' => $offre]),
            ['FastSOC Servers', 'FastSOC USB', 'FastSOC Data']);

    }
}
