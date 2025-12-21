<x-app-layout>
    <div class="admin-container">
        @include('admin.partials.sidebar')

        <main class="main-content">
            <h1 class="admin-title">Descuentos</h1>
            <div class="container">
                <div class="actions">
                    <a href="{{ route('admin.discounts.create') }}" class="button-create">+ Nuevo Descuento</a>
                </div>
                <div class="table-wrapper">
                    <table class="table">
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
                                    <td class="table-actions">
                                        <div class="btn-actions">
                                            <a href="{{ route('admin.discounts.edit', $discount) }}" class="button-edit">Editar</a>
                                            <form action="{{ route('admin.discounts.destroy', $discount) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button class="button-delete" onclick="return confirm('¿Eliminar descuento?')">Eliminar</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</x-app-layout>
