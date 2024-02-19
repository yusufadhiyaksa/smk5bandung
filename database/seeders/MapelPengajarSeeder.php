<?php

namespace Database\Seeders;

use App\Models\MapelPengajar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MapelPengajarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MapelPengajar::factory()->count(30)->create();
    }
}
