<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Category::create([
            'name' => 'Makanan',
            'description' => 'Produk yang ber jenis makanan ringan seperti snack dan keripik',
            "image" => "https://images.unsplash.com/photo-1614735241165-6756e1df61ab?q=80&w=1932&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
        ]);
        Category::create([
            "name" => "Minuman",
            "description" => "Produk ber jenis minuman seperti soda kaleng, dan minuman botol",
            "image" => "https://images.unsplash.com/photo-1452725210141-07dda20225ec?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTF8fGRyaW5rc3xlbnwwfHwwfHx8MA%3D%3D",
        ]);
        Category::create([
            "name" => "Bumbu",
            "description" => "Produk ber jenis bumbu masakan seperti merica bubuk, gula, ketumbar",
            "image" => "https://images.unsplash.com/photo-1509358271058-acd22cc93898?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTR8fHNwaWNlfGVufDB8fDB8fHww",
        ]);
        Category::create([
            "name" => "Perlengkapan Kebersihan",
            "description" => "Produk ber jenis sabun cuci piring, sabun cuci baju, shampoo, deterjen",
            "image" => "https://plus.unsplash.com/premium_photo-1679920025550-75324e59680f?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NjV8fGNsZWFuaW5nJTIwdG9vbHxlbnwwfHwwfHx8MA%3D%3D",
        ]);
        Category::create([
            "name" => "Mainan",
            "description" => "Produk ber jenis mainan seperti kelereng, tanah liat, mobil mobilan",
            "image" => "https://images.unsplash.com/photo-1599623560574-39d485900c95?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8VG95c3xlbnwwfHwwfHx8MA%3D%3D",
        ]);
        Category::create([
            "name" => "Perlengkapan Sekolah",
            "description" => "Produk berupa alat tulis, buku, serutan",
            "image" => "https://plus.unsplash.com/premium_photo-1663956148012-52c4b284dbca?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NXx8U2Nob29sJTIwdG9vbHN8ZW58MHx8MHx8fDA%3D",
        ]);
        Category::create([
            "name" => "Elektronik",
            "description" => "Aneka macam elektronik seperti baterai, lampu",
            "image" => null,
        ]);
    }
}
