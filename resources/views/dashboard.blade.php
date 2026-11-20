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
                    Sesión iniciada como <span class="font-semibold">{{ auth()->user()->name }}</span>
                    ({{ auth()->user()->email }})
                </div>
            </div>

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-3">
                <div class="bg-white shadow-sm sm:rounded-lg p-6">
                    <p class="text-sm text-gray-500">Categorías</p>
                    <p class="text-3xl font-semibold">{{ $categoryCount }}</p>
                </div>
                <div class="bg-white shadow-sm sm:rounded-lg p-6">
                    <p class="text-sm text-gray-500">Productos</p>
                    <p class="text-3xl font-semibold">{{ $productCount }}</p>
                </div>
                <div class="bg-white shadow-sm sm:rounded-lg p-6">
                    <p class="text-sm text-gray-500">Unidades en existencia</p>
                    <p class="text-3xl font-semibold">{{ number_format($totalStock, 0, ',', '.') }}</p>
                </div>
            </div>

            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <h3 class="font-semibold text-gray-800">Valor del inventario</h3>
                <p class="mb-4 text-xs text-gray-500">Los precios están en USD. Tasas de cambio de open.er-api.com.</p>
                @if ($exchange)
                    <div class="grid grid-cols-2 gap-4 sm:grid-cols-4">
                        <div>
                            <p class="text-sm text-gray-500">USD</p>
                            <p class="text-xl font-semibold">{{ number_format($inventoryValue, 2, ',', '.') }}</p>
                        </div>
                        @foreach ($exchange['rates'] as $code => $rate)
                            <div>
                                <p class="text-sm text-gray-500">{{ $code }}</p>
                                <p class="text-xl font-semibold">{{ number_format($inventoryValue * $rate, 2, ',', '.') }}</p>
                            </div>
                        @endforeach
                    </div>
                    @if ($exchange['updated_at'])
                        <p class="mt-3 text-xs text-gray-400">
                            Tasas actualizadas: {{ \Illuminate\Support\Carbon::parse($exchange['updated_at'])->timezone(config('app.timezone'))->format('d/m/Y H:i') }}
                        </p>
                    @endif
                @else
                    <p class="text-sm text-amber-700">Las tasas de cambio no están disponibles en este momento.</p>
                @endif
            </div>

            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <h3 class="mb-4 font-semibold text-gray-800">Existencias por categoría</h3>
                @if (count($chart['labels']))
                    <canvas id="stock-chart" data-chart='@json($chart)' height="100"></canvas>
                @else
                    <p class="text-sm text-gray-500">Aún no hay datos. Agregue categorías y productos para ver el gráfico.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
