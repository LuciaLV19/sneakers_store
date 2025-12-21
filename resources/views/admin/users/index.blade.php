<x-app-layout>
    <div class="admin-container">
        @include('admin.partials.sidebar')

        <main class="main-content">
            <h1 class="admin-title">Gestión de Usuarios</h1>

            <div class="container">
                <div class="actions">
                    <a href="{{ route('admin.users.create') }}" class="button-create">+ Nuevo Usuario</a>
                </div>
                <div class="table-wrapper">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Rol</th>
                                <th>Fecha Registro</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                                <tr>
                                    <td>#{{ $user->id }}</td>
                                    <td class="font-bold">{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if($user->role == '1') {{-- Asumiendo que tienes este campo o lógica --}}
                                            <span class="stock-in" style="background-color: var(--brand-primary);">Admin</span>
                                        @else
                                            <span class="stock-in" style="background-color: var(--info);">Cliente</span>
                                        @endif
                                    </td>
                                    <td>{{ $user->created_at->format('d/m/Y') }}</td>
                                    <td class="table-actions">
                                        <div class="btn-actions">
                                            <a href="{{ route('admin.users.edit', $user) }}" class="button-edit">
                                                Editar
                                            </a>
                                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('¿Estás seguro?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="button-delete">Eliminar</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" style="text-align: center; padding: 2rem;">
                                        No hay usuarios registrados.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</x-app-layout>