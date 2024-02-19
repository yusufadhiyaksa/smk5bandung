<?php

namespace Database\Factories;
use App\Models\Mapel;

use App\Models\UserHasRole;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class MapelPengajarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Retrieve user IDs with role_id = 3
        $userIds = UserHasRole::where('role_id', 3)->pluck('user_id')->toArray();
        // Select a random user ID from the filtered list
        $randomUserId = $this->faker->randomElement($userIds);
        return [
            "user_id" => $randomUserId,
            "mapel_id" => Mapel::all()->pluck("id")->random()
        ];
    }
}
