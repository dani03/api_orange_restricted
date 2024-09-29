<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'siren' => $this->faker->numberBetween(10000, 99999),
            'siret' => $this->faker->unique()->numberBetween(10000, 99999),
            'nom_legal' => $this->faker->name
        ];
    }
}
