<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            "name" => "Admin",
            "email" => "admin@gmail.com",
            "password" => Hash::make("password"),
            "role" => "admin",
        ]);
        User::create([
            "name" => "Nay Aung Lin",
            "email" => "nayaunglin@gmail.com",
            "password" => Hash::make("password"),
        ]);

        Category::create([
            "name" => "Shoe",
            "slug" => "shoe", 
        ]);
        Category::create([
            "name" => "Shirt",
            "slug" => "shirt", 
        ]);
        Category::create([
            "name" => "Hat",
            "slug" => "hat", 
        ]); 
        Category::create([
            "name" => "Laptop",
            "slug" => "laptop", 
        ]);
        Category::create([
            "name" => "Phone",
            "slug" => "phone",
        ]);

        Product::factory(50)->create(); 
    }
}
