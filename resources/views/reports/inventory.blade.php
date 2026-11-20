<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Inventory report</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; color: #111827; }
        h1 { font-size: 20px; margin-bottom: 4px; }
        .meta { color: #6b7280; margin-bottom: 16px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #d1d5db; padding: 6px 8px; text-align: left; }
        th { background: #f3f4f6; }
        .num { text-align: right; }
        tfoot td { font-weight: bold; }
    </style>
</head>
<body>
    <h1>Inventory report</h1>
    <p class="meta">Generated {{ $generatedAt->format('Y-m-d H:i') }}</p>

    <table>
        <thead>
            <tr>
                <th>SKU</th>
                <th>Name</th>
                <th>Category</th>
                <th class="num">Price</th>
                <th class="num">Stock</th>
                <th class="num">Value</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $product)
                <tr>
                    <td>{{ $product->sku }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category->name }}</td>
                    <td class="num">{{ number_format($product->price, 2) }}</td>
                    <td class="num">{{ $product->stock }}</td>
                    <td class="num">{{ number_format($product->price * $product->stock, 2) }}</td>
                </tr>
            @empty
                <tr><td colspan="6">No products registered.</td></tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <td colspan="5">Total inventory value</td>
                <td class="num">{{ number_format($totalValue, 2) }}</td>
            </tr>
        </tfoot>
    </table>
</body>
</html>
