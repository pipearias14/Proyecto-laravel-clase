<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Venue>
 */
class VenueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'venue_name' => fake()->company,
            'venue_max_capacity' => fake()->numberBetween(50, 1000),
            'venue_address' => fake()->address,
            'venue_status' => fake()->boolean(80),
        ];
    }
}
