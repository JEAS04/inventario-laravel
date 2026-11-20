<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductApiController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $products = Product::with('category')
            ->when($request->query('category_id'), fn ($q, $id) => $q->where('category_id', $id))
            ->orderBy('name')
            ->paginate(20);

        return response()->json($products->through(fn (Product $p) => $this->format($p)));
    }

    public function show(Product $product): JsonResponse
    {
        return response()->json($this->format($product->load('category')));
    }

    private function format(Product $product): array
    {
        return [
            'id' => $product->id,
            'name' => $product->name,
            'sku' => $product->sku,
            'description' => $product->description,
            'price' => (float) $product->price,
            'stock' => $product->stock,
            'image_url' => $product->image ? asset('storage/'.$product->image) : null,
            'category' => [
                'id' => $product->category->id,
                'name' => $product->category->name,
            ],
        ];
    }
}
