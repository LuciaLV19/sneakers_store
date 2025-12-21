<aside class="sidebar">
            <div class="brand">
                SNEAKERS ADMIN
            </div>
            
            <nav>
                <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-chart-pie"></i> Resumen
                </a>
                <a href="{{ route('admin.products.index') }}" class="nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}">
                    <i class="fas fa-shoe-prints"></i> Productos
                </a>
                <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}">
                    <i class="fas fa-users"></i> Usuarios
                </a>
                <a href="{{ route('admin.orders.index') }}" class="nav-link {{ request()->routeIs('orders.*') ? 'active' : '' }}">
                    <i class="fas fa-box"></i> Pedidos
                </a>
                <a href="{{ route('admin.shipping.index') }}" class="nav-link {{ request()->routeIs('admin.shipping.*') ? 'active' : '' }}">
                    <i class="fas fa-truck"></i> Envío y Tarifas
                </a>
                <a href="{{ route('admin.discounts.index') }}" class="nav-link {{ request()->routeIs('admin.discounts.*') ? 'active' : '' }}">
                    <i class="fas fa-tag"></i> Códigos Descuento
                </a>
            </nav>

            <div class="sidebar-footer" style="padding: 1.5rem; border-top: 1px solid rgba(255,255,255,0.1);">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" style="color: #ef4444; font-weight: bold; font-family: 'Exo 2';">
                        🔴 Cerrar Sesión
                    </button>
                </form>
            </div>
        </aside>