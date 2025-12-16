<x-app-layout>
    <div class="orders-container">
        @include('admin.partials.sidebar')

        <div class="main-content">
            <h1 class="text-2xl font-bold mb-4">Pedidos</h1>

            @foreach($orders as $order)
                <div class="p-4 border mb-4 rounded bg-white">
                    <h2>Pedido #{{ $order->id }} - {{ $order->status }}</h2>
                    <p>Cliente: {{ $order->user->name }} ({{ $order->user->email }})</p>
                    <p>Total: €{{ $order->total_amount }}</p>
                    <ul>
                        @foreach($order->items as $item)
                            <li>{{ $item->product->name }} x {{ $item->quantity }} - €{{ $item->price }}</li>
                        @endforeach
                    </ul>
                </div>
            @endforeach

            @if($orders->isEmpty())
                <p>No hay pedidos todavía.</p>
            @endif
        </div>
    </div>
</x-app-layout>
