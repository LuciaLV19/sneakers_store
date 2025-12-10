<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Products</title>
</head>

<x-app-layout>
    <x-slot name="header">
        <h1>
            {{ __('Products') }}
        </h1>
    </x-slot>

    <div class="container">
        <div class="top-actions">
            <a href="{{ route('products.create') }}" class="button-create">
                Create Product
            </a>
        </div>
        <div class="table-wrapper">
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Image</th>
                    <th>Categories</th>
                    <th>Actions</th>
                </tr>
            </thead>
        </div>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td class="description">{{ $product->description }}</td>
                        <td class="price">{{ $product->price }}€</td>
                        <td>
                            @php
                                // Lógica para asignar la clase de stock: 'stock-in' o 'stock-out'
                                $stockClass = $product->stock > 0 ? 'stock-in' : 'stock-out';
                            @endphp
                            {{-- APLICAR CLASE: Usamos la clase condicional para el badge de stock --}}
                            <span class="{{ $stockClass }}">
                                {{ $product->stock }}
                            </span>
                        </td>
                            
                        <td>
                            @if($product->img)
                                <img src="{{ asset('storage/' . $product->img) }}" class="product-thumb" alt="{{ $product->name }}">
                            @else
                                <span class="text-muted" style="font-style: italic; font-size: 0.875rem;">No image</span>
                            @endif
                        </td>
                            
                            <td class="text-muted">
                                {{ $product->categories?->pluck('name')->implode(', ') ?? '-' }}
                            </td>
                            
                            <td class="actions">
                                <a href="{{ route('products.edit', $product->id) }}" class="button-edit">Edit</a>
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="button-delete">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>