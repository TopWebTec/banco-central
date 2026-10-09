<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BankingNode;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NodeController extends Controller
{
    public function index()
    {
        $nodes = BankingNode::orderBy('created_at', 'desc')->get();
        return view('admin.nodes.index', compact('nodes'));
    }

    public function create()
    {
        return view('admin.nodes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'type' => 'required|in:sucursal,cajero',
            'manager_name' => 'required|string|max:150',
            'cash_balance' => 'required|numeric|min:0',
        ]);

        // Generar la API Key en texto plano (32 caracteres)
        $rawApiKey = 'bk_' . Str::random(30);

        // Guardar el Hash SHA-256 en la base de datos
        $node = BankingNode::create([
            'name' => $request->name,
            'type' => $request->type,
            'api_key_hash' => hash('sha256', $rawApiKey),
            'cash_balance' => $request->cash_balance,
            'manager_name' => $request->manager_name,
            'status' => 'activo',
        ]);

        // Retornar a la lista con la clave en sesión de un solo uso
        return redirect()->route('admin.nodes.index')->with([
            'success' => 'Nodo registrado exitosamente.',
            'generated_api_key' => $rawApiKey,
            'node_name' => $node->name,
        ]);
    }
}