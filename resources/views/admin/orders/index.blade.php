<x-app-layout>
    <div class="admin-container">
        @include('admin.partials.sidebar')

        <main class="main-content">
            <h1 class="admin-title">Pedidos</h1>

            <div class="container">
                <div class="orders-list">
                
                    @forelse($orders as $order)
                        <div class="form-card order-item">
                            
                            {{-- Cabecera de la tarjeta --}}
                            <div class="order-header">
                                <h2 class="order-id">Pedido #{{ $order->id }}</h2>
                                <span class="badge-status {{ strtolower($order->status) }}">
                                    {{ $order->status }}
                                </span>
                            </div>

                            {{-- Cuerpo de la tarjeta --}}
                            <div class="order-body">
                                <div class="customer-info">
                                    <p><strong>Cliente:</strong> {{ $order->user->name }}</p>
                                    <p><strong>Email:</strong> {{ $order->user->email }}</p>
                                    <p class="order-total">
                                        <strong>Total:</strong> <span>€{{ number_format($order->total_amount, 2) }}</span>
                                    </p>
                                </div>

                                <div class="products-info">
                                    <p><strong>Productos:</strong></p>
                                    <ul class="order-products-list">
                                        @foreach($order->items as $item)
                                            <li>
                                                {{ $item->product->name }} 
                                                <span class="product-qty">(x{{ $item->quantity }})</span> 
                                                <span class="product-price">— €{{ number_format($item->price, 2) }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>

                            {{-- Acciones de la tarjeta --}}
                            <div class="order-actions">
                                <form action="{{ route('admin.orders.destroy', $order) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este registro?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="button-delete">Eliminar Pedido</button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="form-card empty-state">
                            <p>No hay pedidos registrados todavía.</p>
                        </div>
                    @endforelse

                </div>
            </div>
        </main>
    </div>
</x-app-layout>