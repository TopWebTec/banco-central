<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        // Consultar transacciones uniendo con las tablas de cuentas y nodos
        $transactions = DB::table('transactions')
            ->leftJoin('users_accounts as origin', 'transactions.origin_account_id', '=', 'origin.id')
            ->leftJoin('users_accounts as dest', 'transactions.destination_account_id', '=', 'dest.id')
            ->join('banking_nodes', 'transactions.node_id', '=', 'banking_nodes.id')
            ->select(
                'transactions.id',
                'transactions.amount',
                'transactions.type',
                'transactions.created_at',
                'origin.account_number as origin_account',
                'dest.account_number as dest_account',
                'banking_nodes.name as node_name',
                'banking_nodes.type as node_type'
            )
            ->orderBy('transactions.created_at', 'desc')
            ->get();

        return view('admin.reports.index', compact('transactions'));
    }
}