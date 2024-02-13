<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Yad',
            'email' => 'yad.hoshyar@gmail.com',
            'password' => bcrypt('superadmin@'),
        ]);

        $this->call([
            InitialSeeder::class,
            PermissionSeeder::class,
            //CustomerFakeSeeder::class,
            //ProductFakeSeeder::class,
            //OrderFakeSeeder::class,
        ]);
    }
}
