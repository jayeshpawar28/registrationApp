<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'customer_name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'number' => fake()->randomNumber(),
            'photo' => fake()->imageUrl(640, 480, 'people', true, 'Faker'), // Generates a fake image URL
        ];
    }
}
