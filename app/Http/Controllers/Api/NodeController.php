<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class NodeController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'type' => 'required|in:sucursal,cajero',
            'cash_balance' => 'required|numeric|min:0',
            'manager_name' => 'required|string|max:150',
        ]);

        $plainApiKey = 'node_' . Str::random(40);
        $hashedApiKey = hash('sha256', $plainApiKey);
        $nodeId = Str::uuid()->toString();

        DB::table('banking_nodes')->insert([
            'id' => $nodeId,
            'name' => $validated['name'],
            'type' => $validated['type'],
            'api_key_hash' => $hashedApiKey,
            'cash_balance' => $validated['cash_balance'],
            'manager_name' => $validated['manager_name'],
            'status' => 'activo',
            'created_at' => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Nodo bancario registrado con éxito.',
            'node_id' => $nodeId,
            'type' => $validated['type'],
            'cash_balance' => (float) $validated['cash_balance'],
            'api_key' => $plainApiKey // Esta clave se muestra sólo una vez para guardarla en el .env del nodo
        ], 201);
    }

    public function index()
    {
        $nodes = DB::table('banking_nodes')
            ->select('id', 'name', 'type', 'cash_balance', 'manager_name', 'status', 'created_at')
            ->get();

        return response()->json(['success' => true, 'data' => $nodes]);
    }
}