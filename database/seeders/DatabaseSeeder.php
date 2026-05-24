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
            'name' => 'Elektronik',
            'slug' => 'elektronik',
            'description' => 'Gadget, perangkat pintar, dan aksesoris teknologi terbaru.',
            'is_active' => true,
        ]);

        $apparel = \App\Models\Category::create([
            'name' => 'Pakaian & Mode',
            'slug' => 'pakaian-mode',
            'description' => 'Pakaian trendi, sepatu, dan gaya hidup modern.',
            'is_active' => true,
        ]);

        $home = \App\Models\Category::create([
            'name' => 'Rumah & Dapur',
            'slug' => 'rumah-dapur',
            'description' => 'Dekorasi indah, peralatan dapur esensial, dan pernak-pernik rumah.',
            'is_active' => true,
        ]);

        // Seed Products
        \App\Models\Product::create([
            'category_id' => $electronics->id,
            'name' => 'Headphone Nirkabel Noise-Cancelling',
            'slug' => 'headphone-nirkabel-noise-cancelling',
            'description' => 'Nikmati suara murni dengan headphone over-ear active noise-cancelling kami. Dilengkapi daya tahan baterai 40 jam dan pengisian daya cepat.',
            'price' => 249.99,
            'stock' => 15,
            'is_active' => true,
        ]);

        \App\Models\Product::create([
            'category_id' => $electronics->id,
            'name' => 'Jam Tangan Pintar Minimalis',
            'slug' => 'jam-tangan-pintar-minimalis',
            'description' => 'Jam tangan pintar premium dengan desain ramping untuk melacak kebugaran, tidur, dan notifikasi Anda. Dilengkapi baterai tahan 7 hari.',
            'price' => 189.50,
            'stock' => 8,
            'is_active' => true,
        ]);

        \App\Models\Product::create([
            'category_id' => $apparel->id,
            'name' => 'Mantel Katun Klasik',
            'slug' => 'mantel-katun-klasik',
            'description' => 'Mantel trench tahan air klasik yang dibuat dari katun organik pilihan. Sangat cocok untuk gaya berpakaian berlapis Anda.',
            'price' => 145.00,
            'stock' => 22,
            'is_active' => true,
        ]);

        \App\Models\Product::create([
            'category_id' => $apparel->id,
            'name' => 'Sweater Rajut Premium',
            'slug' => 'sweater-rajut-premium',
            'description' => 'Sweater rajut dari bahan wol premium yang sangat lembut, dirancang untuk kehangatan maksimal dan daya tahan lama.',
            'price' => 85.00,
            'stock' => 30,
            'is_active' => true,
        ]);

        \App\Models\Product::create([
            'category_id' => $home->id,
            'name' => 'Set Cangkir Kopi Keramik Matte',
            'slug' => 'set-cangkir-kopi-keramik-matte',
            'description' => 'Satu set berisi 4 cangkir keramik buatan tangan dengan nuansa warna alam yang hangat, dilapisi dengan lapisan matte yang halus.',
            'price' => 34.00,
            'stock' => 50,
            'is_active' => true,
        ]);

        \App\Models\Product::create([
            'category_id' => $home->id,
            'name' => 'Lampu Meja Minimalis',
            'slug' => 'lampu-meja-minimalis',
            'description' => 'Lampu meja dengan cahaya hangat yang nyaman, menggunakan kaki kayu ek kokoh dan kap kaca buram. Dilengkapi kontrol peredup cahaya.',
            'price' => 59.99,
            'stock' => 12,
            'is_active' => true,
        ]);
    }
}
