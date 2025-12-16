<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Pelanggan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        User::firstOrCreate(
            ['email' => 'admin@pittelmoto.com'],
            [
                'name' => 'Admin PitTel Moto',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        // Create sample customer users
        $pelanggans = Pelanggan::limit(3)->get();

        foreach ($pelanggans as $index => $pelanggan) {
            User::firstOrCreate(
                ['email' => 'pelanggan' . ($index + 1) . '@pittelmoto.com'],
                [
                    'name' => $pelanggan->nama,
                    'password' => Hash::make('password'),
                    'role' => 'pelanggan',
                    'pelanggan_id' => $pelanggan->id,
                ]
            );
        }
    }
}
