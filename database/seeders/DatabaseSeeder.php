<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\{Blog, Category, Coupon, Product, User};

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         User::factory(10)->create();
         Category::factory(5)->create();
         Product::factory(10)->create();
         Blog::factory(10)->create();
         Coupon::factory(10)->create();

    }
}
