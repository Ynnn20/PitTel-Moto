<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Admin user
        User::updateOrCreate(
            ['email' => 'admin@pittel.com'],
            [
                'name' => 'Admin PitTel',
                'password' => bcrypt('password123'),
            ]
        );

        $this->call(SampleDataSeeder::class);
    }
}
