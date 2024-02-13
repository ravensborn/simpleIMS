<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'number' => config('env.SYS_ORDER_PREFIX') . '_' . $this->faker->randomNumber(6, true),
            'status' => $this->faker->randomElement(Order::statusArray()),
            'user_id' => 1,
            'customer_id' => $this->faker->randomElement(Customer::all()->pluck('id')),
            'total' => $this->faker->randomNumber(3, true),
            'paid' => $this->faker->randomNumber(3, true),
            'note' => $this->faker->paragraph,
            'properties' => null,
        ];
    }
}
