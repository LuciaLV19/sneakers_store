<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SneakerShop | Home</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            /* Aplicando tus colores exactos */
            .bg-primary { background-color: #6b1616; }
            .bg-primary-soft { background-color: #930202; }
            .text-primary { color: #6b1616; }
            .text-primary-soft { color: #930202; }
            .bg-secondary { background-color: #000000; }
            .bg-tertiary-soft { background-color: #e1e1e1; }
            .border-primary { border-color: #6b1616; }
        </style>
    </head>
    <body class="bg-[#ffffff] text-[#000000] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col font-['Instrument_Sans']">
        
        <header class="w-full lg:max-w-6xl max-w-[335px] text-sm mb-10">
            <nav class="flex items-center justify-between">
                <div class="font-black text-2xl tracking-tighter text-secondary">
                    SNEAKER<span class="text-primary">CORE</span>
                </div>
                
                <div class="flex gap-4 items-center">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="px-5 py-2 border border-secondary rounded-sm font-medium">Mi Cuenta</a>
                        @else
                            <a href="{{ route('login') }}" class="font-medium">Entrar</a>
                            <a href="{{ route('register') }}" class="px-5 py-2 bg-primary text-white rounded-sm font-bold hover:bg-primary-soft transition-colors">
                                Registro
                            </a>
                        @endauth
                    @endif
                </div>
            </nav>
        </header>

        <main class="flex max-w-[335px] w-full flex-col lg:max-w-6xl lg:flex-row shadow-2xl rounded-xl overflow-hidden border border-tertiary-soft">
            
            <div class="lg:w-3/5 bg-secondary relative overflow-hidden group">
                <img src="https://images.unsplash.com/photo-1600185365483-26d7a4cc7519?q=80&w=1000" alt="Sneakers" class="object-cover w-full h-full opacity-80 group-hover:scale-105 transition-transform duration-700">
                <div class="absolute bottom-8 left-8">
                    <span class="bg-primary text-white px-3 py-1 text-xs font-bold uppercase tracking-widest">Limited Edition</span>
                </div>
            </div>

            <div class="flex-1 p-10 lg:p-16 bg-white flex flex-col justify-center">
                <h1 class="text-5xl font-black leading-none tracking-tighter text-secondary mb-6">
                    MÁS QUE <br><span class="text-primary">ZAPATILLAS.</span>
                </h1>
                <p class="mb-8 text-secondary-soft text-lg leading-relaxed">
                    Selección exclusiva curada para amantes del streetwear. Calidad, autenticidad y el estilo que define tu camino.
                </p>
                
                <div class="flex flex-col gap-4">
                    <a href="/products" class="w-full bg-primary text-white text-center py-4 rounded-sm font-bold text-lg hover:bg-primary-soft shadow-lg transition-all transform hover:-translate-y-1">
                        COMPRAR AHORA
                    </a>
                    <a href="#about" class="w-full border border-tertiary-soft text-secondary-soft text-center py-4 rounded-sm font-semibold hover:bg-tertiary-soft transition-all">
                        Nuestra Historia
                    </a>
                </div>

                <div class="mt-12 pt-8 border-t border-tertiary-soft grid grid-cols-3 gap-2 text-[10px] font-bold uppercase tracking-widest text-secondary-soft">
                    <div class="flex items-center gap-2"><span>✔</span> Auténtico</div>
                    <div class="flex items-center gap-2"><span>✔</span> Premium</div>
                    <div class="flex items-center gap-2"><span>✔</span> 24h Ship</div>
                </div>
            </div>
        </main>

        <footer class="mt-12 text-secondary-soft text-[11px] font-medium tracking-widest uppercase opacity-50">
            &copy; {{ date('Y') }} SNEAKERCORE - All Rights Reserved
        </footer>
    </body>
</html>