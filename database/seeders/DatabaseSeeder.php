<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::create([
            "first_name" => "Admin",
            "last_name" => "Utama",
            "username" => "admin",
            "email" => "admin@mail.com",
            "password" => bcrypt("password"),
            "role" => "admin"
        ]);

        \App\Models\User::create([
            "first_name" => "Penulis",
            "last_name" => "Blog",
            "username" => "admin",
            "email" => "penulis@mail.com",
            "password" => bcrypt("password"),
            "role" => "admin"
        ]);
    }
}
