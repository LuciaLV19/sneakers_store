<x-app-layout>
    <div class="admin-container">
        @include('admin.partials.sidebar')

        <main class="main-content">
            <div class="top-actions">
                <h1 class="admin-title">Editar Descuento</h1>
            </div>

            <div class="container">
                <div class="form-card">
                    <form action="{{ route('admin.discounts.update', $discount) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-row">
                            <div class="form-group">
                                <label for="name">Nombre del Descuento</label>
                                <input type="text" name="name" id="name" placeholder="Ej: NUEVO10" value="{{ old('name', $discount->name) }}" required>
                            </div>

                            <div class="form-group">
                                <label for="percentage">Porcentaje de Descuento (%)</label>
                                <div class="percentage-wrapper">
                                    <input type="number" name="percentage" id="percentage" value="{{ old('percentage', $discount->percentage) }}" min="0" max="100" placeholder="0 - 100" required>
                                    <span class="icon">%</span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group-actions">
                            <div class="error-messages">
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
                                <a href="{{ route('admin.discounts.index') }}" class="btn-back">Volver al listado</a>
                                <button type="submit" class="btn">Actualizar Descuento</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</x-app-layout>