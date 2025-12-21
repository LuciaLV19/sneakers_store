<x-app-layout>
    <div class="admin-dashboard-layout">
        @include('admin.partials.sidebar')

        <main class="main-content">
            <h2 class="admin-title">Editar Usuario: {{ $user->name }}</h2>

            <div class="container">
                <div class="form-card"> 
                    
                    {{-- Usamos el método PUT para actualizaciones --}}
                    <form action="{{ route('admin.users.update', $user) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-row">
                            <div class="form-group">
                                <label for="name">Nombre:</label>
                                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required>
                            </div>

                            <div class="form-group">
                                <label for="password">Contraseña (dejar en blanco para no cambiar):</label>
                                <input type="password" name="password" id="password" placeholder="Nueva contraseña">
                            </div>
                        </div>

                        <div class="form-row"> 
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required>
                            </div>
                            <div class="form-group">
                                <label for="role">Rol:</label>
                                <select name="role" id="role" class="form-control">
                                    <option value="0" {{ old('role', $user->role) == 0 ? 'selected' : '' }}>Cliente</option>
                                    <option value="1" {{ old('role', $user->role) == 1 ? 'selected' : '' }}>Admin</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-actions-container">
                            {{-- Contenedor de errores (Abajo a la izquierda) --}}
                            <div class="form-errors-inline">
                                @if ($errors->any())
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>

                            <div class="form-actions">
                                <a href="{{ route('admin.users.index') }}" class="btn-back">Cancelar</a>
                                <button type="submit" class="btn">Actualizar Usuario</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</x-app-layout>