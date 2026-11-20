<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Models\Category;
use App\Models\Product;
use App\Services\ExchangeRateService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function (ExchangeRateService $exchange) {
    $categories = Category::withSum('products', 'stock')->orderBy('name')->get();
    $inventoryValue = (float) Product::query()->sum(DB::raw('price * stock'));

    return view('dashboard', [
        'inventoryValue' => $inventoryValue,
        'exchange' => $exchange->latest(['COP', 'EUR', 'MXN']),
        'categoryCount' => $categories->count(),
        'productCount' => Product::count(),
        'totalStock' => (int) Product::sum('stock'),
        'chart' => [
            'labels' => $categories->pluck('name')->all(),
            'values' => $categories->map(fn ($c) => (int) $c->products_sum_stock)->all(),
        ],
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('reports/inventory', [ReportController::class, 'inventory'])->name('reports.inventory');
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
