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
    public function definition()
    {
        $type = fake()->randomElement(['I', 'B']);
        $name = ($type=='B'? fake()->company(): fake()->name());

        return [
            'name' => $name,
            'type' => $type,
            'email' => fake()->unique()->email(),
            'address' => fake()->streetAddress(),
            'city' => fake()->city(),
            'state' => fake()->state(),
            'postal_code' => fake()->postCode()
        ];
    }
}
