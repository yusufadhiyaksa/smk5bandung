<?php

namespace Database\Seeders;

use App\Enums\Role;
use App\Models\Role as ModelsRole;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public const DATA_USER = [
        [
            "name" => "Mochamad Yusuf Adhiyaksa",
            "email" => "S.yusufadhiyaksa@gmail.com",
            "email_verified_at" => "2023-12-31 08:38:35",
            "password" => "admin",
            "nuptk" => "10117172"
        ],
        [
            "name" => "admin",
            "email" => "admin@gmail.com",
            "email_verified_at" => "2023-12-31 08:38:35",
            "password" => "admin",
            "nuptk" => "10117412"
        ]
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (self::DATA_USER as $key => $user) {
            $user["password"] = Hash::make($user["password"]);
            $createdUser = User::create($user);

            if ($createdUser->email === "S.yusufadhiyaksa@gmail.com") {
                $createdUser->assignRole(Role::SUPERADMIN->value);
            }

            if ($createdUser->email === "admin@gmail.com") {
                $rolePengajar = ModelsRole::where('name', Role::PENGAJAR->value)->first();
                $createdUser->role()->attach($rolePengajar);
            }
        }


        User::factory()->count(30)->create();
    }
}
