<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <h1>Admin Dashboard</h1>

<ul>
    <li><a href="{{ route('products.index') }}">Productos</a></li>
    <li><a href="{{ route('users.index') }}">Usuarios</a></li>
    <li><a href="{{ route('orders.index') }}">Pedidos</a></li>
</ul>

<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit">Cerrar Sesión</button>
</form>
</x-app-layout>
