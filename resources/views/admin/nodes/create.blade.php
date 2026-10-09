<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banco Central - Registrar Nodo</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow">
        <h2 class="text-xl font-bold mb-6 text-gray-800">Registrar Sucursal o Cajero Automático</h2>

        <form action="{{ route('admin.nodes.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Nombre del Nodo</label>
                <input type="text" name="name" required placeholder="Ej. Sucursal Centro o ATM-01" class="w-full border p-2 rounded focus:ring focus:ring-blue-200">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Tipo de Nodo</label>
                <select name="type" class="w-full border p-2 rounded">
                    <option value="sucursal">Sucursal</option>
                    <option value="cajero">Cajero Automático (ATM)</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Nombre del Responsable</label>
                <input type="text" name="manager_name" required placeholder="Ej. Ana Martínez" class="w-full border p-2 rounded">
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 font-medium mb-2">Efectivo Físico Inicial ($)</label>
                <input type="number" step="0.01" name="cash_balance" required value="50000.00" class="w-full border p-2 rounded">
            </div>

            <div class="flex justify-end gap-3">
                <a href="{{ route('admin.nodes.index') }}" class="px-4 py-2 border rounded text-gray-600 hover:bg-gray-50">Cancelar</a>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 font-semibold">
                    Generar Nodo y API Key
                </button>
            </div>
        </form>
    </div>
</body>
</html>