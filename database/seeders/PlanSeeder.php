<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $plans = [
            [
                'name' => 'Basic Monthly',
                'price' => 169.99,
                'duration' => 30,
            ],
            [
                'name' => 'Premium Monthly',
                'price' => 249.99,
                'duration' => 30,
            ],
            [
                'name' => 'Annual VIP',
                'price' => 1499.99,
                'duration' => 365,
            ],
            [
                'name' => 'Weekly Pass',
                'price' => 49.99,
                'duration' => 7,
            ],
        ];

        foreach ($plans as $plan) {
            Plan::create($plan);
        }

        echo "✅ " . count($plans) . " gym plans created\n";
    }
}