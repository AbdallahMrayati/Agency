<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            "name" => "super admin",
        ];
        $role = json_encode($data);
        $user =   User::create([
            "name" => "abd",
            "email" => "abd@gmail.com",
            "password" => bcrypt("123"),
            "role" => $role,
        ]);
        $user->assignRole("super admin");
    }
}
