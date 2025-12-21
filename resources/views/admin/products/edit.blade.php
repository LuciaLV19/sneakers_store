<x-app-layout>
    {{-- Librerías específicas --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>

    <div class="admin-dashboard-layout">
        @include('admin.partials.sidebar')

        <main class="main-content">
            {{-- Encabezado igualado --}}
            <div class="top-actions">
                <h2 class="admin-title">Editar Producto</h2>
                
            </div>

            <div class="container">
                <div class="form-card"> 
                    <p class="form-info">Modificando: <span style="color: var(--brand-primary); font-weight: bold">{{ $product->name }}</span></p>

                    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group">
                            <label for="name">Nombre:</label>
                            <input type="text" name="name" id="name" placeholder="Nombre del Producto" 
                                   value="{{ old('name', $product->name) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="description">Descripción:</label>
                            <textarea name="description" id="description" placeholder="Descripción detallada">{{ old('description', $product->description) }}</textarea>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="price">Precio:</label>
                                <input type="number" name="price" id="price" placeholder="Precio" step="0.01" 
                                       value="{{ old('price', $product->price) }}" required>
                            </div>

                            <div class="form-group">
                                <label for="stock">Stock:</label>
                                <input type="number" name="stock" id="stock" placeholder="Inventario" 
                                       value="{{ old('stock', $product->stock) }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="img">Imagen del Producto:</label>
                            <input type="file" name="img" id="img" class="input-file-custom">
                            
                            @if ($product->img)
                                <div class="image-preview-wrapper" style="margin-top: 1rem; display: flex; align-items: center; gap: 1rem;">
                                    <span class="text-muted" style="font-size: 0.85rem;">Imagen actual:</span>
                                    <img src="{{ asset('storage/' . $product->img) }}" 
                                         style="width: 60px; height: 60px; object-fit: cover; border-radius: 0.5rem; border: 1px solid var(--border-color);" 
                                         alt="{{ $product->name }}">
                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="categories">Categorías:</label>
                            <select id="categories" name="categories[]" multiple>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ $product->categories->contains($category->id) ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-actions">
                            <a href="{{ route('admin.products.index') }}" class="btn-back">Volver al listado</a>
                            <button type="submit" class="btn">Actualizar Producto</button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
    
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const categoriesSelect = document.getElementById('categories');
        if (categoriesSelect) {
            new Choices(categoriesSelect, {
                removeItemButton: true, 
                searchEnabled: true,
                shouldSort: false,
                placeholderValue: 'Selecciona categorías'
            });
        }
    });
    </script>
</x-app-layout>