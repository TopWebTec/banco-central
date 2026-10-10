<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Panel del Administrador') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Mensaje de Bienvenida -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900 flex justify-between items-center">
                <div>
                    <h3 class="text-lg font-bold">¡Bienvenido, {{ Auth::user()->name }}!</h3>
                    <p class="text-sm text-gray-600">Has iniciado sesión como administrador del Banco Central.</p>
                </div>
                <span class="bg-green-100 text-green-800 text-xs font-semibold px-3 py-1 rounded-full">Sesión Activa</span>
            </div>

            <!-- Accesos Rápidos -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <!-- Ir al Core del Banco Central -->
                <a href="{{ route('admin.nodes.index') }}" class="block p-6 bg-blue-900 text-white rounded-xl shadow-lg hover:bg-blue-800 transition transform hover:-translate-y-1">
                    <div class="flex items-center justify-between mb-4">
                        <h4 class="text-2xl font-bold">🏛️ Panel Administrativo (Core)</h4>
                        <span class="text-sm bg-blue-700 px-3 py-1 rounded">Acceso Directo</span>
                    </div>
                    <p class="text-blue-200 text-sm">Administra los nodos (Sucursales/ATM), genera claves de API y audita el historial global de transacciones.</p>
                </a>

                <!-- Ir al Homepage Principal -->
                <a href="{{ url('/') }}" class="block p-6 bg-gray-800 text-white rounded-xl shadow-lg hover:bg-gray-700 transition transform hover:-translate-y-1">
                    <div class="flex items-center justify-between mb-4">
                        <h4 class="text-2xl font-bold">🏠 Portal de Inicio (Homepage)</h4>
                        <span class="text-sm bg-gray-700 px-3 py-1 rounded">Nodos Externos</span>
                    </div>
                    <p class="text-gray-300 text-sm">Regresa al portal principal para abrir las interfaces externas de las sucursales o cajeros automáticos.</p>
                </a>

            </div>

        </div>
    </div>
</x-app-layout>