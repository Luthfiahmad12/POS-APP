<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'sku' => 'SKU-' . strtoupper(Str::random(6)),
                'name' => 'Espresso',
                'price' => 18000,
                'description' => 'Pure coffee extract with a rich crema.',
                'stock' => 50,
                'is_active' => true,
            ],
            [
                'sku' => 'SKU-' . strtoupper(Str::random(6)),
                'name' => 'Cappuccino',
                'price' => 22000,
                'description' => 'Espresso with steamed milk and soft foam.',
                'stock' => 45,
                'is_active' => true,
            ],
            [
                'sku' => 'SKU-' . strtoupper(Str::random(6)),
                'name' => 'Latte',
                'price' => 22000,
                'description' => 'Espresso with more steamed milk.',
                'stock' => 60,
                'is_active' => true,
            ],
            [
                'sku' => 'SKU-' . strtoupper(Str::random(6)),
                'name' => 'Americano',
                'price' => 18000,
                'description' => 'Espresso added with hot water.',
                'stock' => 55,
                'is_active' => true,
            ],
            [
                'sku' => 'SKU-' . strtoupper(Str::random(6)),
                'name' => 'Mocha',
                'price' => 25000,
                'description' => 'Espresso with chocolate and steamed milk.',
                'stock' => 40,
                'is_active' => true,
            ],
            [
                'sku' => 'SKU-' . strtoupper(Str::random(6)),
                'name' => 'Tubruk Coffee',
                'price' => 15000,
                'description' => 'Ground coffee directly brewed with hot water.',
                'stock' => 70,
                'is_active' => true,
            ],
            [
                'sku' => 'SKU-' . strtoupper(Str::random(6)),
                'name' => 'Teh Tarik',
                'price' => 18000,
                'description' => 'Pulled milk tea until foamy.',
                'stock' => 35,
                'is_active' => true,
            ],
            [
                'sku' => 'SKU-' . strtoupper(Str::random(6)),
                'name' => 'Sweet Iced Tea',
                'price' => 12000,
                'description' => 'Brewed black tea sweetened and served cold.',
                'stock' => 80,
                'is_active' => true,
            ],
            [
                'sku' => 'SKU-' . strtoupper(Str::random(6)),
                'name' => 'Chocolate Brownies',
                'price' => 28000,
                'description' => 'Soft and fudgy baked chocolate cake.',
                'stock' => 25,
                'is_active' => true,
            ],
            [
                'sku' => 'SKU-' . strtoupper(Str::random(6)),
                'name' => 'Cheese Toast',
                'price' => 20000,
                'description' => 'Toasted bread filled with melted cheese.',
                'stock' => 30,
                'is_active' => true,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
