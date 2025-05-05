<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected static $productPool = [];

    public function definition(): array
    {
        if (empty(self::$productPool)) {
            self::$productPool = collect([
                ['name' => 'Smartphone Samsung Galaxy A14', 'price' => 2499000],
                ['name' => 'Laptop ASUS VivoBook 14', 'price' => 6999000],
                ['name' => 'Headphone Sony WH-CH510', 'price' => 599000],
                ['name' => 'Smartwatch Xiaomi Mi Band 8', 'price' => 499000],
                ['name' => 'Kaos Polos Pria Katun', 'price' => 79000],
                ['name' => 'Jaket Hoodie Wanita', 'price' => 189000],
                ['name' => 'Kemeja Flanel Lengan Panjang', 'price' => 129000],
                ['name' => 'Kopi Arabika Gayo 200g', 'price' => 55000],
                ['name' => 'Coklat Batang Belgia 100g', 'price' => 35000],
                ['name' => 'Keripik Pisang Balado 250g', 'price' => 30000],
                ['name' => 'Set Pisau Dapur Stainless', 'price' => 99000],
                ['name' => 'Kompor Gas Portable', 'price' => 199000],
                ['name' => 'Dispenser Air Mini', 'price' => 159000],
                ['name' => 'Power Bank 10000mAh', 'price' => 149000],
                ['name' => 'Bluetooth Speaker JBL Go 3', 'price' => 399000],
            ])->shuffle()->toArray(); // diacak supaya urutan random
        }

        $product = array_pop(self::$productPool);

        return [
            'sku' => 'SKU-' . strtoupper(Str::random(6)),
            'name' => $product['name'],
            'description' => $this->faker->sentence(8),
            'price' => $product['price'],
            'stock' => $this->faker->numberBetween(10, 200),
            'is_active' => $this->faker->boolean(90),
        ];
    }
}
