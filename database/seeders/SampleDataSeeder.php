<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class SampleDataSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        // Pelanggan
        DB::table('pelanggans')->insert([
            ['nama' => 'Budi Santoso', 'telepon' => '081234567890', 'email' => 'budi@example.com', 'alamat' => 'Jl. Melati No. 1', 'created_at' => $now, 'updated_at' => $now],
            ['nama' => 'Siti Aminah', 'telepon' => '081298765432', 'email' => 'siti@example.com', 'alamat' => 'Jl. Kenanga No. 2', 'created_at' => $now, 'updated_at' => $now],
            ['nama' => 'Andi Wijaya', 'telepon' => '081377788999', 'email' => 'andi@example.com', 'alamat' => 'Jl. Mawar No. 3', 'created_at' => $now, 'updated_at' => $now],
        ]);

        // Mekanik
        DB::table('mekaniks')->insert([
            ['nama' => 'Rudi Hartono', 'spesialisasi' => 'Mesin & Tune Up', 'telepon' => '0811111111', 'aktif' => true, 'created_at' => $now, 'updated_at' => $now],
            ['nama' => 'Agus Prasetyo', 'spesialisasi' => 'Kelistrikan', 'telepon' => '0822222222', 'aktif' => true, 'created_at' => $now, 'updated_at' => $now],
            ['nama' => 'Dewi Lestari', 'spesialisasi' => 'Body & Cat', 'telepon' => '0833333333', 'aktif' => true, 'created_at' => $now, 'updated_at' => $now],
        ]);

        // Motor
        DB::table('motors')->insert([
            ['pelanggan_id' => 1, 'merk' => 'Honda', 'model' => 'Vario 150', 'plat_nomor' => 'B 1234 ABC', 'tahun' => '2019', 'warna' => 'Hitam', 'created_at' => $now, 'updated_at' => $now],
            ['pelanggan_id' => 2, 'merk' => 'Yamaha', 'model' => 'NMAX', 'plat_nomor' => 'B 5678 DEF', 'tahun' => '2020', 'warna' => 'Silver', 'created_at' => $now, 'updated_at' => $now],
            ['pelanggan_id' => 3, 'merk' => 'Suzuki', 'model' => 'Satria F150', 'plat_nomor' => 'B 9999 XYZ', 'tahun' => '2018', 'warna' => 'Merah', 'created_at' => $now, 'updated_at' => $now],
        ]);

        // Spareparts
        DB::table('spareparts')->insert([
            ['nama' => 'Oli Mesin', 'kode' => 'OLI-01', 'stok' => 20, 'minimal_stok' => 5, 'harga' => 75000, 'satuan' => 'botol', 'created_at' => $now, 'updated_at' => $now],
            ['nama' => 'Busi', 'kode' => 'BUSI-01', 'stok' => 50, 'minimal_stok' => 10, 'harga' => 25000, 'satuan' => 'pcs', 'created_at' => $now, 'updated_at' => $now],
            ['nama' => 'Kampas Rem', 'kode' => 'BRK-01', 'stok' => 15, 'minimal_stok' => 4, 'harga' => 120000, 'satuan' => 'set', 'created_at' => $now, 'updated_at' => $now],
        ]);

        // Servis
        DB::table('servis')->insert([
            [
                'pelanggan_id' => 1,
                'motor_id' => 1,
                'mekanik_id' => 1,
                'keluhan' => 'Service rutin dan ganti oli',
                'tindakan' => 'Ganti oli, cek kelistrikan',
                'biaya' => 150000,
                'status' => 'selesai',
                'tanggal_servis' => now()->toDateString(),
                'selesai_at' => now(),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'pelanggan_id' => 2,
                'motor_id' => 2,
                'mekanik_id' => 2,
                'keluhan' => 'Rem kurang pakem',
                'tindakan' => 'Ganti kampas rem',
                'biaya' => 200000,
                'status' => 'proses',
                'tanggal_servis' => now()->toDateString(),
                'selesai_at' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'pelanggan_id' => 3,
                'motor_id' => 3,
                'mekanik_id' => 3,
                'keluhan' => 'Mesin brebet',
                'tindakan' => 'Cek injeksi dan busi',
                'biaya' => 180000,
                'status' => 'pending',
                'tanggal_servis' => now()->toDateString(),
                'selesai_at' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
