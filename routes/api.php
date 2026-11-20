<?php

use App\Http\Controllers\Api\ProductApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Public, read-only endpoints consumable by external clients.
Route::middleware('throttle:60,1')->group(function () {
    Route::get('/products', [ProductApiController::class, 'index'])->name('api.products.index');
    Route::get('/products/{product}', [ProductApiController::class, 'show'])->name('api.products.show');
});
