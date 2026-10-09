<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class ValidateNodeApiKey
{
    public function handle(Request $request, Closure $next, ...$allowedTypes): Response
    {
        $apiKey = $request->header('X-API-Key');

        if (!$apiKey) {
            return response()->json([
                'success' => false,
                'error' => 'Cabecera X-API-Key requerida.'
            ], Response::HTTP_UNAUTHORIZED);
        }

        // Se calcula el hash SHA-256 para compararlo contra la base de datos
        $hash = hash('sha256', $apiKey);

        $node = DB::table('banking_nodes')
            ->where('api_key_hash', $hash)
            ->where('status', 'activo')
            ->first();

        if (!$node) {
            return response()->json([
                'success' => false,
                'error' => 'API Key no válida o nodo inactivo.'
            ], Response::HTTP_FORBIDDEN);
        }

        // Validar si la ruta exige un tipo específico (sucursal o cajero)
        if (!empty($allowedTypes) && !in_array($node->type, $allowedTypes)) {
            return response()->json([
                'success' => false,
                'error' => 'Operación no permitida para nodos de tipo ' . $node->type . '.'
            ], Response::HTTP_FORBIDDEN);
        }

        // Inyectar el nodo autenticado dentro del request para su uso en controladores
        $request->attributes->set('authenticated_node', $node);

        return $next($request);
    }
}