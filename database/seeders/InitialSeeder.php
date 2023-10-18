<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InitialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $initialEmail = config('env.INITIAL_ADMIN_EMAIL');

        if($initialEmail) {
            User::factory()->create([
                'name' => 'Admin',
                'email' => $initialEmail,
                'password' => bcrypt($initialEmail)
            ]);

        }
    }
}
