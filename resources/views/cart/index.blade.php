<x-app-layout>
    <x-slot name="header">
        <h1>
            {{ __('Shopping Cart') }}
        </h1>
    </x-slot>

    <div class="container mx-auto p-6">
        <div class="flex flex-col">
            <table class="table-auto w-full">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (Session::get('cart', []) as $productId => $item)
                        <tr>
                            <td>
                                {{ $item['name'] }}
                            </td>
                            <td>
                                {{ $item['quantity'] }}
                            </td>
                            <td>
                                {{ $item['price'] }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
