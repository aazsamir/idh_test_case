<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->words(100, true),
            'price' => $this->faker->randomFloat(2, 1, 100),
            'status' => $this->faker->boolean(75),
        ];
    }
}
