<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        array_map(fn($offre) => Technology::factory()->create(['name' => $offre]),
            ['SecureServer', 'USBProtector', 'FranceProtection', 'MyDatas', 'ServerStrike']);
    }
}
