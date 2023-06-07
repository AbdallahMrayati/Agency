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
        // Super Admin Account ------------------------
        $data = [
            "name" => "super admin",
        ];
        // $role = json_encode($data);
        $superAdmin =   User::create([
            "name" => "abd",
            "email" => "abd@gmail.com",
            "password" => bcrypt("123"),
            "role" => $data,
        ]);
        $superAdmin->assignRole("super admin");


        // blogs writer Account ------------------------
        $data = [
            "name" => "blogs writer",
        ];
        // $role = json_encode($data);
        $blogsWriter =   User::create([
            "name" => "abdB",
            "email" => "abdB@gmail.com",
            "password" => bcrypt("123"),
            "role" => $data,
        ]);
        $blogsWriter->assignRole("blogs writer");



        // picies writer Account ------------------------
        $data = [
            "name" => "picies writer",
        ];
        // $role = json_encode($data);
        $piciesWriter =   User::create([
            "name" => "abdP",
            "email" => "abdP@gmail.com",
            "password" => bcrypt("123"),
            "role" => $data,
        ]);
        $piciesWriter->assignRole("picies writer");



        // portfolios writer Account ------------------------
        $data = [
            "name" => "portfolios writer",
        ];
        // $role = json_encode($data);
        $portfoliosWriter =   User::create([
            "name" => "abdPO",
            "email" => "abdPO@gmail.com",
            "password" => bcrypt("123"),
            "role" => $data,
        ]);
        $portfoliosWriter->assignRole("portfolios writer");


        // requests recipient Account ------------------------
        $data = [
            "name" => "requests recipient",
        ];
        // $role = json_encode($data);
        $requestsRecipient =   User::create([
            "name" => "abdR",
            "email" => "abdR@gmail.com",
            "password" => bcrypt("123"),
            "role" => $data,
        ]);
        $requestsRecipient->assignRole("requests recipient");
    }
}