<x-app-layout>
    <x-slot name="header">
        <h1>Mis Pedidos</h1>
    </x-slot>
    <div class="orders-container">
    @if($orders->isEmpty())
        <p>No has realizado ningún pedido aún.</p>
    @else
        @foreach($orders as $order)
            <div class="border p-4 mb-4 rounded">
                <h2>Pedido #{{ $order->id }} - {{ $order->status }}</h2>
                <p>Total: €{{ $order->total_amount }}</p>
                <ul>
                    @foreach($order->items as $item)
                        <li>{{ $item->product->name }} x {{ $item->quantity }} - €{{ $item->price }}</li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    @endif
</x-app-layout>
