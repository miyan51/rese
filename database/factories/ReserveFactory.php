<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reserve>
 */
class ReserveFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'number' => $this->faker->numberBetween(1, 10),
            'date' => $this->faker->date($format = 'Y-m-d', $min = 'now'),
            'time' => $this->faker->time('H:i'),
            'shop_id' => $this->faker->numberBetween(1, 20),
            'user_id' =>
            $this->faker->numberBetween(1, 5),
        ];
    }
}
