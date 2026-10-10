<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\NodeController;
use App\Http\Controllers\Api\AccountController;
use App\Http\Controllers\Api\AtmOperationController;
use App\Http\Controllers\Api\ReportController;

Route::prefix('v1')->group(function () {
    // 1. Gestión central (Nodos y Reportes)
    Route::post('/nodes', [NodeController::class, 'store']);
    Route::get('/nodes', [NodeController::class, 'index']);
    Route::get('/reports/transactions', [ReportController::class, 'index']);

    // 2. Operaciones de Sucursal (Requiere API Key de Sucursal)
    Route::middleware(['node.auth:sucursal'])->group(function () {
        Route::post('/accounts', [AccountController::class, 'store']);
    });

    // 3. Operaciones de Cajero Automático (Requiere API Key de Cajero)
    Route::middleware(['node.auth:cajero'])->group(function () {
        Route::post('/atm/withdraw', [AtmOperationController::class, 'withdraw']);
        Route::post('/atm/deposit', [AtmOperationController::class, 'deposit']); // <-- Nueva ruta para abonos
    });

    // 4. Consulta de estado y saldo de cuenta
    Route::get('/accounts/{account_number}', [AccountController::class, 'show']);
});