<x-public-layout>
    <section class="bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 text-center">
            <h1 class="text-4xl sm:text-5xl font-bold tracking-tight text-gray-900">
                Mantenga su inventario bajo control
            </h1>
            <p class="mt-6 max-w-2xl mx-auto text-lg text-gray-600">
                Administre categorías y productos, controle las existencias, genere informes en PDF y consulte el valor
                de su inventario en varias monedas, todo en un solo lugar.
            </p>
            <div class="mt-10 flex flex-wrap items-center justify-center gap-4">
                @auth
                    <a href="{{ route('dashboard') }}"
                        class="inline-flex items-center px-6 py-3 bg-indigo-600 rounded-md font-semibold text-sm text-white hover:bg-indigo-500">
                        Ir al panel
                    </a>
                @else
                    <a href="{{ route('register') }}"
                        class="inline-flex items-center px-6 py-3 bg-indigo-600 rounded-md font-semibold text-sm text-white hover:bg-indigo-500">
                        Comenzar
                    </a>
                    <a href="{{ route('login') }}"
                        class="inline-flex items-center px-6 py-3 bg-white border border-gray-300 rounded-md font-semibold text-sm text-gray-700 hover:bg-gray-50">
                        Iniciar sesión
                    </a>
                @endauth
            </div>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <h2 class="text-center text-2xl font-semibold text-gray-900">Todo lo que necesita</h2>
        <div class="mt-10 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h3 class="font-semibold text-gray-900">Productos y categorías</h3>
                <p class="mt-2 text-sm text-gray-600">Cree, edite y organice su catálogo, con una foto para cada producto.</p>
            </div>
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h3 class="font-semibold text-gray-900">Panel en tiempo real</h3>
                <p class="mt-2 text-sm text-gray-600">Las existencias por categoría de un vistazo, con gráficos y totales clave.</p>
            </div>
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h3 class="font-semibold text-gray-900">Informes en PDF</h3>
                <p class="mt-2 text-sm text-gray-600">Descargue un informe del inventario con el valor total de las existencias.</p>
            </div>
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h3 class="font-semibold text-gray-900">API abierta</h3>
                <p class="mt-2 text-sm text-gray-600">
                    Consulte su catálogo desde otras aplicaciones con el
                    <a href="{{ url('/api/products') }}" class="text-indigo-600 hover:underline">endpoint de productos</a>.
                </p>
            </div>
        </div>
    </section>
</x-public-layout>
