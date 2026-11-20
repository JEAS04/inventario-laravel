@csrf

<div>
    <x-input-label for="category_id" value="Categoría" />
    <select id="category_id" name="category_id" required
        class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
        <option value="">Seleccione una categoría</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id ?? '') == $category->id)>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
    <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
</div>

<div class="mt-4">
    <x-input-label for="name" value="Nombre" />
    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
        :value="old('name', $product->name ?? '')" required />
    <x-input-error :messages="$errors->get('name')" class="mt-2" />
</div>

<div class="mt-4">
    <x-input-label for="sku" value="SKU (código)" />
    <x-text-input id="sku" name="sku" type="text" class="mt-1 block w-full"
        :value="old('sku', $product->sku ?? '')" required />
    <x-input-error :messages="$errors->get('sku')" class="mt-2" />
</div>

<div class="mt-4 grid grid-cols-2 gap-4">
    <div>
        <x-input-label for="price" value="Precio (USD)" />
        <x-text-input id="price" name="price" type="number" step="0.01" min="0" class="mt-1 block w-full"
            :value="old('price', $product->price ?? '')" required />
        <x-input-error :messages="$errors->get('price')" class="mt-2" />
    </div>
    <div>
        <x-input-label for="stock" value="Existencias" />
        <x-text-input id="stock" name="stock" type="number" min="0" class="mt-1 block w-full"
            :value="old('stock', $product->stock ?? 0)" required />
        <x-input-error :messages="$errors->get('stock')" class="mt-2" />
    </div>
</div>

<div class="mt-4">
    <x-input-label for="description" value="Descripción" />
    <textarea id="description" name="description" rows="3"
        class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('description', $product->description ?? '') }}</textarea>
    <x-input-error :messages="$errors->get('description')" class="mt-2" />
</div>

<div class="mt-4">
    <x-input-label for="image" value="Imagen (JPG, PNG o WebP, máximo 2 MB)" />
    @if (!empty($product->image))
        <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}"
            class="mt-2 h-24 w-24 rounded-md object-cover">
    @endif
    <input id="image" name="image" type="file" accept="image/png,image/jpeg,image/webp" class="mt-2 block w-full text-sm">
    <x-input-error :messages="$errors->get('image')" class="mt-2" />
</div>

<div class="mt-6 flex items-center gap-3">
    <x-primary-button>Guardar</x-primary-button>
    <a href="{{ route('products.index') }}" class="text-sm text-gray-600 hover:underline">Cancelar</a>
</div>
