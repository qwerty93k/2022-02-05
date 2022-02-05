<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->name(),
            'description' => $this->faker->sentence(6),
            'price' => rand(1, 100),
            'category_id' => rand(1, 3),
            'image_url' => $this->faker->imageUrl(),
        ];
    }
}
