<x-app-layout>
    <div class="discounts-container">
        @include('admin.partials.sidebar')

        <div class="main-content">
            <h1>Descuentos</h1>

            <a href="{{ route('discounts.create') }}" class="btn-primary mb-4 inline-block">➕ Nuevo Descuento</a>

            <table class="w-full border-collapse border">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Porcentaje</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($discounts as $discount)
                        <tr>
                            <td>{{ $discount->id }}</td>
                            <td>{{ $discount->name }}</td>
                            <td>{{ $discount->percentage }}%</td>
                            <td>
                                <a href="{{ route('discounts.edit', $discount) }}" class="text-blue-500">Editar</a>
                                <form action="{{ route('discounts.destroy', $discount) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-500" onclick="return confirm('¿Eliminar descuento?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
