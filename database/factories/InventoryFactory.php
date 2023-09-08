<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Inventory>
 */
class InventoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'number' => config('env.SYS_INVENTORY_PREFIX') . '_' . $this->faker->randomNumber(6, true),
            'product_id' => 1,
            'cost' => $this->faker->randomNumber(5, true),
            'price' => $this->faker->randomNumber(5, true),
            'quantity' => $this->faker->randomNumber(2, true),
            'date' => $this->faker->dateTimeThisMonth,
            'note' => $this->faker->paragraph,
            'properties' => null,
        ];
    }
}
