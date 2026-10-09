<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $query = DB::table('transactions')
            ->join('banking_nodes', 'transactions.node_id', '=', 'banking_nodes.id')
            ->leftJoin('users_accounts as orig', 'transactions.origin_account_id', '=', 'orig.id')
            ->leftJoin('users_accounts as dest', 'transactions.destination_account_id', '=', 'dest.id')
            ->select(
                'transactions.id',
                'transactions.amount',
                'transactions.type',
                'transactions.created_at',
                'banking_nodes.name as node_name',
                'banking_nodes.type as node_type',
                'orig.account_number as origin_account',
                'dest.account_number as destination_account'
            )
            ->orderBy('transactions.created_at', 'desc');

        if ($request->filled('node_id')) {
            $query->where('transactions.node_id', $request->query('node_id'));
        }

        return response()->json([
            'success' => true,
            'data' => $query->get()
        ]);
    }
}