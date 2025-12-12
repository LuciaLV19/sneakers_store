<x-app-layout>
    <x-slot name="header">
            {{ __('Dashboard') }}
    </x-slot>

<h1>Customer Dashboard</h1>
<p>Bienvenid@, {{ Auth::user()->name }}. Aquí puedes ver tus pedidos, tu carrito y tu perfil.</p>

<ul>
    <li><a href="{{ route('cart.index') }}">Mi Carrito</a></li>
    <li><a href="{{ route('orders.index') }}">Mis Pedidos</a></li>
    <li><a href="{{ route('profile.edit') }}">Mi Perfil</a></li>
</ul>

<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit">Cerrar Sesión</button>
</form>

</x-app-layout>
