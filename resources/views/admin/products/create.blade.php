<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Product</title>
    {{-- Mantener la librería Choices.js --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
    {{-- Cargar tu CSS/SCSS (Vite se encarga de compilarlo) --}}
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
</head>
<x-app-layout>
    <x-slot name="header">
        <div class="header">
            <div class="container">
                <h2 class="page-title">
                    {{ __('Create Product') }}
                </h2>
                <p>Formulario para añadir un nuevo producto al inventario.</p>
            </div>
        </div>
    </x-slot>

    <div class="form-container">
        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="product-form">
            @csrf

            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" placeholder="Nombre de la zapatilla" required>
            </div>

            <div class="form-group">
                <label for="description">Description:</label>
                <textarea name="description" placeholder="Descripción detallada del producto"></textarea>
            </div>

            <div class="form-row"> 
                <div class="form-group">
                    <label for="price">Price:</label>
                    <input type="number" name="price" placeholder="Precio (ej: 99.99)" step="0.01" required>
                </div>

                <div class="form-group">
                    <label for="stock">Stock:</label>
                    <input type="number" name="stock" placeholder="Cantidad en inventario">
                </div>
            </div>

            <div class="form-group">
                <label for="img">Image:</label>
                <input type="file" name="img" class="input-file-custom">
            </div>

            <div class="form-group">
                <label for="categories">Categorías:</label>
                <select id="categories" name="categories[]" multiple>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div class="form-actions mt-2">
                <a href="{{ route('products.index') }}" class="btn btn-secondary">Back to list</a>
                <button type="submit" class="btn btn-primary">
                    Save Product
                </button>
            </div>
        </form>
    </div>

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