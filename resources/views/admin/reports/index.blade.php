<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banco Central - Reporte Global de Transacciones</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-6xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Historial Global de Transacciones</h1>
            <a href="{{ route('admin.nodes.index') }}" class="text-blue-600 hover:underline font-semibold">
                ← Volver a Nodos
            </a>
        </div>

        <div class="bg-white shadow rounded-lg overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-200 text-gray-700 uppercase text-xs">
                        <th class="p-3">Fecha / Hora</th>
                        <th class="p-3">Tipo</th>
                        <th class="p-3">Monto</th>
                        <th class="p-3">Cuenta Origen</th>
                        <th class="p-3">Cuenta Destino</th>
                        <th class="p-3">Nodo (Origen)</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 text-sm">
                    @forelse($transactions as $tx)
                        <tr>
                            <td class="p-3 text-gray-500">{{ $tx->created_at }}</td>
                            <td class="p-3 font-semibold uppercase text-xs">
                                <span class="px-2 py-1 rounded 
                                    {{ $tx->type === 'retiro' ? 'bg-red-100 text-red-800' : '' }}
                                    {{ $tx->type === 'deposito' ? 'bg-green-100 text-green-800' : '' }}
                                    {{ $tx->type === 'transferencia' ? 'bg-blue-100 text-blue-800' : '' }}">
                                    {{ $tx->type }}
                                </span>
                            </td>
                            <td class="p-3 font-bold text-gray-800">${{ number_format($tx->amount, 2) }}</td>
                            <td class="p-3 font-mono text-gray-600">{{ $tx->origin_account ?? 'N/A' }}</td>
                            <td class="p-3 font-mono text-gray-600">{{ $tx->dest_account ?? 'N/A' }}</td>
                            <td class="p-3 font-medium">{{ $tx->node_name }} ({{ ucfirst($tx->node_type) }})</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-4 text-center text-gray-500">No se han registrado transacciones globales aún.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>