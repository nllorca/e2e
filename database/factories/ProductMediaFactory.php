<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductMediaF>
 */
class ProductMediaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_id' => fake()->randomDigitNotNull(),
            'type' => 'image/png',
            'url' => fake()->imageUrl(640, 480, 'animals', true),
            'status' => 'PUBLISHED',
        ];
    }
}
