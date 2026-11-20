<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database with demo data (idempotent).
     */
    public function run(): void
    {
        // Demo account: password comes from the UserFactory default.
        User::firstOrCreate(
            ['email' => 'test@example.com'],
            User::factory()->make(['name' => 'Test User', 'email' => 'test@example.com'])->getAttributes()
        );

        $catalog = [
            'Electronics' => [
                ['Wireless Mouse', 'ELE-001', 18.90, 45],
                ['Mechanical Keyboard', 'ELE-002', 74.50, 20],
                ['USB-C Hub', 'ELE-003', 32.00, 33],
                ['27" Monitor', 'ELE-004', 219.99, 8],
            ],
            'Office Supplies' => [
                ['A4 Paper Ream', 'OFF-001', 4.75, 120],
                ['Ballpoint Pens (box of 50)', 'OFF-002', 9.20, 60],
                ['Desk Organizer', 'OFF-003', 12.40, 25],
            ],
            'Furniture' => [
                ['Ergonomic Chair', 'FUR-001', 159.00, 12],
                ['Standing Desk', 'FUR-002', 329.00, 6],
            ],
            'Cleaning' => [
                ['Disinfectant 1L', 'CLE-001', 3.90, 80],
                ['Microfiber Cloths (pack of 10)', 'CLE-002', 6.50, 40],
            ],
        ];

        foreach ($catalog as $categoryName => $products) {
            $category = Category::firstOrCreate(['name' => $categoryName]);

            foreach ($products as [$name, $sku, $price, $stock]) {
                Product::firstOrCreate(
                    ['sku' => $sku],
                    ['category_id' => $category->id, 'name' => $name, 'price' => $price, 'stock' => $stock]
                );
            }
        }
    }
}
