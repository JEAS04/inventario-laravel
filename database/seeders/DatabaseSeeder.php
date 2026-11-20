<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database with demo data (idempotent).
     */
    public function run(): void
    {
        // Demo account: local default, or DEMO_USER_PASSWORD elsewhere (skipped if unset).
        $demoPassword = app()->isLocal() ? env('DEMO_USER_PASSWORD', 'password') : env('DEMO_USER_PASSWORD');

        if ($demoPassword) {
            User::firstOrCreate(
                ['email' => 'test@example.com'],
                ['name' => 'Test User', 'password' => Hash::make($demoPassword), 'email_verified_at' => now()]
            );
        }

        // Earlier demo data was created in English; rename it so it is not duplicated.
        $renamedCategories = [
            'Electronics' => 'Electrónica',
            'Office Supplies' => 'Papelería',
            'Furniture' => 'Muebles',
            'Cleaning' => 'Aseo',
        ];
        foreach ($renamedCategories as $old => $new) {
            Category::where('name', $old)->update(['name' => $new]);
        }

        $catalog = [
            'Electrónica' => [
                ['Mouse inalámbrico', 'ELE-001', 18.90, 45],
                ['Teclado mecánico', 'ELE-002', 74.50, 20],
                ['Hub USB-C', 'ELE-003', 32.00, 33],
                ['Monitor de 27"', 'ELE-004', 219.99, 8],
            ],
            'Papelería' => [
                ['Resma de papel carta', 'OFF-001', 4.75, 120],
                ['Bolígrafos (caja de 50)', 'OFF-002', 9.20, 60],
                ['Organizador de escritorio', 'OFF-003', 12.40, 25],
            ],
            'Muebles' => [
                ['Silla ergonómica', 'FUR-001', 159.00, 12],
                ['Escritorio ajustable', 'FUR-002', 329.00, 6],
            ],
            'Aseo' => [
                ['Desinfectante 1 L', 'CLE-001', 3.90, 80],
                ['Paños de microfibra (paquete de 10)', 'CLE-002', 6.50, 40],
            ],
        ];

        foreach ($catalog as $categoryName => $products) {
            $category = Category::firstOrCreate(['name' => $categoryName]);

            foreach ($products as [$name, $sku, $price, $stock]) {
                $product = Product::firstOrCreate(
                    ['sku' => $sku],
                    ['category_id' => $category->id, 'name' => $name, 'price' => $price, 'stock' => $stock]
                );

                // Existing demo rows keep their price and stock; only the name is translated.
                if (! $product->wasRecentlyCreated) {
                    $product->update(['name' => $name]);
                }
            }
        }
    }
}
