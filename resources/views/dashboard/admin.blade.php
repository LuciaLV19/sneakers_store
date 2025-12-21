<x-app-layout>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <div class="admin-container">
        @include('admin.partials.sidebar')
        
        <div class="main-content">
            <header>
                <h2 class="admin-title">
                    {{ __('Admin Panel') }}
                </h2>
            </header>

            <main class="container">
                <h1 class="dashboard-title">Dashboard Overview</h1>
                
                <div class="stats-grid">
                    <div class="stat-card">
                        <span class="label">Total Ventas</span>
                        <div class="value">€1,250.00</div>
                    </div>
                    <div class="stat-card">
                        <span class="label">Zapatos en Stock</span>
                        <div class="value">{{ \App\Models\Product::count() }}</div>
                    </div>
    
                    <div class="stat-card">
                        <span class="label">Pedidos Nuevos</span>
                        <div class="value">4</div>
                    </div>
            
                </div>
                <div class="stats-grid-graphs">
                     <div class="stat-card">
                        <h3>Ventas vs Visitas</h3>
                        <div class="chart-container">
                            <canvas id="salesChart"></canvas>
                        </div>
                    </div>

                    <div class="stat-card">
                        <h3>Estado de Pedidos</h3>
                        <div class="chart-container">
                            <canvas id="orderChart"></canvas>
                        </div>
                    </div>
                    <div class="stat-card">
                        <h3>Ventas por Categoría</h3>
                        <div class="chart-container">
                            <canvas id="categoryChart"></canvas>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</x-app-layout>
<script>
    // Gráfico Circular (Donut)
    const ctxOrder = document.getElementById('orderChart').getContext('2d');
    new Chart(ctxOrder, {
        type: 'doughnut',
        data: {
            labels: ['Ventas', 'Productos', 'Ingresos'],
            datasets: [{
                data: [68, 25, 14],
                backgroundColor: ['#6b1616', '#3b82f6', '#10b981'],
                borderWidth: 0,
                hoverOffset: 4
            }]
        },
        options: {
            cutout: '70%',
            plugins: { legend: { position: 'bottom' } }
        }
    });

    // Gráfico de Barras
    const ctxSales = document.getElementById('salesChart').getContext('2d');
    new Chart(ctxSales, {
        type: 'bar',
        data: {
            labels: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun'],
            datasets: [{
                label: 'Ventas',
                data: [12, 19, 3, 5, 2, 3],
                backgroundColor: '#fd7e14'
            }, {
                label: 'Visitas',
                data: [22, 29, 13, 15, 12, 13],
                backgroundColor: '#3b82f6'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: { y: { beginAtZero: true } }
        }
    });

    // Gráfico de Ventas por Categoría (Nuevo)
    const ctxCategory = document.getElementById('categoryChart').getContext('2d');
    new Chart(ctxCategory, {
    type: 'polarArea', // Tipo visual para distribución
    data: {
        labels: ['Men', 'Women', 'Children', //Gender
        'Casual','Running', 'Basketball', 'Training', 'Football', 'Skate', //Use
        'Nike', 'Jordan', 'Adidas', 'Puma', 'Reebok', 'New Balance', 'Converse', 'Lacoste', 'Vans' //Brands
        ],
        datasets: [{
            data: [30, 45, 15, 10, 20, 25, 5, 15, 10, 50, 30, 25, 20, 10, 15, 5, 10, 8, 12], // Porcentajes de venta
            backgroundColor: [
                // Género (ejemplo: azul)
                '#3b82f6', '#3b82f6', '#3b82f6',
    
                // Uso (ejemplo: verde)
                '#34d399', '#34d399', '#34d399', '#34d399', '#34d399', '#34d399',
    
                // Marca (ejemplo: amarillo)
                '#facc15', '#facc15', '#facc15', '#facc15', '#facc15', '#facc15', '#facc15', '#facc15', '#facc15',
            ],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { 
            legend: { 
                position: 'bottom',
                labels: { color: document.documentElement.classList.contains('dark') ? '#9ca3af' : '#111827' }
            } 
        }
    }
});
</script>