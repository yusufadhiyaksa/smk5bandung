<?php

namespace Database\Factories;

use App\Models\Jurusan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mapel>
 */
class MapelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "jurusan_id" => Jurusan::all()->pluck("id")->random(),
            "nama_mapel" => fake()->name,
            "fase" => fake()->randomElement(["E", "F"]),
            "muatan" => fake()->randomElement(["nasional", "kewilayahan", "peminatan kejuruan", "kompetensi keahlian"]),
            "capaian_mapel" =>fake()->text()
        ];
    }
}
