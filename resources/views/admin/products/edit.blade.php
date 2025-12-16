<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Product</title>
    {{-- Mantener la librería Choices.js --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
    {{-- Cargar tu CSS/SCSS (Vite se encarga de compilarlo) --}}
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
</head>
<x-app-layout>
    <x-slot name="header">
        {{-- Usando tus clases .header y .container --}}
        <div class="header">
            <div class="container">
                <h2 class="page-title">
                    {{ __('Edit Product') }}
                </h2>
                <p>Modificando: {{ $product->name }}</p>
            </div>
        </div>
    </x-slot>

    {{-- Contenedor del Formulario que usa tu clase .form-container --}}
    <div class="form-container">
        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="product-form">
            @csrf
            @method('PUT')
            
            <div class="form-fields-group"> 
                
                {{-- CAMPO NOMBRE --}}
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" name="name" placeholder="Nombre del Producto" 
                           value="{{ old('name', $product->name) }}" required>
                </div>

                {{-- CAMPO DESCRIPCIÓN --}}
                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea name="description" placeholder="Descripción detallada">{{ old('description', $product->description) }}</textarea>
                </div>

                <div class="form-row">
                    {{-- CAMPO PRECIO --}}
                    <div class="form-group">
                        <label for="price">Price:</label>
                        <input type="number" name="price" placeholder="Precio" step="0.01" 
                               value="{{ old('price', $product->price) }}" required>
                    </div>

                    {{-- CAMPO STOCK --}}
                    <div class="form-group">
                        <label for="stock">Stock:</label>
                        <input type="number" name="stock" placeholder="Inventario" 
                               value="{{ old('stock', $product->stock) }}">
                    </div>
                </div>

                {{-- CAMPO IMAGEN --}}
                <div class="form-group">
                    <label for="img" class="mb-1">Image:</label>
                    <input type="file" name="img" class="input-file-custom">
                    
                    {{-- PREVISUALIZACIÓN DE IMAGEN ACTUAL --}}
                    @if ($product->img)
                        <div class="image-preview-wrapper mt-1">
                            <span class="text-muted">Current Image:</span>
                            <img src="{{ asset('storage/' . $product->img) }}" class="current-image" alt="{{ $product->name }}">
                        </div>
                    @endif
                </div>

                {{-- CAMPO CATEGORÍAS (CHOICES.JS) --}}
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
            </div>

            {{-- Contenedor de Acciones (justify-between) --}}
            <div class="form-actions actions-footer mt-2">
                <a href="{{ route('products.index') }}" class="btn btn-secondary">Back to list</a>
                <button type="submit" class="btn btn-primary">
                    Update Product
                </button>
            </div>
        </form>
    </div>
    
    {{-- SCRIPT DE CHOICES.JS (Mantenido) --}}
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const categoriesSelect = document.getElementById('categories');
        if (categoriesSelect) {
            new Choices(categoriesSelect, {
                removeItemButton: true, 
                searchEnabled: true,
                shouldSort: false
            });
        }
    });
    </script>
</x-app-layout>
</html>