<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Supplements',
                'description' => 'Protein powders, pre-workout, vitamins, and nutritional supplements',
            ],
            [
                'name' => 'Gym Apparel',
                'description' => 'Workout clothes, shoes, and athletic wear',
            ],
            [
                'name' => 'Equipment',
                'description' => 'Gym accessories, resistance bands, yoga mats, and training equipment',
            ],
            [
                'name' => 'Drinks',
                'description' => 'Sports drinks, protein shakes, and energy drinks',
            ],
            [
                'name' => 'Accessories',
                'description' => 'Gym bags, water bottles, towels, and other accessories',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        echo "✅ " . count($categories) . " store categories created\n";
    }
}