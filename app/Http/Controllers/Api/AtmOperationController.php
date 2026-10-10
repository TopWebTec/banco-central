<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AtmOperationController extends Controller
{
    /**
     * Procesar retiro de efectivo desde el Cajero ATM
     */
    public function withdraw(Request $request)
    {
        $validated = $request->validate([
            'account_number' => 'required|string',
            'amount' => 'required|numeric|min:1',
        ]);

        $node = $request->attributes->get('authenticated_node');

        try {
            $result = DB::selectOne(
                "SELECT process_atm_withdrawal(?, ?, ?) AS data",
                [
                    $validated['account_number'],
                    $node->id,
                    $validated['amount']
                ]
            );

            return response()->json(json_decode($result->data, true), 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Procesar abono / depósito a una cuenta desde el Cajero ATM
     */
    public function deposit(Request $request)
    {
        $validated = $request->validate([
            'account_number' => 'required|string',
            'amount' => 'required|numeric|min:1',
        ]);

        $node = $request->attributes->get('authenticated_node');

        try {
            $result = DB::selectOne(
                "SELECT process_atm_deposit(?, ?, ?) AS data",
                [
                    $validated['account_number'],
                    $node->id,
                    $validated['amount']
                ]
            );

            return response()->json(json_decode($result->data, true), 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 400);
        }
    }
}