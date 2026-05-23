<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin User if not exists
        if (!User::where('email', 'atmin@mail.com')->exists()) {
            User::create([
                'name' => 'Admin User',
                'email' => 'atmin@mail.com',
                'password' => bcrypt('atmin'),
                'email_verified_at' => now(),
            ]);
        }

        // Seed Categories
        $electronics = \App\Models\Category::create([
            'name' => 'Electronics',
            'slug' => 'electronics',
            'description' => 'Gadgets, devices, and accessories to keep you connected.',
            'is_active' => true,
        ]);

        $apparel = \App\Models\Category::create([
            'name' => 'Apparel & Fashion',
            'slug' => 'apparel-fashion',
            'description' => 'Trendy clothing, shoes, and modern lifestyle wear.',
            'is_active' => true,
        ]);

        $home = \App\Models\Category::create([
            'name' => 'Home & Kitchen',
            'slug' => 'home-kitchen',
            'description' => 'Beautiful decor, essential cookware, and home accents.',
            'is_active' => true,
        ]);

        // Seed Products
        \App\Models\Product::create([
            'category_id' => $electronics->id,
            'name' => 'Wireless Noise-Cancelling Headphones',
            'slug' => 'wireless-noise-cancelling-headphones',
            'description' => 'Immerse yourself in pure sound with our active noise-cancelling over-ear headphones. Features 40-hour battery life and fast charging.',
            'price' => 249.99,
            'stock' => 15,
            'is_active' => true,
        ]);

        \App\Models\Product::create([
            'category_id' => $electronics->id,
            'name' => 'Minimalist Smart Watch',
            'slug' => 'minimalist-smart-watch',
            'description' => 'A sleek, premium smartwatch tracking your fitness, sleep, and notifications with a stunning 7-day battery life.',
            'price' => 189.50,
            'stock' => 8,
            'is_active' => true,
        ]);

        \App\Models\Product::create([
            'category_id' => $apparel->id,
            'name' => 'Classic Cotton Trench Coat',
            'slug' => 'classic-cotton-trench-coat',
            'description' => 'Timeless water-resistant trench coat crafted from organic Egyptian cotton. Perfect for layering in transitional weather.',
            'price' => 145.00,
            'stock' => 22,
            'is_active' => true,
        ]);

        \App\Models\Product::create([
            'category_id' => $apparel->id,
            'name' => 'Premium Knit Sweater',
            'slug' => 'premium-knit-sweater',
            'description' => 'Ultra-soft merino wool knit sweater designed for cozy warmth and long-lasting durability.',
            'price' => 85.00,
            'stock' => 30,
            'is_active' => true,
        ]);

        \App\Models\Product::create([
            'category_id' => $home->id,
            'name' => 'Ceramic Matte Coffee Mug Set',
            'slug' => 'ceramic-matte-coffee-mug-set',
            'description' => 'Set of 4 handcrafted ceramic mugs in natural earth tones, finished with a smooth matte glaze.',
            'price' => 34.00,
            'stock' => 50,
            'is_active' => true,
        ]);

        \App\Models\Product::create([
            'category_id' => $home->id,
            'name' => 'Minimalist Table Lamp',
            'slug' => 'minimalist-table-lamp',
            'description' => 'Warm glow table lamp with solid oak base and frosted glass shade. Dimmable control for the perfect ambient lighting.',
            'price' => 59.99,
            'stock' => 12,
            'is_active' => true,
        ]);
    }
}
