<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\buku;

class isi_buku extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i <= 20; $i++) {
            buku::create([
                'judul_buku' => fake()->sentence(5),
                'penulis' => fake()->name(),
                'harga' => fake()->numberBetween(10000, 100000),
                'tanggal_terbit' => fake()->dateTimeThisDecade(),
         ]);
        }

    }
}
