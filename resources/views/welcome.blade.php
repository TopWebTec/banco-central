<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Bancario Distribuido - Inicio</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen flex flex-col font-sans text-gray-900">
    
    <!-- Navbar -->
    <header class="bg-blue-900 text-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold tracking-wider">🏦 Banco Central <span class="font-light text-blue-300">| Core System</span></h1>
            <nav>
                @auth
                    <a href="{{ url('/dashboard') }}" class="hover:text-blue-200 px-3">Mi Perfil</a>
                    <a href="{{ route('admin.nodes.index') }}" class="bg-blue-600 hover:bg-blue-500 px-4 py-2 rounded font-semibold transition">Panel Admin</a>
                @else
                    <a href="{{ route('login') }}" class="hover:text-blue-200 px-3 font-medium">Iniciar Sesión</a>
                    <a href="{{ route('register') }}" class="bg-blue-600 hover:bg-blue-500 px-4 py-2 rounded font-semibold transition ml-2">Registrarse</a>
                @endauth
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow flex items-center justify-center p-6">
        <div class="max-w-6xl w-full">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-extrabold text-gray-800 mb-4">Portal de Operaciones Bancarias</h2>
                <p class="text-lg text-gray-600">Seleccione el nodo o módulo al que desea acceder para la demostración del sistema.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                
                <!-- Tarjeta: Banco Central -->
                <div class="bg-white rounded-xl shadow-lg border-t-4 border-blue-800 p-6 flex flex-col items-center text-center transition transform hover:-translate-y-1 hover:shadow-2xl">
                    <div class="bg-blue-100 p-4 rounded-full mb-4">
                        <svg class="w-10 h-10 text-blue-800" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Banco Central (Core)</h3>
                    <p class="text-gray-600 mb-6 text-sm flex-grow">Administración global. Gestione sucursales, cajeros, claves API y audite el historial inmutable de transacciones.</p>
                    <a href="{{ route('admin.nodes.index') }}" class="w-full bg-blue-800 text-white font-semibold py-2 rounded hover:bg-blue-700 transition">
                        Acceder al Core
                    </a>
                </div>

                <!-- Tarjeta: Sucursal Administrativa -->
                <div class="bg-white rounded-xl shadow-lg border-t-4 border-indigo-600 p-6 flex flex-col items-center text-center transition transform hover:-translate-y-1 hover:shadow-2xl">
                    <div class="bg-indigo-100 p-4 rounded-full mb-4">
                        <svg class="w-10 h-10 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Sucursal Bancaria</h3>
                    <p class="text-gray-600 mb-6 text-sm flex-grow">Nodo de atención a clientes. Registre nuevos usuarios, asigne saldo inicial y consulte transacciones locales.</p>
                    <a href="{{ config('services.nodos.sucursal') }}" target="_blank" class="w-full bg-indigo-600 text-white font-semibold py-2 rounded hover:bg-indigo-500 transition">
                        Abrir Sucursal (Externa)
                    </a>
                </div>

                <!-- Tarjeta: Cajero Automático (ATM) -->
                <div class="bg-white rounded-xl shadow-lg border-t-4 border-green-600 p-6 flex flex-col items-center text-center transition transform hover:-translate-y-1 hover:shadow-2xl">
                    <div class="bg-green-100 p-4 rounded-full mb-4">
                        <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Cajero Automático (ATM)</h3>
                    <p class="text-gray-600 mb-6 text-sm flex-grow">Nodo de retiro de efectivo. Simule operaciones atómicas validadas contra la base de datos central en tiempo real.</p>
                    <a href="{{ config('services.nodos.cajero') }}" target="_blank" class="w-full bg-green-600 text-white font-semibold py-2 rounded hover:bg-green-500 transition">
                        Abrir ATM (Externo)
                    </a>
                </div>

            </div>
        </div>
    </main>

<!-- Footer con Distribución Horizontal -->
    <footer class="bg-gray-800 text-gray-400 py-6 border-t border-gray-800 text-sm mt-auto">
        <div class="max-w-7xl mx-auto px-6 flex flex-col lg:flex-row items-center justify-between gap-4">
            
            <!-- Equipo de Integrantes en una sola línea -->
            <div class="flex flex-col md:flex-row items-center gap-3 text-xs text-center md:text-left">
                <span class="font-bold text-gray-200 uppercase tracking-wider whitespace-nowrap">
                    Equipo de Desarrollo:
                </span>
                <div class="flex flex-col gap-y-2">
                    <div class="flex flex-wrap justify-center sm:justify-start items-center gap-x-4">
                        <span><strong class="text-blue-400">Integrante 1:</strong> Emilio Chavez Vega</span>
                        <span class="text-gray-600 hidden sm:inline">|</span>
                        <span><strong class="text-blue-400">Integrante 2:</strong> Juan José Hernández Pérez</span>
                    </div>
                    
                    <div class="flex flex-wrap justify-center sm:justify-start items-center gap-x-4">
                        <span><strong class="text-indigo-400">Integrante 3:</strong> Diego Ramírez Vazquez</span>
                        <span class="text-gray-600 hidden sm:inline">|</span>
                        <span><strong class="text-green-400">Integrante 4:</strong> Jacqueline Jinez Matehuala</span>
                    </div>
                </div>
            </div>

            <div class="flex-shrink-0">
                <a href="https://github.com/TopWebTec" target="_blank" 
                   class="inline-flex items-center bg-gray-800 hover:bg-gray-700 text-gray-200 px-4 py-2 rounded-lg font-semibold text-xs transition border border-gray-700 shadow whitespace-nowrap">
                    <svg class="w-4 h-4 mr-2 fill-current" viewBox="0 0 24 24">
                        <path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0024 12c0-6.63-5.37-12-12-12z"/>
                    </svg>
                    Ver Repositorio GitHub
                </a>
            </div>

        </div>
    </footer>

</body>
</html>