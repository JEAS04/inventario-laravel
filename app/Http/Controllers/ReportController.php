<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Response;

class ReportController extends Controller
{
    public function inventory(): Response
    {
        $products = Product::with('category')->orderBy('name')->get();

        $pdf = Pdf::loadView('reports.inventory', [
            'products' => $products,
            'totalValue' => $products->sum(fn ($p) => $p->price * $p->stock),
            'generatedAt' => now(),
        ]);

        return $pdf->download('informe-inventario.pdf');
    }
}
