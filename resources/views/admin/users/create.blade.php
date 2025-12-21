<x-app-layout>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>

    <div class="admin-dashboard-layout">
        @include('admin.partials.sidebar')

        <main class="main-content">
            <h2 class="admin-title">Crear Usuario</h2>

            <div class="container">
                <div class="form-card"> 
                    <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                        @csrf

                        <div class="form-row">
                            <div class="form-group">
                                <label for="name">Nombre:</label>
                                <input type="text" name="name" id="name" placeholder="Nombre del usuario" value="{{ old('name') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="password">Contraseña:</label>
                                <div class="password-wrapper">
                                    <input type="password" name="password" id="password" placeholder="Contraseña" required>
                                    <span id="togglePassword">
                                        <i class="fa-regular fa-eye" id="eyeIcon"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-row"> 
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" name="email" id="email" placeholder="Email del usuario" value="{{ old('email') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="role">Rol del usuario:</label>
                                <select name="role" id="role" class="form-control" required>
                                    <option value="" disabled {{ old('role') === null ? 'selected' : '' }}>Selecciona un rol</option>
                                    <option value="0" {{ old('role') === '0' ? 'selected' : '' }}>Cliente</option>
                                    <option value="1" {{ old('role') === '1' ? 'selected' : '' }}>Administrador</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group-actions">
                            <div class ="error-messages">
                                @if ($errors->any())
                                    <div class="text-alert">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                            <div class="form-actions">
                                <a href="{{ route('admin.users.index') }}" class="btn-back">Volver al listado</a>
                                <button type="submit" class="btn">Guardar Usuario</button>
                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>
        </main>
    </div>
</x-app-layout>