<x-app-layout>
    <div class="admin-container">
        {{-- Sidebar --}}
        @include('admin.partials.sidebar')

        {{-- Main Content --}}
        <div class="main-content">
                <h2 class="admin-title">Gestión de Productos</h2>
            <main class="container">
                <div class="actions">
                    <a href="{{ route('admin.products.create') }}" class="button-create">+ Nuevo Producto</a>
                </div>
                <div class="table-wrapper">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Precio</th>
                                <th>Stock</th>
                                <th>Imagen</th>
                                <th>Categorías</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td class="font-bold">{{ $product->name }}</td>
                                    <td class="description" title="{{ $product->description }}">
                                        {{ $product->description }}
                                    </td>
                                    <td class="price">{{ number_format($product->price, 2) }}€</td>
                                    <td>
                                        <span class="{{ $product->stock > 0 ? 'stock-in' : 'stock-out' }}">
                                            {{ $product->stock }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($product->img)
                                            <img src="{{ asset('storage/' . $product->img) }}" class="product-thumb" alt="{{ $product->name }}">
                                        @else
                                            <span class="text-muted">Sin imagen</span>
                                        @endif
                                    </td>
                                    <td class="text-muted">
                                        {{ $product->categories?->pluck('name')->implode(', ') ?: '-' }}
                                    </td>
                                    <td class="table-actions">
                                        <div class="btn-actions">
                                            <a href="{{ route('admin.products.edit', $product->id) }}" class="button-edit">Edit</a>
                                    
                                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro?');">
                                                @csrf 
                                                @method('DELETE')
                                                <button type="submit" class="button-delete">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>
</x-app-layout>