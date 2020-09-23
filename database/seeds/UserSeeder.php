<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("users")->insert(
            [
                "name" => "Edwin",
                "email" => "md.edwin@edmartsystems.com",
                "userType" => "admin",
                "image" => "default.jpg",
                "password" => Hash::make("password"),
                "position" => "Managing Director",
                "status" => 1
            ]
        );
    }
}
