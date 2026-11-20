<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    Signed in as <span class="font-semibold">{{ auth()->user()->name }}</span>
                    ({{ auth()->user()->email }})
                </div>
            </div>

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-3">
                <div class="bg-white shadow-sm sm:rounded-lg p-6">
                    <p class="text-sm text-gray-500">Categories</p>
                    <p class="text-3xl font-semibold">{{ $categoryCount }}</p>
                </div>
                <div class="bg-white shadow-sm sm:rounded-lg p-6">
                    <p class="text-sm text-gray-500">Products</p>
                    <p class="text-3xl font-semibold">{{ $productCount }}</p>
                </div>
                <div class="bg-white shadow-sm sm:rounded-lg p-6">
                    <p class="text-sm text-gray-500">Units in stock</p>
                    <p class="text-3xl font-semibold">{{ $totalStock }}</p>
                </div>
            </div>

            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <h3 class="font-semibold text-gray-800">Inventory value</h3>
                <p class="mb-4 text-xs text-gray-500">Prices are stored in USD. Rates from open.er-api.com.</p>
                @if ($exchange)
                    <div class="grid grid-cols-2 gap-4 sm:grid-cols-4">
                        <div>
                            <p class="text-sm text-gray-500">USD</p>
                            <p class="text-xl font-semibold">{{ number_format($inventoryValue, 2) }}</p>
                        </div>
                        @foreach ($exchange['rates'] as $code => $rate)
                            <div>
                                <p class="text-sm text-gray-500">{{ $code }}</p>
                                <p class="text-xl font-semibold">{{ number_format($inventoryValue * $rate, 2) }}</p>
                            </div>
                        @endforeach
                    </div>
                    @if ($exchange['updated_at'])
                        <p class="mt-3 text-xs text-gray-400">Rates updated: {{ $exchange['updated_at'] }}</p>
                    @endif
                @else
                    <p class="text-sm text-amber-700">Exchange rates are temporarily unavailable.</p>
                @endif
            </div>

            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <h3 class="mb-4 font-semibold text-gray-800">Stock by category</h3>
                @if (count($chart['labels']))
                    <canvas id="stock-chart" data-chart='@json($chart)' height="100"></canvas>
                @else
                    <p class="text-sm text-gray-500">No data yet. Add categories and products to see the chart.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
