<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Shop>
 */
class ShopFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'shop' => $this->faker->text(20),
            'path' => $this->faker->text(20),
            'introduction' => $this->faker->text(20),
            'area' => $this->faker->text(20),
            'genre' => $this->faker->text(20),
        ];
    }
}
