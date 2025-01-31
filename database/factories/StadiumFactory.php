<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class StadiumFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => $this->faker->city . ' Stadium',
            'address' => $this->faker->address,
            'capacity' => $this->faker->numberBetween(10000, 100000),
            'price_per_hour' => $this->faker->randomFloat(2, 500, 5000),
            'user_id' => \App\Models\User::factory()->create(['role' => 'owner'])->id
        ];
    }
}