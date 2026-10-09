<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AccountController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'account_number' => 'required|string|max:16|unique:users_accounts,account_number',
            'holder_name' => 'required|string|max:150',
            'initial_balance' => 'required|numeric|min:0',
        ]);

        $node = $request->attributes->get('authenticated_node');

        try {
            $result = DB::selectOne(
                "SELECT register_account_with_deposit(?, ?, ?, ?) AS data",
                [
                    $validated['account_number'],
                    $validated['holder_name'],
                    $validated['initial_balance'],
                    $node->id
                ]
            );

            return response()->json(json_decode($result->data, true), 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 400);
        }
    }

    public function show($account_number)
    {
        $account = DB::table('users_accounts')
            ->where('account_number', $account_number)
            ->first();

        if (!$account) {
            return response()->json(['success' => false, 'error' => 'Cuenta no encontrada.'], 404);
        }

        return response()->json(['success' => true, 'data' => $account]);
    }
}