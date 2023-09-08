<?php

namespace Database\Seeders;

use App\Models\Inventory;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::factory(10)->create();

        foreach (Product::all() as $product) {
            $filepath = public_path('images/cat.png');
            $name = uniqid();
            $extension = '.png';
            $product
                ->addMedia($filepath)
                ->usingName($name)
                ->usingFilename($name . $extension)
                ->preservingOriginal()
                ->toMediaCollection('image');
        }

        Inventory::factory(10)->create();
    }
}
