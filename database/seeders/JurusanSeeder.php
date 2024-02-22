<?php

namespace Database\Seeders;

use App\Models\Jurusan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public const DATA_JURUSAN = [
        [
            "nama_jurusan" => "Teknik Geomatika"
        ],
        [
            "nama_jurusan" => "Desain Pemodelan Informasi Bangunan"
        ],
        [
            "nama_jurusan" => "Teknik Kontruksi dan Perumahan"
        ],
        [
            "nama_jurusan" => "Analis Kimia"
        ],
        [
            "nama_jurusan" => "Teknik Komputer Jaringan"
        ],
        [
            "nama_jurusan" => "Produksi Film"
        ]
    ];
    public function run(): void
    {
        foreach (self::DATA_JURUSAN as $key => $jurusan) {
            Jurusan::create($jurusan);
        }
    }
}
