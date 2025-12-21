<x-app-layout>
    <div class="admin-container">
        @include('admin.partials.sidebar')

        <main class="main-content">
            <h1 class="admin-title">Configuración de Envío</h1>

            <div class="container">
                <div class="form-card">
                    <form action="{{ route('admin.shipping.store') }}" method="POST">
                        @csrf
                        @method('PUT')
                    
                        <div class="form-row">
                            <div class="form-group">
                                <label for="shipping_cost">Costo de envío (€)</label>
                                <input type="number" name="shipping_cost" id="shipping_cost" 
                                       value="{{ old('shipping_cost', $settings->shipping_cost ?? 0) }}" 
                                       step="0.01" required>
                            </div>

                            <div class="form-group">
                                <label for="free_shipping_min">Envío gratuito a partir de (€)</label>
                                <input type="number" name="free_shipping_min" id="free_shipping_min" 
                                       value="{{ old('free_shipping_min', $settings->free_shipping_min ?? 0) }}" 
                                       step="0.01">
                            </div>
                        </div>

                        <div class="form-actions-container">
                            {{-- Contenedor de errores si los hubiera --}}
                            <div class="error-messages">
                                @if ($errors->any())
                                    <ul class="text-alert">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>

                            <div class="form-actions">
                                <button type="submit" class="btn">Guardar Configuración</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</x-app-layout>