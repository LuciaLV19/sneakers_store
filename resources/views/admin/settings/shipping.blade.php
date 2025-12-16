<x-app-layout>
    <div class="shipping-container">
        @include('admin.partials.sidebar')

        <div class="main-content">
            <h1 class="text-2xl font-bold mb-4">Configuración de Envío</h1>

            <form action="{{ route('shipping.store') }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-4">
                    <label for="shipping_cost">Costo de envío</label>
                    <input type="number" name="shipping_cost" id="shipping_cost" value="{{ old('shipping_cost', $settings->shipping_cost ?? 0) }}" step="0.01" required>
                </div>

                <div class="mb-4">
                    <label for="free_shipping_min">Envío gratuito a partir de</label>
                    <input type="number" name="free_shipping_min" id="free_shipping_min" value="{{ old('free_shipping_min', $settings->free_shipping_min ?? 0) }}" step="0.01">
                </div>

                <button type="submit" class="btn-primary">Guardar Configuración</button>
            </form>
        </div>
    </div>
</x-app-layout>
