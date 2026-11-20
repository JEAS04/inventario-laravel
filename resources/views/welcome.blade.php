<x-public-layout>
    <section class="bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 text-center">
            <h1 class="text-4xl sm:text-5xl font-bold tracking-tight text-gray-900">
                Keep your inventory under control
            </h1>
            <p class="mt-6 max-w-2xl mx-auto text-lg text-gray-600">
                Manage categories and products, track stock levels, generate PDF reports and see the value of your
                inventory in several currencies, all in one place.
            </p>
            <div class="mt-10 flex flex-wrap items-center justify-center gap-4">
                @auth
                    <a href="{{ route('dashboard') }}"
                        class="inline-flex items-center px-6 py-3 bg-indigo-600 rounded-md font-semibold text-sm text-white hover:bg-indigo-500">
                        Go to dashboard
                    </a>
                @else
                    <a href="{{ route('register') }}"
                        class="inline-flex items-center px-6 py-3 bg-indigo-600 rounded-md font-semibold text-sm text-white hover:bg-indigo-500">
                        Get started
                    </a>
                    <a href="{{ route('login') }}"
                        class="inline-flex items-center px-6 py-3 bg-white border border-gray-300 rounded-md font-semibold text-sm text-gray-700 hover:bg-gray-50">
                        Log in
                    </a>
                @endauth
            </div>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <h2 class="text-center text-2xl font-semibold text-gray-900">Everything you need</h2>
        <div class="mt-10 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h3 class="font-semibold text-gray-900">Products &amp; categories</h3>
                <p class="mt-2 text-sm text-gray-600">Create, edit and organize your catalog, with a photo for every product.</p>
            </div>
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h3 class="font-semibold text-gray-900">Live dashboard</h3>
                <p class="mt-2 text-sm text-gray-600">Stock by category at a glance, with charts and key totals.</p>
            </div>
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h3 class="font-semibold text-gray-900">PDF reports</h3>
                <p class="mt-2 text-sm text-gray-600">Download an inventory report with the total value of your stock.</p>
            </div>
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h3 class="font-semibold text-gray-900">Open API</h3>
                <p class="mt-2 text-sm text-gray-600">
                    Read your catalog from other apps through the
                    <a href="{{ url('/api/products') }}" class="text-indigo-600 hover:underline">products endpoint</a>.
                </p>
            </div>
        </div>
    </section>
</x-public-layout>
