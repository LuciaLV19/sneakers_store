<x-app-layout>
    <div class="discounts-container">
        @include('admin.partials.sidebar')

        <div class="main-content">
            <h1 class="text-2xl font-bold mb-4">Crear Descuento</h1>

            <form action="{{ route('discounts.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="name">Nombre</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required>
                </div>

                <div class="mb-4">
                    <label for="percentage">Porcentaje</label>
                    <input type="number" name="percentage" id="percentage" value="{{ old('percentage') }}" min="0" max="100" required>
                </div>

                <button type="submit" class="btn-primary">Guardar</button>
            </form>
        </div>
    </div>
</x-app-layout>
