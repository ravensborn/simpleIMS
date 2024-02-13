<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderItem>
 */
class OrderItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_id' => 1,
            'product_id' => 1,
            'inventory_id' => 1,
            'product' => [
                'name' => 'test',
            ],
            'inventory' => [
                'number' => '123',
            ],
            'quantity' => $this->faker->randomNumber(2),
            'price' => $this->faker->randomNumber(3),
            'properties' => null,
        ];
    }
}
