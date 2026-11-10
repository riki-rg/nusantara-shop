<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $categories = collect(['Kopi & Teh', 'Makanan', 'Kerajinan', 'Fashion', 'Kesehatan'])
            ->mapWithKeys(fn ($name) => [$name => Category::create([
                'name' => $name,
                'slug' => Str::slug($name),
            ])]);

        $products = [
            ['Kopi Gayo Aceh 250g', 'Kopi & Teh', 85000, 40, 10, 'Kopi arabika single origin dari dataran tinggi Gayo.'],
            ['Kopi Toraja Sapan 250g', 'Kopi & Teh', 95000, 25, 0, 'Kopi arabika dengan karakter earthy dan body tebal.'],
            ['Kopi Lampung Robusta 500g', 'Kopi & Teh', 68000, 60, 15, 'Robusta lampung, cocok untuk kopi susu.'],
            ['Teh Melati Premium 100g', 'Kopi & Teh', 32000, 80, 0, 'Teh melati wangi asli dari Jawa Barat.'],
            ['Keripik Singkong Balado 200g', 'Makanan', 22000, 100, 20, 'Keripik singkong pedas manis khas Padang.'],
            ['Madu Hutan Murni 500ml', 'Kesehatan', 135000, 15, 0, 'Madu alami hasil panen hutan Kalimantan.'],
            ['Selendang Batik Tulis Pekalongan', 'Fashion', 285000, 8, 0, 'Selendang batik tulis motif jlamprang.'],
            ['Kaos Batik Cap Modern', 'Fashion', 125000, 30, 25, 'Kaos dengan motif batik cap kontemporer.'],
            ['Anyaman Bambu Tempat Pensil', 'Kerajinan', 45000, 50, 0, 'Kerajinan tangan anyaman bambu dari Jogja.'],
            ['Gantungan Kunci Kayu Jati', 'Kerajinan', 18000, 120, 10, 'Gantungan kunci ukir kayu jati asli.'],
        ];

        foreach ($products as [$name, $cat, $price, $stock, $disc, $desc]) {
            Product::create([
                'category_id' => $categories[$cat]->id,
                'name' => $name,
                'slug' => Str::slug($name),
                'description' => $desc,
                'price_cents' => $price * 100,
                'discount_percent' => $disc,
                'stock' => $stock,
            ]);
        }
    }
}
