<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ObjekWisata;

class ObjekWisataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ObjekWisata::factory()->count(3)->sequence(
            [
                'kategori' => 'Alam',
                'pulau' => 'Jawa',
            ],
            [
                'kategori' => 'Kuliner',
                'pulau' => 'Kalimantan',
            ],
            [
                'kategori' => 'Maritim',
                'pulau' => 'Sumatera',
            ],
        )->create();
    }
}
