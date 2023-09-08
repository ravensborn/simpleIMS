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
            'name' => $this->faker->name,
            'phone_number' => '0750' . $this->faker->randomNumber(7),
            'email_address' => $this->faker->email,
            'address' => $this->faker->address,
            'note' => $this->faker->paragraph,
            'properties' => null,
        ];
    }
}
