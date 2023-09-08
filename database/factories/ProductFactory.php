<?php

namespace Database\Factories;

use App\Models\Inventory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'number' => config('env.SYS_PRODUCT_PREFIX') . '_' . $this->faker->randomNumber(6, true),
            'available_inventory' => $this->faker->randomNumber(3, true),
            'default_inventory_id' => null,
            'note' => $this->faker->paragraph,
            'properties' => null,
        ];
    }
}
