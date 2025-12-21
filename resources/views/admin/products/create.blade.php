<x-app-layout>
    {{-- Librerías específicas para este formulario --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>

    <div class="admin-dashboard-layout">
        @include('admin.partials.sidebar')

        <main class="main-content">
            {{-- Encabezado profesionalizado --}}
            <h2 class="admin-title">Crear Producto</h2>

            <div class="container">
                <div class="form-card"> 
                    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="name">Nombre:</label>
                            <input type="text" name="name" id="name" placeholder="Nombre de la zapatilla" value="{{ old('name') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="description">Descripción:</label>
                            <textarea name="description" id="description" placeholder="Descripción detallada del producto">{{ old('description') }}</textarea>
                        </div>

                        {{-- Mantenemos tu form-row pero profesionalizado --}}
                        <div class="form-row"> 
                            <div class="form-group">
                                <label for="price">Precio:</label>
                                <input type="number" name="price" id="price" placeholder="99.99" step="0.01" value="{{ old('price') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="stock">Stock:</label>
                                <input type="number" name="stock" id="stock" placeholder="Cantidad" value="{{ old('stock') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="categories">Categorías:</label>
                            <select id="categories" name="categories[]" multiple>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="img">Imagen:</label>
                            <input type="file" name="img" id="img" class="input-file-custom">
                        </div>
                        
                        <div class="form-actions">
                            <a href="{{ route('admin.products.index') }}" class="btn-back">Volver al listado</a>
                            <button type="submit" class="btn">
                                Guardar Producto
                            </button>
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