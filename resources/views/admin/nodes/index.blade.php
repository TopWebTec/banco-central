<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banco Central - Gestión de Nodos</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-6xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Nodos Bancarios (Sucursales y Cajeros)</h1>
                <a href="{{ url('/') }}" class="text-sm text-blue-600 hover:underline">← Volver al Portal de Inicio</a>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('admin.reports.index') }}" class="bg-gray-200 text-gray-800 px-4 py-2 rounded shadow hover:bg-gray-800 font-semibold flex items-center transition">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    Ver Reportes Globales
                </a>
                <a href="{{ route('admin.nodes.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700 font-semibold flex items-center transition">
                    + Registrar Nuevo Nodo
                </a>
            </div>
        </div>

        <!-- Alerta de API Key Generada (Solo se muestra una vez tras crear) -->
        @if (session('generated_api_key'))
            <div class="mb-6 bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded shadow">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="font-bold text-yellow-800">¡API Key generada para {{ session('node_name') }}!</p>
                        <p class="text-sm text-yellow-700">Copia esta clave ahora. Por seguridad, **no se volverá a mostrar**:</p>
                        <input type="text" readonly id="apiKeyValue" value="{{ session('generated_api_key') }}" 
                               class="mt-2 w-full max-w-md p-2 bg-white border border-gray-300 rounded font-mono text-sm">
                    </div>
                    <button onclick="copyToClipboard()" class="bg-yellow-600 text-white px-4 py-2 rounded hover:bg-yellow-700">
                        Copiar Clave
                    </button>
                </div>
            </div>
        @endif

        <!-- Tabla de Nodos -->
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-200 text-gray-700 uppercase text-xs">
                        <th class="p-3">Nombre</th>
                        <th class="p-3">Tipo</th>
                        <th class="p-3">Responsable</th>
                        <th class="p-3">Efectivo Físico</th>
                        <th class="p-3">Estado</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 text-sm">
                    @forelse($nodes as $node)
                        <tr>
                            <td class="p-3 font-medium">{{ $node->name }}</td>
                            <td class="p-3">
                                <span class="px-2 py-1 rounded text-xs {{ $node->type === 'sucursal' ? 'bg-indigo-100 text-indigo-800' : 'bg-green-100 text-green-800' }}">
                                    {{ ucfirst($node->type) }}
                                </span>
                            </td>
                            <td class="p-3">{{ $node->manager_name }}</td>
                            <td class="p-3 font-semibold text-gray-700">${{ number_format($node->cash_balance, 2) }}</td>
                            <td class="p-3">
                                <span class="px-2 py-1 rounded text-xs bg-gray-100 text-gray-800">
                                    {{ ucfirst($node->status) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-4 text-center text-gray-500">No hay nodos registrados aún.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function copyToClipboard() {
            const copyText = document.getElementById("apiKeyValue");
            copyText.select();
            navigator.clipboard.writeText(copyText.value);
            alert("API Key copiada al portapapeles.");
        }
    </script>
</body>
</html>