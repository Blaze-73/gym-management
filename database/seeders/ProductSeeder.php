<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            // Supplements
            [
                'category_id' => 1,
                'name' => 'Whey Protein Powder 2kg',
                'description' => 'Premium whey protein isolate for muscle growth and recovery',
                'price' => 49.99,
                'stock' => 50,
                'status' => 'active',
            ],
            [
                'category_id' => 1,
                'name' => 'Pre-Workout Energy Boost',
                'description' => 'High-energy pre-workout formula with caffeine and beta-alanine',
                'price' => 29.99,
                'stock' => 30,
                'status' => 'active',
            ],
            [
                'category_id' => 1,
                'name' => 'BCAA Recovery Formula',
                'description' => 'Branched-chain amino acids for muscle recovery',
                'price' => 24.99,
                'stock' => 40,
                'status' => 'active',
            ],
            [
                'category_id' => 1,
                'name' => 'Creatine Monohydrate 500g',
                'description' => 'Pure creatine for strength and power',
                'price' => 19.99,
                'stock' => 60,
                'status' => 'active',
            ],

            // Gym Apparel
            [
                'category_id' => 2,
                'name' => 'Performance Gym T-Shirt',
                'description' => 'Moisture-wicking athletic t-shirt',
                'price' => 19.99,
                'stock' => 100,
                'status' => 'active',
            ],
            [
                'category_id' => 2,
                'name' => 'Compression Training Shorts',
                'description' => 'Flexible compression shorts for intense workouts',
                'price' => 29.99,
                'stock' => 80,
                'status' => 'active',
            ],
            [
                'category_id' => 2,
                'name' => 'Gym Hoodie',
                'description' => 'Comfortable cotton-blend hoodie',
                'price' => 39.99,
                'stock' => 50,
                'status' => 'active',
            ],

            // Equipment
            [
                'category_id' => 3,
                'name' => 'Resistance Bands Set',
                'description' => '5-piece resistance band set with different strengths',
                'price' => 24.99,
                'stock' => 40,
                'status' => 'active',
            ],
            [
                'category_id' => 3,
                'name' => 'Yoga Mat Premium',
                'description' => 'Non-slip premium yoga mat with carrying strap',
                'price' => 34.99,
                'stock' => 30,
                'status' => 'active',
            ],
            [
                'category_id' => 3,
                'name' => 'Lifting Gloves',
                'description' => 'Padded weight-lifting gloves with wrist support',
                'price' => 14.99,
                'stock' => 60,
                'status' => 'active',
            ],
            [
                'category_id' => 3,
                'name' => 'Jump Rope Speed',
                'description' => 'Adjustable speed jump rope for cardio',
                'price' => 9.99,
                'stock' => 70,
                'status' => 'active',
            ],

            // Drinks
            [
                'category_id' => 4,
                'name' => 'Sports Drink 500ml',
                'description' => 'Electrolyte-enhanced sports drink',
                'price' => 2.99,
                'stock' => 200,
                'status' => 'active',
            ],
            [
                'category_id' => 4,
                'name' => 'Energy Drink',
                'description' => 'Sugar-free energy drink',
                'price' => 3.49,
                'stock' => 150,
                'status' => 'active',
            ],
            [
                'category_id' => 4,
                'name' => 'Protein Shake Ready-to-Drink',
                'description' => '25g protein ready-to-drink shake',
                'price' => 4.99,
                'stock' => 100,
                'status' => 'active',
            ],

            // Accessories
            [
                'category_id' => 5,
                'name' => 'Gym Bag Large',
                'description' => 'Spacious gym bag with multiple compartments',
                'price' => 44.99,
                'stock' => 25,
                'status' => 'active',
            ],
            [
                'category_id' => 5,
                'name' => 'Water Bottle 1L',
                'description' => 'BPA-free sports water bottle',
                'price' => 12.99,
                'stock' => 80,
                'status' => 'active',
            ],
            [
                'category_id' => 5,
                'name' => 'Microfiber Gym Towel',
                'description' => 'Quick-dry microfiber towel',
                'price' => 9.99,
                'stock' => 100,
                'status' => 'active',
            ],
            [
                'category_id' => 5,
                'name' => 'Wireless Earbuds',
                'description' => 'Sweat-proof wireless earbuds for workouts',
                'price' => 59.99,
                'stock' => 20,
                'status' => 'active',
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }

        echo "✅ " . count($products) . " products created\n";
    }
}